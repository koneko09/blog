<?php
if ($action == "add"): ?>
	<link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/summernote/summernote-lite.min.css">

<div class="col-md-12 mx-auto">
  <form method="post" enctype="multipart/form-data">

	<h1 class="h3 mb-3 fw-normal">Tạo bài viết</h1>

	<?php if (!empty($errors)):?>
	  <div class="alert alert-danger">Hãy làm theo hướng dẫn bên dưới!</div>
	<?php endif;?>

	<div class="my-2">
		Hình ảnh nổi bật:<br>
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
	  <input value="<?=old_value('title')?>" name="title" type="text" class="form-control mb-2" id="floatingInput" placeholder="Username">
	  <label for="floatingInput">tiêu đề</label>
	</div>
	  <?php if(!empty($errors['title'])):?>
	  <div class="text-danger"><?=$errors['title']?></div>
	  <?php endif;?>

	<div class="">
	  <textarea id="summernote" rows="8" name="content" id="floatingInput" placeholder="Nội dung bài viết" type="content" class="form-control"><?=old_value('content')?></textarea>
	</div>
	  <?php if(!empty($errors['content'])):?>
	  <div class="text-danger"><?=$errors['content']?></div>
	  <?php endif;?>

	<div class="form-floating my-3">
	  <select name="category_id" class="form-select">

		  <?php  

			  $query = "select * from categories order by id desc";
			$categories = query($query);
		  ?>
		  <option value="">--Chọn--</option>
		  <?php if(!empty($categories)):?>
			  <?php foreach($categories as $cat):?>
				  <option <?=old_select('category_id',$cat['id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
			  <?php endforeach;?>
		  <?php endif;?>

	  </select>
	  <label for="floatingInput">Thể loại</label>
	</div>
	  <?php if(!empty($errors['category'])):?>
	  <div class="text-danger"><?=$errors['category']?></div>
	  <?php endif;?>

	<a href="<?=ROOT?>/admin/posts">
		<button class="mt-4 btn btn-lg btn-primary" type="button">Quay lại</button>
	</a>
	<button class="mt-4 btn btn-lg btn-primary float-end" type="submit">tạo</button>
   
  </form>
</div>
	<script src="<?=ROOT?>/assets/js/jquery.js"></script>
	<script src="<?=ROOT?>/assets/summernote/summernote-lite.min.js"></script>
	<script>
      $('#summernote').summernote({
        placeholder: 'Post content',
        tabsize: 2,
        height: 400
      });
    </script>
<?php elseif ($action == "edit"): 
    // Code for editing a user
?>
<link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/summernote/summernote-lite.min.css">
	<div class="col-md-12 mx-auto">
	  <form method="post" enctype="multipart/form-data">

	    <h1 class="h3 mb-3 fw-normal">Edit post</h1>

	    <?php if(!empty($row)):?>

		    <?php if (!empty($errors)):?>
		      <div class="alert alert-danger">Please fix the errors below</div>
		    <?php endif;?>

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
		      <input value="<?=old_value('title', $row['title'])?>" name="title" type="text" class="form-control mb-2" id="floatingInput" placeholder="Username">
		      <label for="floatingInput">Tiêu đề</label>
		    </div>
		      <?php if(!empty($errors['title'])):?>
		      <div class="text-danger"><?=$errors['title']?></div>
		      <?php endif;?>

		    <div class="">
	      <textarea id="summernote" rows="8" name="content" id="floatingInput" placeholder="Nội dung bài viết" type="content" class="form-control"><?=old_value('content',add_root_to_images($row['content']))?></textarea>
	    </div>
	      <?php if(!empty($errors['content'])):?>
	      <div class="text-danger"><?=$errors['content']?></div>
	      <?php endif;?>

	    <div class="form-floating my-3">
	      <select name="category_id" class="form-select">

	      	<?php  

	      		$query = "select * from categories order by id desc";
				$categories = query($query);
	      	?>
	      	<option value="">--Chọn--</option>
	      	<?php if(!empty($categories)):?>
		      	<?php foreach($categories as $cat):?>
		      		<option <?=old_select('category_id',$cat['id'],$row['category_id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
		      	<?php endforeach;?>
	      	<?php endif;?>

	      </select>
	      <label for="floatingInput">thể loại</label>
	    </div>
	      <?php if(!empty($errors['category'])):?>
	      <div class="text-danger"><?=$errors['category']?></div>
	      <?php endif;?>

		    <a href="<?=ROOT?>/admin/posts">
			    <button class="mt-4 btn btn-lg btn-primary" type="button">Quay lại</button>
			</a>
		    <button class="mt-4 btn btn-lg btn-primary  float-end" type="submit">Lưu</button>
		<?php else:?>

			<div class="alert alert-danger text-center">Không tìm thấy trang!</div>
		<?php endif;?>

	  </form>
	</div>
	<script src="<?=ROOT?>/assets/js/jquery.js"></script>
	<script src="<?=ROOT?>/assets/summernote/summernote-lite.min.js"></script>
	<script>
      $('#summernote').summernote({
        placeholder: 'Post content',
        tabsize: 2,
        height: 400
      });
    </script>
<?php elseif ($action == "delete"):
    // Code for deleting a user
?>         
<div class="col-md-6 mx-auto">
	  <form method="post">

	    <h1 class="h3 mb-3 fw-normal">Xoá bài viết</h1>

	    <?php if(!empty($row)):?>

		    <?php if (!empty($errors)):?>
		      <div class="alert alert-danger">hãy sửa các lỗi bên dưới!</div>
		    <?php endif;?>

		    <div class="form-floating">
		      <div class="form-control mb-2" ><?=old_value('title', $row['title'])?></div>
		    </div>
		      <?php if(!empty($errors['title'])):?>
		      <div class="text-danger"><?=$errors['title']?></div>
		      <?php endif;?>

		    <div class="form-floating">
		      <div class="form-control mb-2" ><?=old_value('slug', $row['slug'])?></div>
		    </div>
		      <?php if(!empty($errors['slug'])):?>
		      <div class="text-danger"><?=$errors['slug']?></div>
		      <?php endif;?>
 

		    <a href="<?=ROOT?>/admin/posts">
			    <button class="mt-4 btn btn-lg btn-primary" type="button">Quay lại</button>
			</a>
		    <button class="mt-4 btn btn-lg btn-danger  float-end" type="submit">xoá</button>
		<?php else:?>

			<div class="alert alert-danger text-center">Không tìm thấy trang!</div>
		<?php endif;?>

	  </form>
	</div>
<?php else: ?>


<h4>
    Bài viết
    <a href="<?=ROOT?>/admin/posts/add">
    <button class="btn btn-primary">thêm mới</button>
    </a>
   
</h4>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Tiêu đề</th>
            <th>Slug</th>
            <th>Image</th>
            <th>ngày tạo</th>
            <th>chức năng</th>
        </tr>
        <?php

              $limit = 10;
              $offset = ($PAGE['page_number']-1) * $limit;
              $query = "SELECT * FROM posts ORDER BY id ASC LIMIT $limit OFFSET $offset";
              $rows = query($query);
        ?>
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= esc($row['title']) ?></td>
                    <td><?= $row['slug'] ?></td>
                    <td>
					              <img src="<?=get_image($row['image'])?>" style="width: 100px;height: 100px;object-fit: cover;">
				            </td>
                    <td><?= $row['date'] ?></td>
                    <td>
                    <a href="<?= ROOT ?>/admin/posts/edit/<?= $row['id'] ?>">

                        <button class="btn btn-warning text-white btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>

                    <a href="<?= ROOT ?>/admin/posts/delete/<?= $row['id'] ?>">
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


