<?php 
if (!empty($_POST)) {
    // validate
    $errors = [];

    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $row = query($query, ['email' => $_POST['email']]);

    if ($row) {
        // save database
        $data = [];

        if (password_verify($_POST['password'], $row[0]['password'])) {
            // access
            authenticate($row[0]);
          //  header('Location: admin');
          redirect('admin');
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
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form method="post">
  <a href="<?php echo ROOT ?>/home">
    <img class="mb-4 rounded-circle shadow" src="<?php echo ROOT ?>/assets/images/logo.jpg" alt="" width="92" height="92" style="object-fit: cover;">
  </a>
    <h1 class="h3 mb-3 fw-normal">Đăng Nhập</h1>

    <?php if( !empty( $erros['email']) ): ?>
      <div class="alert alert-danger ">
            <!-- vui lòng sửa các lỗi bên dưới! -->
             <?= $erros['email'] ?>
      </div>
      <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('email')?>" type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input value="<?=old_value('password')?>" type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Mật Khẩu</label>
    </div>
      <div class="my-2">
        Chưa có tài khoản? <a href="<?php echo ROOT ?>/register">Đăng kí</a>
      </div>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" name="remember" value="1"> nhớ mặt khẩu
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Đăng Nhập</button>
    <p class="mt-5 mb-3 text-muted"> <?php echo  date("Y") ?></p>
  </form>
</main>


    
  </body>
</html>
