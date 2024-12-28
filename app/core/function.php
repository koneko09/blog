<?php
//create_tables();

//$query: Tham số đầu tiên là một chuỗi chứa câu lệnh SQL
//$data = []: Tham số thứ hai là một mảng chứa các giá trị thay thế cho các placeholder trong câu lệnh SQL, truyền vào khi gọi hàm
function query( string $query, array $data = [] ) //truy vấn và trả về 1 mảng
{
    // define("DBUSER" , "root");
    // define("DBPASS" , "");
    // define("DBNAME" , "myblog_db");
    // define("DBHOST" , "localhost");

	// Kết nối DB
    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME; //Tạo chuỗi kết nối
    $con = new PDO($string, DBUSER, DBPASS); //Tạo một đối tượng PDO để kết nối với cơ sở dữ liệu

	//Chuẩn bị câu lệnh, giúp bảo vệ chống lại tấn công SQL Injection
    $stmt = $con->prepare($query);
	//Thực thi câu lệnh, thay các placeholder (phần giữ chỗ) bằng giá trị trong mảng $data đc truyền vào
    $stmt->execute($data);

	// Lấy tất cả các kết quả từ câu lệnh SQL dưới dạng mảng liên kết rồi gán cho $result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//Nếu $result là một mảng và không rỗng, trả về $result
    if(is_array($result) && !empty($result)) {
        return $result;
    }
    return false;
}

// né SQL injection

//$query: Tham số đầu tiên là một chuỗi chứa câu lệnh SQL
//$data = []: Tham số thứ hai là một mảng chứa các giá trị thay thế cho các placeholder trong câu lệnh SQL, truyền vào khi gọi hàm
function query_update( string $query, array $data = [] )
{

    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    $con = new PDO($string, DBUSER, DBPASS);

	//Chuẩn bị câu lệnh
    $stmt = $con->prepare($query);
	//Thực thi câu lệnh, thay các placeholder bằng giá trị trong mảng đc truyền vào
    $stmt->execute($data);

    return true;

}

// function query(string $query, array $data = [])
// {
//     // define("DBUSER", "root");
//     // define("DBPASS", "");
//     // define("DBNAME", "myblog_db");
//     // define("DBHOST", "localhost");

//     $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

//     if ($con->connect_error) {
//         die("Connection failed: " . $con->connect_error);
//     }

//     $stmt = $con->prepare($query);

//     if ($stmt === false) {
//         die("Prepare failed: " . $con->error);
//     }

//     if (!empty($data)) {
//         $types = str_repeat('s', count($data)); // assuming all parameters are strings
//         $stmt->bind_param($types, ...$data);
//     }

//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         return $result->fetch_all(MYSQLI_ASSOC);
//     }

//     return false;
// }

//$query: Tham số đầu tiên là một chuỗi chứa câu lệnh SQL
//$data = []: Tham số thứ hai là một mảng chứa các giá trị thay thế cho các placeholder trong câu lệnh SQL, truyền vào khi gọi hàm
function query_row( string $query, array $data = [] ) //truy vấn và trả về 1 dòng dữ liệu
{
    // define("DBUSER" , "root");
    // define("DBPASS" , "");
    // define("DBNAME" , "myblog_db");
    // define("DBHOST" , "localhost");

    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    $con = new PDO($string, DBUSER, DBPASS);

   
    $stmt = $con->prepare($query);
    $stmt->execute($data);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($result) && !empty($result)) {
        return $result[0];
    }
    return false;

}

// Hàm xác thực, tạo 1 session mới tên USER hoặc ADMIN có giá trị là mảng thông tin người dùng
function authenticate($row){
	if($row['role'] == 'admin')
    	$_SESSION['ADMIN'] = $row;
	if($row['role'] == 'user')
		$_SESSION['USER'] = $row;
}

// lấy thông tin người dùng từ  $_SESSION['USER'], chỉ định trường muốn lấy qua tham số key
// mặc định tham số bằng rỗng
function user($key = '')
{
	// Nếu tham số rỗng, trả về toàn bộ mảng
	if(empty($key))
		return $_SESSION['USER'];

	// Nếu có tham số và trường đó có tồn tại trong session user thì trả về giá trị trường đó
	if(!empty($_SESSION['USER'][$key]))
		return $_SESSION['USER'][$key];
	// Nếu có tham số truyền vào và trường đó không tồn tại trong session user hàm sẽ trả về một chuỗi rỗng ''
	return '';
}

