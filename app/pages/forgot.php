 <?php 
// include('connect.php');

if (!empty($_POST)) {
    // validate
    $errors = [];
    $showPasswordFields = false;

    // Kiểm tra số điện thoại trong cơ sở dữ liệu
    $query = "SELECT * FROM users WHERE phone = :phone LIMIT 1";
    $row = query($query, ['phone' => $_POST['phone']]);
    
    if ($row) {
        // Nếu số điện thoại tồn tại
        // $errors['phone'] = "Số điện thoại đã xác nhận, vui lòng đặt lại mật khẩu.";
        $showPasswordFields = true;

        // Xử lý khi người dùng gửi mật khẩu mới
        if (isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['rePassword']) && isset($_POST['account'])) {
            $password = $_POST['password'];
            $rePassword = $_POST['rePassword'];
            $phone = $_POST['phone'];
            $accountId = $_POST['account'];


            if ($accountId == '') {
                $errors['account'] = "Vui lòng chọn tài khoản.";
            }
            // Kiểm tra khớp mật khẩu
            if ($password != $rePassword) {
                $errors['password'] = "Mật khẩu không khớp.";
            } elseif (strlen($password) < 6) {
                $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự.";
            } else if(empty($errors)) {
                // Mã hóa mật khẩu bằng hàm password_hash
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Cập nhật mật khẩu vào cơ sở dữ liệu
                $query = "UPDATE `users` SET `password` = :passwords WHERE `id` = :id";
                $update = query_update($query, ['passwords' => $hashedPassword, 'id' => $accountId]); 


                if ($update) {
                    $errors['success'] = "Mật khẩu đã được đặt lại thành công!";
                    redirect('login');
                } else {
                    $errors['password'] = "Đã xảy ra lỗi khi đặt lại mật khẩu.";
                }
            }
        }
    } else {
        // Nếu số điện thoại không tồn tại
        $errors['phone'] = "Số điện thoại không chính xác!";
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
      <form  method="post">
      <a href="<?php echo ROOT ?>/home">
        <img class="mb-4 rounded-circle shadow" src="<?php echo ROOT ?>/assets/images/logo1.jpg" alt="" width="92" height="92" style="object-fit: cover;">
      </a>
        <h1 class="h3 mb-3 fw-normal">Quên mật khẩu</h1>
    
        <?php if( !empty( $errors['phone']) ): ?>
          <div class="alert alert-danger ">
                 <?= $errors['phone'] ?>
          </div>
        <?php endif; ?>
    
        <?php if( !empty( $errors['success']) ): ?>
            <div class="alert alert-success ">
                 <?= $errors['success'] ?>
            </div>
        <?php endif; ?>
        
        <div class="form-group">
            <input value="<?=old_value('phone')?>" 
              type="tel" 
              name="phone" 
              class="form-control" 
              placeholder="Dạng số: 0312345678"
              <?= isset($showPasswordFields) && $showPasswordFields ? 'readonly' : '' ?>
              required 
              pattern="([0]{1}([3:9:5]{1})([0-9]{8}))">
          </div>

       <div id="passwordFields" style="display: <?= isset($showPasswordFields) && $showPasswordFields ? 'block' : 'none' ?>;">
            <div class="form-group">
            <select name="account" class="form-select p-3">
                <?php
                    $query = "select * from users where phone = :phone order by id desc";
                    $account = query($query, ['phone' => $_POST['phone']]);
                ?>
                <option value="">--Chọn tài khoản--</option>
                <?php if(!empty($account)):?>
                    <?php foreach($account as $ac):?>
                        <option <?=old_select('account',$ac['id'])?> value="<?=$ac['id']?>"><?=$ac['email']?></option>
                    <?php endforeach;?>
                <?php endif;?>

            </select>
            </div>
            <?php if( !empty( $errors['account'])): ?>
            <div class="text-danger" style="text-align: left;"> <?=$errors['account'] ?></div>
            <?php endif; ?>
            <div class="form-group an-hien-password">    
                <input value="<?=old_value('password')?>" type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <?php if( !empty( $errors['password'])): ?>
                <div class="text-danger"> <?=$errors['password'] ?></div>
            <?php endif; ?>
            <div class="form-group an-hien-password">    
              <input value="<?=old_value('rePassword')?>" type="password" name="rePassword" id="rePassword" class="form-control" placeholder="Nhập lại khẩu">
              <span class="toggle-password" onclick="togglePassword('rePassword', this)">
                <i class="fa fa-eye"></i>
              </span>
            </div>

       </div>
        
        <div class="form-group">
              <button type="submit" id="submit" class="btn btn-primary btn-block"><?= isset($showPasswordFields) && $showPasswordFields ? 'Đổi mật khẩu' : 'Lấy lại mật khẩu' ?></button>
          </div>
          <div class="clearfix">
              <a href="<?php echo ROOT ?>/login" class="pull-left">Đăng nhập</a>
              <a href="<?php echo ROOT ?>/register" class="pull-right">Đăng ký</a>
          </div>  
      </form>
      <p class="mt-5 mb-3 text-muted"> <?php echo  date("Y") ?></p>
    </div>
</main>
</body>
</html>
