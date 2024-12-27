<!-- Nếu biến action == add (hành động thêm mới người dùng) -->
<?php 
 if($action=="add"){
  
    if(!empty($_POST))
    {
      // validate
      $erros = [];
  
      // Bắt lỗi username
      if(empty($_POST["username"]))
      {
         $erros["username"] = " bạn cần nhâp tên người dùng!";
      }
      // else if(!preg_match("/^[a-zA-z]+$/",$_POST['username']))
      // {
      //     $erros["username"] = "tên người dùng phải là ký tự và không có khoảng cách!";
      // }

      // Bắt lỗi password
      if(empty($_POST["password"]))
      {
        $erros["password"] = "Mật khẩu không được để trống";
      }
      // if(empty($_POST["rePassword"]))
      // {
      //   $erros["rePassword"] = "Vui lòng nhập lại mật khẩu";
      // }
      // else if(strlen($_POST["password"]) < 8)
      // {
      //     $erros["password"] = "mật khẩu phải lớn hơn 8 kí tự!";
      // }
      else if($_POST["password"] !== $_POST['rePassword'])
      {
          $erros["password"] = "mật khẩu không trùng khớp!";
      }

      
      
      $query = " select id from users where email = :email limit 1 ";
      $email = query($query,['email' => $_POST['email']]);
  
      // Bắt lỗi email
      if(empty($_POST["email"]))
      {
         $erros["email"] = " bạn cần nhập email!";
      }
      else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
      {
          $erros["email"] = "Địa chỉ email không khả dụng!";
      }
      else if($email)
      {
          $erros["email"] = "Địa chỉ email đã tồn tại!";
      }
  
      // validate image
      // định dạng tệp ảnh cho phép
      $allowed = ['image/jpeg','image/png','image/webp'];
      // kiểm tra xem tệp hình ảnh có được tải lên không
      if(!empty($_FILES['image']['name'])) //Tên tệp gốc.
      {
        $destination = "";
        //nếu định dạng không khớp thì báo lỗi
        if(!in_array($_FILES['image']['type'], $allowed))
        {
          $erros['image'] = "Image format not supported";
        }else
        {
          //nếu định dạng hợp lệ
          $folder = "uploads/";
          // Tạo thư mục uploads/ nếu chưa tồn tại.
          if(!file_exists($folder))
          {
            mkdir($folder, 0777, true); //0777 để cho phép đọc, ghi, và thực thi
          }

          // Tên tệp được đặt thành: uploads/{thời gian}{tên gốc} (nhằm tránh trùng tên)
          $destination = $folder . time() . $_FILES['image']['name'];
          // move_uploaded_file() di chuyển tệp từ đường dẫn tạm thời (tmp_name) đến vị trí đích ($destination)
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
          // thay đổi kích thước ảnh
          resize_image($destination);
        }

      }
    
      // Nếu không có lỗi (mảng erros rỗng)
      if(empty($erros))
      {
        //save to database
        $data = [];
        $data['username'] = $_POST['username'];
        $data['email']    = $_POST['email'];
        $data['role']     = $_POST['role'];
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "insert into users (username,email,password,role) values (:username,:email,:password,:role)";
        
        // nếu có ảnh tải lên
        if(!empty($destination))
        {
          $data['image']     = $destination;
          $query = "insert into users (username,email,password,role,image) values (:username,:email,:password,:role,:image)";
        }

        query($query, $data);

        redirect('admin/users');

      }
    }
  }
  
  //<!-- Nếu biến action == edit (hành động chỉnh sửa người dùng) -->
  else if($action=="edit")
  {
    $query = "SELECT * FROM users WHERE id = :id limit 1";
    $row = query_row($query,['id' => $id]);

      
    if(!empty($_POST))
    {
  
      if($row){

      
          // validate
          $erros = [];
      
          // Bắt lỗi username
          if(empty($_POST["username"]))
          {
            $erros["username"] = " bạn cần nhâp tên người dùng!";
          }
          
      
          
          // Bắt lỗi password
          if(!empty($_POST["password"]))
          {
            if($_POST["password"] !== $_POST['rePassword'])
            {
                $erros["password"] = "mật khẩu không trùng khớp!";
            }
          }

          // Bắt lỗi email
          $query = " select id from users where email = :email && id !=:id limit 1 ";
          $email = query($query,['email' => $_POST['email'],'id'=>$id]);
      
          if(empty($_POST["email"]))
          {
            $erros["email"] = " bạn cần nhập email!";
          }
          else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
          {
              $erros["email"] = "Địa chỉ email không khả dụng!";
          }
          else if($email)
          {
              $erros["email"] = "Địa chỉ email đã tồn tại!";
          }
          
          // validate image
          $allowed = ['image/jpeg','image/png','image/webp'];
          if(!empty($_FILES['image']['name']))
          {
            $destination = "";
            if(!in_array($_FILES['image']['type'], $allowed))
            {
              $errors['image'] = "Định dạng hình ảnh không được hỗ trợ!";
            }else
            {
              $folder = "uploads/avatar/";
              if(!file_exists($folder))
              {
                mkdir($folder, 0777, true);
              }

              // $destination = $folder . time() . $_FILES['image']['name'];
              $destination = $folder . $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);
              resize_image($destination);
            }

          }
        
          // Nếu không có lỗi (mảng erros rỗng)
          if(empty($erros))
          {
            $data = [];
            $data['username'] = $_POST['username'];
            $data['email']    = $_POST['email'];
            $data['role']     = $_POST['role'];
            $data['id']       = $id;

            $password_str     = "";
            $image_str        = "";

              if(!empty($_POST['password']))
              {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password_str = "password = :password, ";
              }

              // Nếu cập nhật ảnh
              if(!empty($destination))
              {
                $image_str = "image = :image, ";
                $data['image']       = $destination;
              }
            
              $query = "update users set username = :username, email = :email, $password_str $image_str role = :role where id = :id limit 1";

            query($query, $data);
            redirect('admin/users');

          }
        }
      }
    }


   //<!-- Nếu biến action == delete (hành động xoá người dùng) -->
  else if($action=="delete")
  {
    $query = "SELECT * FROM users WHERE id = :id limit 1";
    $row = query_row($query,['id' => $id]);

      
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      if($row){
          // validate
          $erros = [];
      
          // Nếu không có lỗi (mảng erros rỗng)
          if(empty($erros)){
            // delete from database
            $data = [];
            $data['id'] = $id;

            
            $query = "delete from users where id =:id limit 1 ";
            query($query,$data);
            
            if(file_exists($row['image']))
            {
              unlink($row['image']);
            }
            redirect('admin/users');
          }
        }
     }
    }


?>