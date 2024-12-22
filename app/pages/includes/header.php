<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>HOME - <?php echo APP_NAME ?> </title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="<?php echo ROOT ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT ?>/assets/css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/all.css">
    <script src="<?php echo ROOT ?>/assets/js/function.js" defer></script>

    <style>
      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

    </style>  

    
    <!-- Custom styles for this template -->
    <link href="<?php echo ROOT ?>/assets/css/headers.css" rel="stylesheet">
  </head>
  <body id="home" class='theme white-theme'>

  <header class="p-3 border-bottom">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="<?=ROOT?>/home" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img class="bi me-2"  src="<?php echo ROOT ?>/assets/images/logo.jpg" alt="" width="100%" height="52" style="object-fit: cover;">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?=ROOT?>" class="nav-link px-2 <?=$url[0] =='home' ? 'link-primary':'link-dark'?>">Trang chủ</a></li>
          <li><a href="<?=ROOT?>/blog" class="nav-link px-2  <?=$url[0] =='blog' ? 'link-primary':'link-dark'?>">Bài viết</a></li>
          <li>
            <span class="nav-link px-2 link-dark dropdown text-end">
              <a href="#" class="d-block <?=$url[0] =='category' ? 'link-primary':'link-dark'?> text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Thể loại
              </a>
              <ul class="dropdown-menu text-small">
               
               <?php  

                  $query = "select * from categories order by id desc";
                  $categories = query($query);
                ?>
                <?php if(!empty($categories)):?>
                  <?php foreach($categories as $cat):?>
                    <li><a class="dropdown-item" href="<?=ROOT?>/category/<?=$cat['slug']?>"><?=$cat['category']?></a></li>
                  <?php endforeach;?>
                <?php endif;?>

                
              
              </ul>
            </span>
          </li>
          <li>
          <li><a href="<?=ROOT?>/contact" class="nav-link px-2  <?=$url[0] =='contact' ? 'link-primary':'link-dark'?>">Liên hệ</a></li>
            
          </li>
          <li>
            
          </li>
        </ul>

        <form action="<?=ROOT?>/search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <div class="input-group">
          <input value="<?= $_GET['find']?? ''?>" name="find" type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Search">
          <button class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
          </div>
        </form>
        <button 
              id="themeButton"
              onclick="changeTheme()"
              class="theme-button"
            >
              🌚
            </button>

      <?php if(!logged_in() && !logged_in_user()): ?>
          <a style="margin-right:0px;" class="btn btn-light" href="<?=ROOT?>/login"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a>
      <?php endif; ?>

      <?php if(logged_in()): ?>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
         <!-- chưa lấy được ảnh -->
          <img src="<?=get_image($_SESSION['ADMIN']['image'])?>" alt="mdo" style="object-fit: cover;" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <!-- đây sẽ là chỗ xem thêm tin bản thân -->
            <li><a class="dropdown-item" href="#">Xin chào, <?=user('username')?></a></li>
          <!-- thêm chức năng admin sẽ là người vào được chức năng này -->
            <li><a class="dropdown-item" href="<?=ROOT?>/admin">Admin</a></li>
        
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/logout_admin">Đăng xuất</a></li>
          </ul>
        </div>
      <?php endif; ?>
      <?php if(logged_in_user()): ?>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
         <!-- chưa lấy được ảnh -->
          <img src="<?=get_image(user('image'))?>" alt="mdo" style="object-fit: cover;" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <!-- đây sẽ là chỗ xem thêm tin bản thân -->
            <li><a class="dropdown-item" href="#">Xin chào, <?=user('username')?></a></li>
          <!-- thêm chức năng admin sẽ là người vào được chức năng này -->
            <li><a class="dropdown-item" href="<?=ROOT?>/user">Quản lý</a></li>
        
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?=ROOT?>/logout">Đăng xuất</a></li>
          </ul>
        </div>
      <?php endif; ?>

      <div class="radio" id="draggable-radio">
  <div class="radio-antens">🎵</div>
  <p id="current-song-title" class="playing-song">New Home (Slowed)</p>
  <audio controls id="music" style="display:none">
    <source id="music-source" src="<?php echo ROOT ?>/assets/music/New Home (Slowed).mp3">
  </audio>

  <div style="display: flex">
    <button id="previousSongBtn" style="background: gray; border-right: none;" onclick="previousSong()" aria-label="Previous Song">⏮️</button>
    <button id="playMusicBtn" style="background: gray; border-right: none; border-left: none;" onclick="playMusic()" aria-label="Play/Pause Song">▶️</button>
    <button id="nextSongBtn" style="background: gray; border-left: none;" onclick="nextSong()" aria-label="Next Song">⏭️</button>
  </div>

  <style>
    .radio {
      display: flex;
      height: 5rem;
      width: 8rem;
      justify-content: center;
      border-radius: 20px;
      flex-wrap: wrap;
      position: fixed;
      top: 50px;
      right: 8%;
      z-index: 100;
      cursor: move; /* Chỉ thị cho người dùng biết rằng nó có thể di chuyển */
    }
    .playing-song {
      text-align: center; 
      font-weight: bold; 
      margin-top: 10px;
      background: rgba(0,0,0,0.5);
      transition: opacity 0.5s ease;
      padding: 10px;
      border-radius: 10px;
      color: white;
      user-select: none; /* Chống highlight văn bản */
    }
    .playing-song.fade-out {
      opacity: 0;
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
      currentSong = (currentSong - 1 + playlist.length) % playlist.length;
            let music = document.getElementById('music');
      let musicSource = document.getElementById('music-source');
      musicSource.src = playlist[currentSong];
      music.load();
      music.play();
      updateSongTitle();
      updatePlayButton();;
    }

    function nextSong() {
      currentSong = (currentSong + 1) % playlist.length;
            let music = document.getElementById('music');
      let musicSource = document.getElementById('music-source');
      musicSource.src = playlist[currentSong];
      music.load();
      music.play();
      updateSongTitle();
      updatePlayButton();;
    }


    function updateSongTitle() {
      const songTitle = playlist[currentSong].split('/')[8].replace('.mp3', '');
      const songTitleElement = document.getElementById('current-song-title');
      
      // Chỉnh animation
      songTitleElement.classList.add('fade-out');

      setTimeout(() => {
        songTitleElement.innerText = `${songTitle}`;
        songTitleElement.classList.remove('fade-out');
      }, 500);
    }

    function updatePlayButton() {
      let playMusicBtn = document.getElementById('playMusicBtn');
      playMusicBtn.innerHTML = '⏸️';
    }

    document.getElementById('music').addEventListener('ended', nextSong);

    // Them tính năng kéo thả
    const radioElement = document.getElementById('draggable-radio');
    let isDragging = false;
    let cordinateX, cordinateY;

    radioElement.addEventListener('mousedown', (e) => {
      isDragging = true;
      cordinateX = e.clientX - radioElement.getBoundingClientRect().left;  // vị trí X
      cordinateY = e.clientY - radioElement.getBoundingClientRect().top;   // vị trí y
      radioElement.style.transition = 'none'; // Tắt transition khi kéo
    });

    document.addEventListener('mousemove', (e) => {
      if (isDragging) {
        radioElement.style.left = `${e.clientX - cordinateX}px`;
        radioElement.style.top = `${e.clientY - cordinateY}px`;
      }
    });

    document.addEventListener('mouseup', () => {
      isDragging = false;
      radioElement.style.transition = 'left 0.3s ease, top 0.3s ease'; // Bật lại transition sau khi ngừng kéo
    });
  </script>
</div>

  </header>

  <?php
    if($url[0] == "home")
        include '../app/pages/includes/slider.php'; 
  
  ?>
 <main class="p-4">
 