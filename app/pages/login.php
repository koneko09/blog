<?php
if (!empty($_POST)) {
    // validate
    $errors = [];

    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $row = query($query, ['email' => $_POST['email']]);

    // $row = $row[['username' => 'Dung', 'email' => 'dung@gmail.com']];
    // Nếu mảng trả về có dữ liệu thì vào if
    if ($row)
    {
        $data = [];

        // password_verify(string $matKhauNhap, string $matKhauDuocMaHoaTrongSQL)
        // Trả về true nếu mật khẩu người dùng nhập vào khớp với mật khẩu đã mã hóa.
        // Trả về false nếu mật khẩu không khớp.
        if (password_verify($_POST['password'], $row[0]['password']))
        {
            // Hàm xác thực đăng nhập
            authenticate($row[0]);
          // nếu tk quyền hạn admin thì chuyển hướng đến trang admin
          if($row[0]['role'] == 'admin')
            redirect('admin');
          // nếu tk quyền hạn user thì chuyển hướng đến trang user
          else if($row[0]['role'] == 'user')
            redirect('user');
        }
        else
        {
            $errors["email"] = "Email hoặc mật khẩu không chính xác!";
        }
    }
    else
    {
        $errors["email"] = "Email hoặc mật khẩu không chính xác!";
    }
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>ĐĂNG NHẬP - <?php echo APP_NAME ?></title>

    <!-- Css Boostrap -->
    <link href="<?php echo ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 	
    <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Css form đăng nhập -->
    <style>
      .login-form {
      width: 340px;
      margin: 50px auto;
    }
    .login-form form {
      margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    </style>

    <!-- Css cho ẩn/ hiện mật khẩu -->
    <style>
    .an-hien-password {
        position: relative; /* Đặt vị trí của phần tử cha thành tương đối (relative),
                            giúp phần tử con (có position: absolute) định vị dựa trên phần tử cha này */
    }

    /* Định dạng phần tử toggle-password (biểu tượng con mắt) */
    .toggle-password {
        position: absolute; /* Định vị phần tử một cách tuyệt đối dựa trên phần tử cha có position: relative */
        top: 50%; /* Đặt phần tử ở giữa chiều cao của phần tử cha (50% từ trên xuống) */
        right: 10px; /* Đặt phần tử cách cạnh phải của phần tử cha 10 pixel */
        transform: translateY(-50%); /* Di chuyển phần tử lên một nửa chiều cao của chính nó 
                                        để căn giữa chính xác theo trục dọc */
        cursor: pointer; /* Thay đổi con trỏ chuột thành dạng "bàn tay" khi người dùng di chuột vào */
        color: #aaa; /* Đặt màu xám nhạt (#aaa) cho biểu tượng */
    }

    /* Thêm hiệu ứng khi người dùng di chuột qua biểu tượng toggle-password */
    .toggle-password:hover {
        color: #000; /* Khi di chuột vào, màu của biểu tượng sẽ chuyển từ xám nhạt (#aaa) sang đen (#000),
                        tạo cảm giác tương tác */
    }
    </style>

    <!-- JS cho ẩn hiện mật khẩu -->
    <script>
    function togglePassword(id, phanTu) {
        // lấy phần tử bằng id
        const input = document.getElementById(id);
        // Tìm thẻ i nằm bên trong phần tử
        const icon = phanTu.querySelector('i');

        // Nếu phần tử có type là password
        if (input.type === "password") {
            // set lại thành type text
            input.type = "text";
            // Loại bỏ lớp fa-eye(mắt mở) của thẻ i (icon)
            icon.classList.remove('fa-eye');
            // Thêm lớp fa-eye-slash(mắt đóng) cho thẻ i (icon)
            icon.classList.add('fa-eye-slash');
        }
        // Nếu phần tử có type không là password (text)
        else {
            // set lại thành type text
            input.type = "password";
            // Loại bỏ lớp fa-eye-slash(mắt đóng) của thẻ i (icon)
            icon.classList.remove('fa-eye-slash');
            // Thêm lớp fa-eye(mắt mở) cho thẻ i (icon)
            icon.classList.add('fa-eye');
        }
    }
    </script>

  
</head>

<body class="text-center">
    
<main class="form-signin w-100 m-auto">

  <div class="login-form">
      <form method="post">
      <a href="<?php echo ROOT ?>/home">
        <img class="mb-3 rounded-circle shadow" style="object-fit: cover;" src="<?php echo ROOT ?>/assets/images/logo1.jpg" alt="" width="92" height="92">
      </a>
        <h1 class="h3 mb-3">Đăng Nhập</h1>
    
        <!-- nếu có lỗi thì hiện cảnh báo -->
        <?php if(!empty( $errors['email'])){ ?>
          <div class="alert alert-danger ">
                <!-- vui lòng sửa các lỗi bên dưới! -->
                <?= $errors['email'] ?>
          </div>
        <?php }; ?>
    
          <div class="form-group an-hien-password">
              <input value="<?=old_value('email')?>" type="email" name="email" class="form-control" placeholder="Email" required="required">
          </div>
          <div class="form-group an-hien-password">    
              <input value="<?=old_value('password')?>" type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" required="required">
              <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fa fa-eye"></i>
              </span>
            </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          
          <div class="clearfix" style="margin-left: 20px;">
              <label class="pull-left checkbox-inline " ><input type="checkbox" > Ghi nhớ</label>
              <a href="<?php echo ROOT ?>/forgot" class="pull-right">Quên mật khẩu?</a>
          </div>   
          <p class="text-center">Bạn chưa có tài khoản? <a href="<?php echo ROOT ?>/register">Tạo tài khoản</a></p>     
      </form>
      
      <p class="mt-5 mb-3 text-muted"> <?php echo  date("Y") ?></p>
  </div>
</main>


    
  </body>
</html>