// kiểm tra xem người dùng có đang đăng nhập và có role là user hay không
function logged_in_user(){
    if(!empty($_SESSION['USER']) && $_SESSION['USER']['role'] == 'user')
         return true;
    return false;
}

//// kiểm tra xem người dùng có đang đăng nhập và có role là admin hay không
// Hàm xác thực session, nếu tồn tại session có tên USER thì trả về true, ngược lại là false
function logged_in(){
    if(!empty($_SESSION['ADMIN']) && $_SESSION['ADMIN']['role'] == 'admin')
         return true;
    return false;
}


function str_to_url($url)
{
    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    
    // Attempt to convert using iconv
    $converted_url = @iconv("utf-8", "us-ascii//TRANSLIT//IGNORE", $url);
    if ($converted_url === false) {
        // If iconv fails, retain the original URL
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    } else {
        $url = $converted_url;
    }
    
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
    
    return $url;
}

// function esc($str)  {
//     return htmlspecialchars($str ?? '');
// }


// chuyển hướng đến trang khác ($page chứa tên trang)
// vd $page = admin, sẽ chuyển hướng đến http:localhost/blog/public/admin
function redirect($page) {
    header('Location: '.ROOT.'/' . $page);
    die;
}

// Hàm trả về giá trị cũ được nhập trước đó từ form được gửi bằng POST
function old_value($key, $default = '') {
    if(!empty($_POST[$key]))
       return $_POST[$key];
    return $default;
}

// Hàm trả về ô chọn cũ được chọn trước đó từ checkbox được gửi bằng POST
function old_check($key){
	$default = '';
    if(!empty($_POST[$key]))
       return "checked";
    return "";
}

// Hàm trả về giá trị cũ được chọn trước đó (option) của select từ form được gửi bằng POST
function old_select($key, $value, $default = '') {
	// Nếu đã chọn giá trị trong select và giá trị bằng với biến $value truyền vào thì trả về selected
    if (!empty($_POST[$key]) && $_POST[$key] == $value) {
        return "selected";
    }
	//giá trị mặc định $default bằng với giá trị của tùy chọn ($value), hàm sẽ trả về chuỗi "selected", đánh dấu tùy chọn đó là được chọn
    if ($default == $value) {
        return "selected";
    }
	// còn lại trả về chuỗi rỗng
    return "";
}

// lấy đường dẫn của một hình ảnh
function get_image($file)
{
	$file = isset($file) ? $file : ''; // Nếu tham số $file không được truyền vào, gán giá trị rỗng
	if(file_exists($file)) //Kiểm tra xem file có tồn tại không bằng hàm file_exists
	{
		return ROOT.'/'.$file; // Nếu file tồn tại, trả về đường dẫn của file
	}

	return ROOT.'/assets/images/no_image.jpg'; //// Nếu file không tồn tại, trả về hình ảnh noimage
}

// tạo ra các liên kết (URL) cho trang hiện tại, trang tiếp theo, trang trước đó và trang đầu tiên
//và quản lý thông số page trong URL
function get_pagination_vars()
{

	// Lấy số trang từ GET 'page', nếu không có thì mặc định là trang 1
	$page_number = $_GET['page'] ?? 1;
	// nếu page_number rỗng thì trả về 1, nếu page_number có giá trị thì trả về kiểu nguyên
	$page_number = empty($page_number) ? 1 : (int)$page_number;
	// nếu page_number nhỏ hơn 1 trả về 1, ngược lại thì giữ nguyên
	$page_number = $page_number < 1 ? 1 : $page_number;

	// Lấy liên kết hiện tại từ tham số GET 'url', nếu url rỗng thì mặc định là 'home'
	$current_link = $_GET['url'] ?? 'home';
	// thêm đường dẫn đầy đủ
	$current_link = ROOT . "/" . $current_link;

	// Chuẩn bị chuỗi truy vấn
	$query_string = "";

	//duyệt mảng $_GET, nếu gặp phần tử có chỉ số là url thì bỏ qua
	// ngược lại nối vào chuỗi truy vấn &key=value
	foreach ($_GET as $key => $value)
	{
		if($key != 'url')
			$query_string .= "&".$key."=".$value;
	}

	// Nếu không có tham số 'page', thêm tham số 'page' vào chuỗi truy vấn
	if(!strstr($query_string, "page="))
	{
		$query_string .= "&page=".$page_number;
	}

	// bỏ dấu & ở cuối chuỗi truy vấn
	$query_string = trim($query_string,"&");

	// thêm chuỗi truy vấn vào current_link
	$current_link .= "?".$query_string;

	// Thay thế tham số 'page' trong URL bằng số trang hiện tại
	$current_link = preg_replace("/page=.*/", "page=".$page_number, $current_link);

	// Tạo các liên kết cho các trang kế tiếp, trang đầu tiên và trang trước đó
	$next_link = preg_replace("/page=.*/", "page=".($page_number+1), $current_link);
	$first_link = preg_replace("/page=.*/", "page=1", $current_link);
	$prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
	$prev_link = preg_replace("/page=.*/", "page=".$prev_page_number, $current_link);

	 // Trả về các liên kết phân trang và số trang hiện tại (mảng $result)
	$result = [
		'current_link'	=>$current_link,
		'next_link'		=>$next_link,
		'prev_link'		=>$prev_link,
		'first_link'	=>$first_link,
		'page_number'	=>$page_number,
	];

	return $result;
}

