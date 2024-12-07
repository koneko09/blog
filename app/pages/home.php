<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>HOME - <?php echo APP_NAME ?> </title>


    <link href="<?php echo ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT ?>/assets/css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/all.css">
    <script src="<?php echo ROOT ?>/assets/js/function.js" defer></script>

    <style>
      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }
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
    <link href="<?php echo ROOT ?>/assets/css/headers.css" rel="stylesheet">
  </head>
  <body id="home" class='theme white-theme'>
  <header class="p-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img class="bi me-2"  src="<?php echo ROOT ?>/assets/images/logo.jpg" alt="" width="60" height="52" style="object-fit: cover; border-radius: 20px;">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Trang chủ</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Blog</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Liên hệ</a></li>
          <li>
            <button 
              id="themeButton"
              onclick="changeTheme()"
              class="theme-button"
            >
              🌚
            </button>
          </li>
          <div class="radio">
            <div class="radio-antens">
              \/
            </div>
            <audio controls id="music" style="display:none">
              <source id="music-source" src="<?php echo ROOT ?>/assets/music/New Home (Slowed).mp3">
            </audio>

            <div style="display: flex">
              <button id="previousSongBtn"  style="background: gray; border-right: none;"  onclick="previousSong()">⚫</button>
              <button id="playMusicBtn"     style="background: gray; border-right: none; border-left: none;"  onclick="playMusic()">▶️</button>
              <button id="nextSongBtn"      style="background: gray; border-left: none;"  onclick="nextSong()">⚫</button>
            </div>
            <style>
              .radio {
                display: flex;
                height: 5rem;
                width: 2rem;
                justify-content: center;
                border-radius: 20px;
                flex-wrap: wrap;
                position: absolute;
                top: -15px;
                right: 8%;
                z-index: 100;
              }
              
              .radio-antens {
                font-weight: 1000;
                position: relative;
                color: black;
                top: 19px;
              }
            </style>
            <script>
              let currentSong = 0;

              const playlist = [
                "<?php echo ROOT ?>/assets/music/Beautiful Memories.mp3",
                "<?php echo ROOT ?>/assets/music/Jacob and the Stone - Minari.mp3",
                "<?php echo ROOT ?>/assets/music/Je Te Laisserai Des Mots (Extended).mp3",
                "<?php echo ROOT ?>/assets/music/New Home (Slowed).mp3",
                "<?php echo ROOT ?>/assets/music/Dreamcore.mp3"
              ];

              function playMusic() {
                let playMusicBtn = document.getElementById('playMusicBtn');
                let music = document.getElementById('music');

                if (playMusicBtn.innerHTML.trim() === '▶️') {
                  playMusicBtn.innerHTML = '⏸️';
                  music.play();
                } else if (playMusicBtn.innerHTML.trim() === '⏸️') {
                  playMusicBtn.innerHTML = '▶️';
                  music.pause();
                }
              }

              function previousSong() {
                let music = document.getElementById('music');
                let musicSource = document.getElementById("music-source");

                currentSong = (currentSong - 1 + playlist.length) % playlist.length;
                console.log(`Song number ${currentSong}: ${playlist[currentSong].split('<?php echo ROOT ?>/assets/music/')[1].split('.mp3')[0]}`)
                musicSource.src = playlist[currentSong];

                music.load();
                music.play();
                updatePlayButton();
              }

              function nextSong() {
                let music = document.getElementById('music');
                let musicSource = document.getElementById("music-source");

                currentSong = (currentSong + 1) % playlist.length;
                console.log(`Song number ${currentSong}: ${playlist[currentSong].split('<?php echo ROOT ?>/assets/music/')[1].split('.mp3')[0]}`)
                musicSource.src = playlist[currentSong];

                music.load();
                music.play();
                updatePlayButton();
              }

              function updatePlayButton() {
                let playMusicBtn = document.getElementById('playMusicBtn');
                playMusicBtn.innerHTML = '⏸️';
              }

              document.getElementById('music').addEventListener('ended', function() {
                nextSong();
              })
            </script>
          </div>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/admin">Admin</a></li>
            <li><a class="dropdown-item" href="#">Cài đặt</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/logout">Đăng xuất</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <!-- slider -->
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/slider/ism/css/my-slider.css"/>
<script src="<?php echo ROOT ?>/assets/slider/ism/js/ism-2.2.min.js"></script>

<div class="ism-slider" data-transition_type="fade" data-play_type="loop" id="my-slider">
  <ol>
    <li>
      <img src="<?php echo ROOT ?>/assets/slider/ism/image/slides/flower-729514_1280.jpg">
      <div class="ism-caption ism-caption-0">My slide caption text</div>
    </li>
    <li>
      <img src="<?php echo ROOT ?>/assets/slider/sm/image/slides/beautiful-701678_1280.jpg">
      <div class="ism-caption ism-caption-0">My slide caption text</div>
    </li>
    <li>
      <img src="<?php echo ROOT ?>/assets/slider/ism/image/slides/summer-192179_1280.jpg">
      <div class="ism-caption ism-caption-0">My slide caption text</div>
    </li>
    <li>
      <img src="<?php echo ROOT ?>/assets/slider/ism/image/slides/city-690332_1280.jpg">
      <div class="ism-caption ism-caption-0">My slide caption text</div>
    </li>
  </ol>
</div>
<!-- end slider -->
 <main class="p-4">
 <h3 class="mx-4">Nổi bật</h3>

 <div class="row my-2">

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-lg-auto col-12 d-lg-block">
            <img src="<?php echo ROOT ?>/assets/images/3.jpg" alt="" class="bd-placeholder-img" style="max-width: 200px; object-fit: cover;" width="200" height="250">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h3 class="mb-0">Post title</h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-lg-auto col-12 d-lg-block">
        <img src="<?php echo ROOT ?>/assets/images/4.jpg" alt="" class="bd-placeholder-img" style="max-width: 200px; object-fit: cover;" width="200" height="250">

        </div>
      </div> 
    </div>

  </div>
  
 </main>
  <div class="container">
  <footer class="py-5">
    <div class="row">
      <div class="col-6 col-md-2 mb-3">
        <h5>Liên quan</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="<?php echo ROOT ?>/login" class="nav-link p-0 text-muted">Login</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
      <p>&copy; 2022 Company, Inc. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
      </ul>
    </div>
  </footer>
</div>

    <script src="<?php echo ROOT ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>