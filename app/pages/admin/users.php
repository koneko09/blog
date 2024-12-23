<?php
if ($action == "add"): ?>
<div class="col-md-6 mx-auto">
<form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Tạo Tài Khoản</h1>

    <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
            vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>

      <div class="my-2">
	    	<label class="d-block">
	    		<img class="mx-auto d-block image-preview-edit" src="<?=get_image('')?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
	    		<input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
	    	</label>
	    	<?php if(!empty($errors['image'])):?>
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
      <select name="role" class="form-select my-3">
        <option value="user">User</option>
        <option value="admin">Admin</option>

      </select>
      <label for="floatingInput">Vai trò</label>
    </div>

    <?php if( !empty( $erros['role'])): ?>
    <div class="text-danger"> <?=$erros['role'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('password')?>" type="password" name="password" class="form-control" id="floatingPassword" placeholder="mật khẩu">
      <label for="floatingPassword">Mật khẩu</label>
    </div>
    <?php if( !empty( $erros['password'])): ?>
    <div class="text-danger"> <?=$erros['password'] ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input value="<?=old_value('rePassword')?>" type="password" name="rePassword" class="form-control" id="floatingPassword" placeholder="nhập lại mật khẩu">
      <label for="floatingPassword">Nhập lại mật khẩu</label>
    </div>
    <a href="<?=ROOT?>/admin/users">
          <button class=" mt-4 w-100 btn btn-lg btn-primary" type="button">Quay lại</button>
    </a>

    <button class=" mt-4 w-100 btn btn-lg btn-primary" type="submit">Đăng Kí</button>
  
  </form>
</div>

<!-- Nếu biến action == edit -->
<?php elseif ($action == "edit"): ?>
<div class="col-md-6 mx-auto" >
<form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Chỉnh Sửa Tài Khoản</h1>

<?php if(!empty($row)): ?>
    <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
            vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>

      <div class="my-2">
		    	<label class="d-block">
		    		<img class="mx-auto d-block image-preview-edit" src="<?=get_image($row['image'])?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
		    		<input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
		    	</label>
		    	<?php if(!empty($errors['image'])):?>
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
      <select name="role" class="form-select my-3">
        <option <?=old_select('role','user',$row['role'])?> value="user">User</option>
        <option <?=old_select('role','admin',$row['role'])?> value="admin">Admin</option>

      </select>
      <label for="role">Vai trò</label>
    </div>

    <?php if( !empty( $erros['role'])): ?>
    <div class="text-danger"> <?=$erros['role'] ?></div>
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

    <a href="<?=ROOT?>/admin/users">
			    <button class="mt-4 btn btn-lg btn-primary mb-3" type="button">Quay lại</button>
			</a>
		    <button class="mt-4 btn btn-lg btn-primary mb-3  float-end" type="submit">Lưu thay đổi</button>
<?php else:?>
    <div class="alert alert-danger text-center">không tìm thấy trang!</div>
<?php endif; ?>
  </form>
</div>

<!-- Nếu action == delete -->
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

<!-- Nếu action == view -->
<?php else: ?>
  <h4 class="d-flex justify-content-between align-items-center">
    <span>USERS</span>
    <a href="<?=ROOT?>/admin/users/add">
        <button class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
        </button>
    </a>
</h4>

<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Avatar</th>
            <th>Ngày tạo</th>
            <th>Chức năng</th>
        </tr>
        <?php

              $limit = 10;
              $offset = ($PAGE['page_number']-1) * $limit;
              $query = "SELECT * FROM users ORDER BY id ASC LIMIT $limit OFFSET $offset";
              $rows = query($query);
        ?>
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= esc($row['username']) ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
					              <img src="<?=get_image($row['image'])?>" style="width: 100px;height: 100px;object-fit: cover;">
				            </td>
                    <td><?= $row['date'] ?></td>
                    <td>
                    <a href="<?= ROOT ?>/admin/users/edit/<?= $row['id'] ?>">

                        <button class="btn btn-warning text-white btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>

                    <a href="<?= ROOT ?>/admin/users/delete/<?= $row['id'] ?>">
                        <button class="btn btn-danger btn-sm">
                             <i class="bi bi-trash-fill"></i>
                         </button>
                    </a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <div class="row">
    <div class="col-md-4 mb-4">
      <a href="<?=$PAGE['first_link']?>">
      <button class="btn btn-primary"><i class="fas fa-angle-double-left me-2"></i> Trang đầu</button>
      </a>
    </div>
    <div class="col-md-4 mb-4">
      <a href="<?=$PAGE['prev_link']?>">
      <button class="btn btn-primary"><i class="fas fa-angle-left me-2"></i> Trang trước</button>
      </a>
    </div>
    <div class="col-md-4 mb-4">
      <a href="<?=$PAGE['next_link']?>">
      <button class="btn btn-primary float-end">Trang sau <i class="fas fa-angle-right ms-2"></i></button>
      </a>
    </div>
  </div>
</div>

<?php endif; ?>