// thay đổi kích thước của một hình ảnh
function resize_image($filename, $max_size = 1000)
{
	// nếu file hình ảnh tồn tại
	if(file_exists($filename))
	{
		// Lấy loại định dạng của hình ảnh để xác định định dạng
		$type = mime_content_type($filename);

		// Mở hình ảnh theo định dạng
		switch ($type) {
			case 'image/jpeg':
				$image = imagecreatefromjpeg($filename);
				break;
			case 'image/png':
				$image = imagecreatefrompng($filename);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($filename);
				break;
			case 'image/webp':
				$image = imagecreatefromwebp($filename);
				break;
			default:
				return; 
		}

		// Lấy kích thước gốc của hình ảnh
		$src_width 	= imagesx($image); // Chiều rộng
		$src_height = imagesy($image); // Chiều cao

		// Kiểm tra xem chiều rộng hay chiều cao lớn hơn, để thay đổi kích thước sao cho phù hợp
		if($src_width > $src_height)
		{
			// Nếu chiều rộng nhỏ hơn kích thước tối đa thì không cần thay đổi kích thước
			if($src_width < $max_size)
			{
				$max_size = $src_width;
			}

			$dst_width 	= $max_size;
			  // Tính toán chiều cao tương ứng để giữ tỷ lệ gốc
			$dst_height = ($src_height / $src_width) * $max_size;
		}else{
			
			 // Nếu chiều cao nhỏ hơn kích thước tối đa thì không cần thay đổi kích thước
			if($src_height < $max_size)
			{
				$max_size = $src_height;
			}

			$dst_height = $max_size;
			 // Tính toán chiều rộng tương ứng để giữ tỷ lệ gốc
			$dst_width 	= ($src_width / $src_height) * $max_size;
		}

		 // Làm tròn kích thước
		$dst_height = round($dst_height);
		$dst_width 	= round($dst_width);

		// Tạo một hình ảnh mới với kích thước đã thay đổi
		$dst_image = imagecreatetruecolor($dst_width, $dst_height);

		  // Sao chép và thay đổi kích thước hình ảnh vào vùng mới
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
		
		// Lưu hình ảnh đã thay đổi kích thước với định dạng tương ứng
		switch ($type) {
			case 'image/jpeg':
				imagejpeg($dst_image, $filename, 90);
				break;
			case 'image/png':
				imagepng($dst_image, $filename, 90);
				break;
			case 'image/gif':
				imagegif($dst_image, $filename);
				break;
			case 'image/webp':
				imagewebp($dst_image, $filename, 90);
				break;

		}

	}
}

