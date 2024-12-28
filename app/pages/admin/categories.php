<!-- Nếu biến action == add (hành động thêm mới thể loại) -->
<?php
if ($action == "add"): ?>
<div class="col-md-6 mx-auto">
<form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Tạo Thể Loại</h1>

    <?php if( !empty( $erros) ): ?>
      <div class="alert alert-danger ">
            Vui lòng sửa các lỗi bên dưới!
      </div>
      <?php endif; ?>

      <div class="form-floating">
	      <input value="<?=old_value('category')?>" name="category" type="text" class="form-control mb-2" id="floatingInput" placeholder="Category">
	      <label for="floatingInput">Tên thể loại</label>
	    </div>

          <?php if(!empty($erros['category'])):?>
          <div class="text-danger"><?=$erros['category']?></div>
          <?php endif;?>

    <div class="form-floating">
	      <input value="<?=old_value('slug')?>" name="slug" type="text" class="form-control mb-2" id="floatingInput" placeholder="Category">
	      <label for="floatingInput">Đường dẫn (có thể để trống)</label>
	    </div>

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

<!-- Nếu biến action == edit (hành động chỉnh sửa danh mục) -->
<?php elseif ($action == "edit"): 
?>
<div class="col-md-6 mx-auto">
	  <form action="" method="post" enctype="multipart/form-data">

	    <h1 class="h3 mb-3 fw-normal">Chỉnh sửa thể loại</h1>

	    <?php if(!empty($row)):?>

		    <?php if (!empty($erros)):?>
		      <div class="alert alert-danger">Có lỗi xảy ra!</div>
		    <?php endif;?>
 
		    <div class="form-floating">
		      <input value="<?=old_value('category', $row['category'])?>" name="category" type="text" class="form-control mb-2" id="floatingInput" placeholder="Tên danh mục">
		      <label for="floatingInput">Tên thể loại</label>
		    </div>
		      <?php if(!empty($erros['category'])):?>
		      <div class="text-danger"><?=$erros['category']?></div>
		      <?php endif;?>

        <div class="form-floating">
		      <input value="<?=old_value('slug', $row['slug'])?>" name="slug" type="text" class="form-control mb-2" id="floatingInput" placeholder="Đường dẫn danh mục: duong-dan">
		      <label for="floatingInput">Đường dẫn</label>
		    </div>
        <?php if(!empty($erros['slug'])):?>
		      <div class="text-danger"><?=$erros['slug']?></div>
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

<!-- Nếu biến action == delete (hành động xoá danh mục) -->
<?php elseif ($action == "delete"):
?>         
<div class="col-md-6 mx-auto">
	  <form method="post">

	    <h1 class="h3 mb-3 fw-normal">Xoá thể loại</h1>

	    <?php if(!empty($row)):?>

		    <?php if (!empty($erros)):?>
		      <div class="alert alert-danger">Có lỗi xẩy ra!</div>
		    <?php endif;?>

		    <div class="form-floating">
		      <div class="form-control mb-2" ><?=old_value('category', $row['category'])?></div>
		    </div>
		      <?php if(!empty($erros['category'])):?>
		      <div class="text-danger"><?=$erros['category']?></div>
		      <?php endif;?>

		    <div class="form-floating">
		      <div class="form-control mb-2" ><?=old_value('slug', $row['slug'])?></div>
		    </div>
		      <?php if(!empty($erros['slug'])):?>
		      <div class="text-danger"><?=$erros['slug']?></div>
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

<!-- Nếu biến action == view (mặc định) (hành động xem danh mục) -->
<?php else: ?>
<h4 class="d-flex justify-content-between align-items-center">
    <span>Thể Loại</span>
    <a href="<?=ROOT?>/admin/categories/add">
        <button class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
        </button>
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
        <!-- Nếu có dữ liệu -->
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['category']?></td>
                <td><?=$row['slug']?></td>
                <td><?=$row['disabled'] ? 'Tắt':'Bật'?></td>
                <td>
                    <!-- Nút chỉnh sửa -->
                    <a href="<?= ROOT ?>/admin/categories/edit/<?= $row['id'] ?>">

                        <button class="btn btn-warning text-white btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>
                    <!-- Nút xoá -->
                    <a href="<?= ROOT ?>/admin/categories/delete/<?= $row['id'] ?>">
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-trash-fill  "></i>
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

<?php endif; ?>


