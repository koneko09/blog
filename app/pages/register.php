<?php
  if(!empty($_POST))
  {
    // validate
    $erros = [];

    if(empty($_POST["username"]))
    {
       $erros["username"] = " bạn cần nhâp tên người dùng!";
    }
    //!preg_match("/^[a-zA-z0-9 \-\_\&]+$/",$_POST['username'])
    else if(false)
    {
        $erros["username"] = "tên người dùng phải là ký tự!";
    }

    if(empty($_POST["password"]))
    {
       $erros["password"] = " bạn cần nhâp mật khẩu!";
    }
    else if(strlen($_POST["password"]) < 8)
    {
        $erros["password"] = "mật khẩu phải lớn hơn 8 kí tự!";
    }
    else if($_POST["password"] !== $_POST['rePassword'])
    {
        $erros["password"] = "mật khẩu không trùng khớp!";
    }
    
    $query = " select id from users where email = :email limit 1 ";
    $email = query($query,['email' => $_POST['email']]);

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

    if(empty($_POST["terms"]))
    {
       $erros["terms"] = "vui lòng chấp nhận các điều khoản!";
    }

    if(empty($erros)){
      // save database
      $data = [];
      $data['username'] = $_POST['username'];
      $data['email'] = $_POST['email'];
      $data['role'] = "user";
      $data['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT ) ;
      $query = " insert into users(username,email,password,role) values(:username,:email,:password,:role) ";
      query($query,$data);


      redirect('login');
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>ĐĂNG KÍ - <?php echo APP_NAME ?></title>

    <!-- Custom Css -->
    <link href="<?php echo ROOT ?>/assets/css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/all.css">
    <script src="<?php echo ROOT ?>/assets/js/function.js" defer></script>
    <!-- Css Bootstrap -->
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
  <body class="text-center theme white-theme">
    
<main class="form-signin w-100 m-auto">

  <div class="login-form">
      <form method="post">
      <a href="<?php echo ROOT ?>/home">
        <img class="mb-4 rounded-circle shadow" src="<?php echo ROOT ?>/assets/images/logo1.jpg" alt="" width="92" height="92" style="object-fit: cover;">
      </a>
        <h1 class="h3 mb-3 fw-normal">Đăng Ký</h1>
          <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
        Vui lòng sửa các lỗi bên dưới!
      </div>
    <?php endif; ?>

          <div class="form-group">
              <input value="<?=old_value('username')?>" type="text" name="username" class="form-control" placeholder="Tên tài khoản" required="required">
          </div>
          <?php if( !empty( $erros['username'])): ?>
          <div class="text-danger" style="text-align: left;"> <?=$erros['username'] ?></div>
          <?php endif; ?>
          <div class="form-group">
            <input value="<?=old_value('phone')?>" 
              type="tel" 
              name="phone" 
              class="form-control" 
              placeholder="Dạng số: 0312345678" 
              required 
              pattern="([0]{1}([3:9:5]{1})([0-9]{8}))">
          </div>
          <div class="form-group">
              <input value="<?=old_value('email')?>" type="email" name="email" class="form-control" placeholder="Email" required="required">
          </div>
          <?php if( !empty( $erros['email'])): ?>
    <div class="text-danger" style="text-align: left; margin-top: 0px; padding-top: 0px;"> <?=$erros['email'] ?></div>
    <?php endif; ?>
          <div class="form-group an-hien-password">    
              <input value="<?=old_value('password')?>" type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" required="required">
              <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
          <?php if( !empty( $erros['password'])): ?>
    <div class="text-danger" style="text-align: left;"> <?=$erros['password'] ?></div>
    <?php endif; ?>
          <div class="form-group an-hien-password">    
              <input value="<?=old_value('rePassword')?>" type="password" name="rePassword" id="rePassword" class="form-control" placeholder="Nhập lại khẩu" required="required">
              <span class="toggle-password" onclick="togglePassword('rePassword', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
          <div class="checkbox mb-3">
          <label>
            <input <?=old_check('terms')?> type="checkbox" name="terms" value="remember-me"> Chấp nhận các điều khoản
          </label>
          <?php if( !empty( $erros['terms'])): ?>
          <div class="text-danger"> <?=$erros['terms'] ?></div>
          <?php endif; ?>
          </div>  
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
          </div>
          <div class="clearfix">
              <a href="<?php echo ROOT ?>/login" class="pull-left">Đăng nhập</a>
              <a href="<?php echo ROOT ?>/forgot" class="pull-right">Quên mật khẩu?</a>
          </div>        
      </form>
      <p class="mt-5 mb-3 text-muted"> <?php echo  date("Y") ?></p>
  </div>
</main>


    
  </body>
</html>