// xử lý các hình ảnh nhúng dưới dạng Base64 trong nội dung bài viết và lưu vào thư mục trên máy chủ
//sau đó thay thế các hình ảnh Base64 trong nội dung bằng đường dẫn đến tệp hình ảnh vừa lưu
function remove_images_from_content($content, $folder = 'uploads/')
{
    // Sử dụng biểu thức chính quy để tìm tất cả các thẻ <img> trong nội dung
    preg_match_all("/<img[^>]+/", $content, $matches);

    // Kiểm tra xem có bất kỳ thẻ <img> nào được tìm thấy không
    if(is_array($matches[0]) && count($matches[0]) > 0)
    {
        // Duyệt qua tất cả các thẻ <img> tìm được
        foreach ($matches[0] as $img) {

            // Nếu thẻ <img> không chứa dữ liệu Base64 (dạng hình ảnh nhúng), bỏ qua
            if(!strstr($img, "data:"))
            {
                continue;
            }

            // Lấy URL của hình ảnh từ thuộc tính src trong thẻ <img>
            preg_match('/src="[^"]+/', $img, $match);
            $parts = explode("base64,", $match[0]); // Tách phần Base64 từ src

            // Lấy tên tệp hình ảnh từ thuộc tính data-filename trong thẻ <img>
            preg_match('/data-filename="[^"]+/', $img, $file_match);
            $filename = $folder.str_replace('data-filename="', "", $file_match[0]); // Xây dựng đường dẫn tệp hình ảnh

            // Giải mã dữ liệu Base64 và lưu vào tệp
            file_put_contents($filename, base64_decode($parts[1]));

            // Thay thế phần src trong thẻ <img> bằng đường dẫn tệp vừa lưu
            $content = str_replace($match[0], 'src="'.$filename, $content);
        }
    }

    // Trả lại nội dung đã xử lý (với hình ảnh đã được thay thế)
    return $content;
}

//Thêm một tiền tố ROOT (đường dẫn gốc) vào tất cả các đường dẫn hình ảnh (src) trong nội dung HTML của bài viết
function add_root_to_images($content)
{
    // Tìm tất cả các thẻ <img> trong nội dung bài viết
    preg_match_all("/<img[^>]+/", $content, $matches);

    // Kiểm tra xem có thẻ <img> nào không
    if (is_array($matches[0]) && count($matches[0]) > 0) {
        // Duyệt qua từng thẻ <img> tìm thấy
        foreach ($matches[0] as $img) {
            // Lấy thuộc tính src từ thẻ <img>
            preg_match('/src="[^"]+/', $img, $match);

            // Thêm ROOT vào trước đường dẫn src
            $new_img = str_replace('src="', 'src="'.ROOT."/", $img);

            // Thay thế thẻ <img> cũ bằng thẻ <img> có đường dẫn đã thêm ROOT
            $content = str_replace($img, $new_img, $content);
        }
    }

    // Trả về nội dung đã được chỉnh sửa
    return $content;
}


// Hàm tạo bảng
function create_tables()
{
    // define("DBUSER" , "root");
    // define("DBPASS" , "");
    // define("DBNAME" , "myblog_db");
    // define("DBHOST" , "localhost");

    $string = "mysql:hostname=".DBHOST.";";
	$con = new PDO($string, DBUSER, DBPASS);

	$query = "create database if not exists ". DBNAME;
	$stm = $con->prepare($query);
	$stm->execute();

	$query = "use ". DBNAME;
	$stm = $con->prepare($query);
	$stm->execute();
    $query = "CREATE TABLE IF NOT EXISTS users (
      id int primary key auto_increment,
		username varchar(50) not null,
		email varchar(100) not null,
		phone varchar(20) not null,
		password varchar(255) not null,
		image varchar(1024) null,
		date datetime default current_timestamp,
		role varchar(10) not null,

		key username (username),
		key email (email)
    )";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $query = "CREATE TABLE IF NOT EXISTS categories (
        id INT PRIMARY KEY AUTO_INCREMENT,
        category VARCHAR(50) NOT NULL,
        slug VARCHAR(100) NOT NULL,
        disabled tinyint default 0,
        
        KEY (slug),
        KEY (category)
    )";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $query = "CREATE TABLE IF NOT EXISTS posts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT ,
        category_id INT ,
        title VARCHAR(100) NOT NULL,
        content text NOT NULL,
        image VARCHAR(1024) NOT NULL,
        date DATETIME DEFAULT CURRENT_TIMESTAMP,
        slug VARCHAR(100) NOT NULL,

        KEY (user_id),
        KEY (category_id),
        KEY (title),
        KEY (date),
        KEY (slug)
    )";
    $stmt = $con->prepare($query);
    $stmt->execute();
    /**
     * Xoá bảng
     *  $query = "DROP TABLE IF  EXISTS users()";
     * 
     * 
     */
};
