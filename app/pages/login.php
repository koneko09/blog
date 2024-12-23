<?php
if (!empty($_POST)) {
    // validate
    $errors = [];

    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $row = query($query, ['email' => $_POST['email']]);

    // $row = $row[['username' => 'Dung', 'email' => 'dung@gmail.com']];
    // Nếu mảng trả về có dữ liệu thì vào if
    if ($row) {
        $data = [];

        // password_verify(string $matKhauNhap, string $matKhauDuocMaHoaTrongSQL)
        // Trả về true nếu mật khẩu người dùng nhập vào khớp với mật khẩu đã mã hóa.
        // Trả về false nếu mật khẩu không khớp.
        if (password_verify($_POST['password'], $row[0]['password'])) {
            // Hàm xác thực đăng nhập
            authenticate($row[0]);
          //  header('Location: admin.php');
          if($row[0]['role'] == 'admin')
            redirect('admin');
          else if($row[0]['role'] == 'user')
            redirect('user');
        } else {
            $errors["email"] = "Email hoặc mật khẩu không chính xác!";
        }
    } else {
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

    <link href="<?php echo ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 	
  </head>
  <body class="text-center theme white-theme">
    
<main class="form-signin w-100 m-auto">

  <div class="login-form">
      <form method="post">
      <a href="<?php echo ROOT ?>/home">
        <img class="mb-4 rounded-circle shadow" src="<?php echo ROOT ?>/assets/images/logo1.jpg" alt="" width="92" height="92" style="object-fit: cover;">
      </a>
        <h1 class="h3 mb-3 fw-normal">Đăng Nhập</h1>
    
        <?php if(!empty( $errors['email'])){ ?>
          <div class="alert alert-danger ">
                <!-- vui lòng sửa các lỗi bên dưới! -->
                <?= $errors['email'] ?>
          </div>
          <?php }; ?>
    
          <div class="form-group">
              <input value="<?=old_value('email')?>" type="email" name="email" class="form-control" placeholder="Email" required="required">
            </div>
          <div class="form-group">    
              <input value="<?=old_value('password')?>" type="password" name="password" class="form-control" placeholder="Mật khẩu" required="required">
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
