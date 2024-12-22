<?php
// require_once "../core/function.php";

  // Dùng hàm logged_in để xác thực session đăng nhập
  if(!logged_in()){
    // header('Location: login.php');
    redirect("login");
  }
  if(!empty($_SESSION['USER']))
    unset($_SESSION['USER']);

  $session = isset($url[1]) ? $url[1] : "dashboard";

  $action = isset($url[2]) ? $url[2] : "view";

  $id = isset($url[3]) ? $url[3] : "id";
  
  // echo $session;
  // echo $action;

  // $action = $url[2] ?? "view";
  
  $file_name = "../app/pages/admin/".$session.".php";
  
   //file_exists trong PHP được sử dụng để kiểm tra xem một tệp có tồn tại không
   if (!file_exists($file_name)) {
    $file_name= "../app/pages/admin/erro.php";
  }

  if($session == 'users')
  {
    include_once "../app/pages/admin/user_controler.php";
  }
  else if($session == 'categories')
  {
    require_once "../app/pages/admin/categories_controler.php";
  }
  else if($session == 'posts')
  {
    require_once "../app/pages/admin/posts_controler.php";
  }
 
  
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Admin - My Blog</title>

   <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="<?=ROOT?>/assets/css/bootstrap-icons.css" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
    <link href="<?=ROOT?>/assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">My Blog</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
 
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?=ROOT?>/logout_admin"><i class="fa-solid fa-right-to-bracket"></i> Đăng Xuất</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          
          <li class="nav-item">
            <a class="nav-link <?=$session =='dashboard' ? 'active':''?>" aria-current="page" href="<?=ROOT?>/admin">
              <i class="bi bi-speedometer"></i> 
              Bảng Điều Khiển
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?=$session =='users' ? 'active':''?>" aria-current="page" href="<?=ROOT?>/admin/users">
              <i class="bi bi-person"></i> 
              Người Dùng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?=$session =='categories' ? 'active':''?>" aria-current="page" href="<?=ROOT?>/admin/categories">
              <i class="bi bi-tags"></i> 
              Thể Loại
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?=$session =='posts' ? 'active':''?>" aria-current="page" href="<?=ROOT?>/admin/posts">
              <i class="bi bi-file-post"></i> 
              Bài Viết
            </a>
          </li>

        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>OTHER</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>">
              <i class="bi bi-house"></i>
              Trang Chủ
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bảng điều khiển</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
        </div>
      </div>

        <?php

            require_once $file_name;
        
        ?>
    </main>
  </div>
</div>


    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
