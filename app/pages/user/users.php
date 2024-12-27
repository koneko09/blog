<!-- Nếu biến action == edit (hành động chỉnh sửa) -->
<?php if ($action == "edit"): ?>
<div class="col-md-6 mx-auto" >
<form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Chỉnh Sửa Tài Khoản</h1>

<!-- nếu tồn tại dữ liệu -->
<?php if(!empty($row)): ?>
    <!-- hiện lỗi nếu biến $erros có dữ liệu -->
    <?php if(!empty( $erros) ): ?>
      <div class="alert alert-danger ">
            vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>

      <div class="my-2">
		    	<label class="d-block">
		    		<img class="mx-auto d-block image-preview-edit" src="<?=get_image($row['image'])?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
		    		<input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
		    	</label>
		    	<?php if(!empty($erros['image'])):?>
			      <div class="text-danger"><?=$errors['image']?></div>
			    <?php endif;?>

		    	<script>
		    		
		    		function display_image_edit(file)
		    		{
		    			document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
		    		}
		    	</script>
		    </div>

    <div class="form-floating">
      <input value="<?=old_value('username', $row['username'])?>" type="text" name="username" class="form-control mb-2" id="floatingInput" placeholder="tên">
      <label for="floatingInput">Tên tài khoản</label>
    </div>

    <?php if( !empty( $erros['username'])): ?>
    <div class="text-danger"> <?=$erros['username'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('email',$row['email'])?>" type="email" name="email" class="form-control mb-2" id="floatingInput" placeholder="tên@gmail.com">
      <label for="floatingInput">Email</label>
    </div>

    <?php if( !empty( $erros['email'])): ?>
    <div class="text-danger"> <?=$erros['email'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('password')?>" type="password" name="password" class="form-control" id="floatingPassword" placeholder="mật khẩu">
      <label for="floatingPassword">Mật khẩu (nếu để trống thì mật khẩu sẽ giữ nguyên)</label>
    </div>
    <?php if( !empty( $erros['password'])): ?>
    <div class="text-danger"> <?=$erros['password'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('rePassword')?>" type="password" name="rePassword" class="form-control" id="floatingPassword" placeholder="nhập lại mật khẩu">
      <label for="floatingPassword">Nhập lại mật khẩu</label>
    </div>

    <a href="<?=ROOT?>/home">
			    <button class="mt-4 btn btn-lg btn-primary mb-3" type="button">Trang chủ</button>
			</a>
		    <button class="mt-4 btn btn-lg btn-primary mb-3  float-end" type="submit">Lưu thay đổi</button>
<?php else:?>
    <div class="alert alert-danger text-center">Không tìm thấy trang!</div>
<?php endif; ?>
</form>
</div>

<!-- Nếu action == delete (hành động chỉnh xoá)-->
<?php elseif ($action == "delete"): ?>         
<div class="col-md-6 mx-auto">
<form method="post">
    <h1 class="h3 mb-3 fw-normal">Xoá Tài Khoản</h1>

<?php if(!empty($row)): ?>
    <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
            vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>
    <div class="form-floating">
      <div class="form-control mb-2">
      <?=old_value('username',$row['username'])?>
    </div>

    <?php if( !empty( $erros['username'])): ?>
    <div class="text-danger"> <?=$erros['username'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
    <div class="form-control mb-2">
      <?=old_value('email',$row['email'])?>
    </div>
      
    </div>

    <?php if( !empty( $erros['email'])): ?>
    <div class="text-danger"> <?=$erros['email'] ?></div>
    <?php endif; ?>

   
    <a href="<?=ROOT?>/admin/users">
    <button class=" mt-4 w-100 btn btn-lg btn-primary" type="button">Quay lại</button>
    </a>

    <button class=" mt-4 w-100 btn btn-lg btn-danger" type="submit">Xoá tài khoản</button>
<?php else:?>
    <div class="alert alert-danger text-center">không tìm thấy trang!</div>
<?php endif; ?>
  </form>
</div>


<?php endif; ?>


