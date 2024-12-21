<?php
  if(!empty($_POST))
  {
    // validate
    $erros = [];

    if(empty($_POST["username"]))
    {
       $erros["username"] = " bạn cần nhâp tên người dùng!";
    }
    else if(!preg_match("/^[a-zA-z0-9 \-\_\&]+$/",$_POST['username']))
    {
        $erros["username"] = "tên người dùng phải là ký tự và không có khoảng cách!";
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

    <link href="<?php echo ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?php echo ROOT ?>/assets/css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/all.css">
    <script src="<?php echo ROOT ?>/assets/js/function.js" defer></script>
  </head>
  <body class="text-center theme white-theme">
    
<main class="form-signin w-100 m-auto">
  <form method="post">
    <a href="<?php echo ROOT ?>/home">
    <img class="mb-4 rounded-circle shadow" src="<?php echo ROOT ?>/assets/images/logo.jpg" alt="" width="92" height="92" style="object-fit: cover;">
    </a>
    <h1 class="h3 mb-3 fw-normal">Tạo Tài Khoản</h1>

    <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
        vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>
    <div class="form-floating">
      <input value="<?=old_value('username')?>" type="text" name="username" class="form-control mb-2" id="floatingInput" placeholder="tên">
      <label for="floatingInput">Tên tài khoản</label>
    </div>

    <?php if( !empty( $erros['username'])): ?>
    <div class="text-danger"> <?=$erros['username'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('email')?>" type="email" name="email" class="form-control mb-2" id="floatingInput" placeholder="tên@gmail.com">
      <label for="floatingInput">Email</label>
    </div>

    <?php if( !empty( $erros['email'])): ?>
    <div class="text-danger"> <?=$erros['email'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('password')?>" type="password" name="password" class="form-control" id="floatingPassword" placeholder="mật khẩy">
      <label for="floatingPassword">Mật khẩu</label>
    </div>
    <?php if( !empty( $erros['password'])): ?>
    <div class="text-danger"> <?=$erros['password'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('rePassword')?>" type="password" name="rePassword" class="form-control" id="floatingPassword" placeholder="nhập lại mật khẩu">
      <label for="floatingPassword">Nhập lại mật khẩu</label>
    </div>
    <div class="my-2">
        Đã có tài khoản? <a href="<?php echo ROOT ?>/login">Đăng nhập</a>
      </div>
    <div class="checkbox mb-3">
      <label>
        <input <?=old_check('terms')?> type="checkbox" name="terms" value="remember-me"> Chấp nhận các điều khoản
      </label>
      <?php if( !empty( $erros['terms'])): ?>
    <div class="text-danger"> <?=$erros['terms'] ?></div>
    <?php endif; ?>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Đăng Kí</button>
    <p class="mt-5 mb-3 text-muted"> <?php echo  date("Y") ?></p>
  </form>
</main>


    
  </body>
</html>
