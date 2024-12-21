<?php
if ($action == "add"): ?>
<div class="col-md-6 mx-auto">
<form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Tạo Thể Loại</h1>

    <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
            vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>

      

      <div class="form-floating">
	      <input value="<?=old_value('category')?>" name="category" type="text" class="form-control mb-2" id="floatingInput" placeholder="Category">
	      <label for="floatingInput">Tên thể loại</label>
	    </div>

          <?php if(!empty($errors['category'])):?>
          <div class="text-danger"><?=$errors['category']?></div>
          <?php endif;?>

    <div class="form-floating my-3">
	      <select name="disabled" class="form-select">
	      	<option value="0">Có</option>
	      	<option value="1">Không</option>
	      </select>
	      <label for="floatingInput">kích hoạt</label>
	    </div>

 

    <a href="<?=ROOT?>/admin/categories">
          <button class=" mt-4 w-100 btn btn-lg btn-primary" type="button">Quay lại</button>
    </a>

    <button class=" mt-4 w-100 btn btn-lg btn-primary" type="submit">Tạo</button>
  
  </form>
</div>
<?php elseif ($action == "edit"): 
    // Code for editing a user
?>
<div class="col-md-6 mx-auto">
	  <form method="post" enctype="multipart/form-data">

	    <h1 class="h3 mb-3 fw-normal">Chỉnh sửa thể loại</h1>

	    <?php if(!empty($row)):?>

		    <?php if (!empty($errors)):?>
		      <div class="alert alert-danger">Có lỗi xẩy ra!</div>
		    <?php endif;?>
 
		    <div class="form-floating">
		      <input value="<?=old_value('category', $row['category'])?>" name="category" type="text" class="form-control mb-2" id="floatingInput" placeholder="Username">
		      <label for="floatingInput">Tên thể loại</label>
		    </div>
		      <?php if(!empty($errors['category'])):?>
		      <div class="text-danger"><?=$errors['category']?></div>
		      <?php endif;?>
 
		    <div class="form-floating my-3">
		      <select name="disabled" class="form-select">
		      	<option <?=old_select('disabled','0',$row['disabled'])?> value="0">Có</option>
		      	<option <?=old_select('disabled','1',$row['disabled'])?> value="1">Không</option>
		      </select>
		      <label for="floatingInput">Kích hoạt</label>
		    </div>
 
 
		    <a href="<?=ROOT?>/admin/categories">
			    <button class="mt-4 btn btn-lg btn-primary" type="button">Trở lại</button>
			</a>
		    <button class="mt-4 btn btn-lg btn-primary  float-end" type="submit">Lưu</button>
		<?php else:?>

			<div class="alert alert-danger text-center">Không tìm thấy trang!</div>
		<?php endif;?>

	  </form>
	</div>
<?php elseif ($action == "delete"):
    // Code for deleting a user
?>         
<div class="col-md-6 mx-auto">
	  <form method="post">

	    <h1 class="h3 mb-3 fw-normal">Xoá thể loại</h1>

	    <?php if(!empty($row)):?>

		    <?php if (!empty($errors)):?>
		      <div class="alert alert-danger">Có lỗi xẩy ra!</div>
		    <?php endif;?>

		    <div class="form-floating">
		      <div class="form-control mb-2" ><?=old_value('category', $row['category'])?></div>
		    </div>
		      <?php if(!empty($errors['category'])):?>
		      <div class="text-danger"><?=$errors['category']?></div>
		      <?php endif;?>

		    <div class="form-floating">
		      <div class="form-control mb-2" ><?=old_value('slug', $row['slug'])?></div>
		    </div>
		      <?php if(!empty($errors['slug'])):?>
		      <div class="text-danger"><?=$errors['slug']?></div>
		      <?php endif;?>
 

		    <a href="<?=ROOT?>/admin/categories">
			    <button class="mt-4 btn btn-lg btn-primary" type="button">Trở lại</button>
			</a>
		    <button class="mt-4 btn btn-lg btn-danger  float-end" type="submit">Xoá</button>
		<?php else:?>

			<div class="alert alert-danger text-center">Không tìm thấy trang!!</div>
		<?php endif;?>

	  </form>
	</div>
<?php else: ?>


<h4>
    Thể Loại
    <a href="<?=ROOT?>/admin/categories/add">
    <button class="btn btn-primary">thêm mới</button>
    </a>
   
</h4>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Thể Loại</th>
            <th>Slug</th>
            <th>Tình Trạng</th>
            <th>chức năng</th>
        </tr>
        <?php

              $limit = 10;
              $offset = ($PAGE['page_number']-1) * $limit;
              $query = "SELECT * FROM categories ORDER BY id ASC LIMIT $limit OFFSET $offset";
              $rows = query($query);
        ?>
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                <td><?=$row['id']?></td>
                <td><?=esc($row['category'])?></td>
                <td><?=$row['slug']?></td>
                <td><?=$row['disabled'] ? 'Không':'Có'?></td>
                    <td>

                        <a href="<?= ROOT ?>/admin/categories/edit/<?= $row['id'] ?>">

                            <button class="btn btn-warning text-white btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </a>

                        <a href="<?= ROOT ?>/admin/categories/delete/<?= $row['id'] ?>">
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </a>
                    </td>
                    
                        
                    
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
  <div class="col-md-12 mb-4">
              <a href="<?=$PAGE['first_link']?>">
              <button class="btn btn-primary">Trang đầu</button>
              </a>
              <a href="<?=$PAGE['prev_link']?>">
              <button class="btn btn-primary">Trang trước</button>
              </a>
              <a href="<?=$PAGE['next_link']?>">
              <button class="btn btn-primary float-end">Trang sau</button>
              </a>
             
              
  </div>
</div>

<?php endif; ?>


