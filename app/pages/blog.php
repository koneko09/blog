
<?php include '../app/pages/includes/header.php'; ?>

<div class="mx-auto col-md-10">
 <h3 class="mx-4">Blog</h3>

  <div class="row my-2 justify-content-center">

   
      <?php
        $limit = 10;
        $offset = ($PAGE['page_number']-1) * $limit;
        $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id order by id desc limit $limit OFFSET $offset";
        $rows = query($query);
        if($rows)
        {
          foreach($rows as $row)
          {
            include "../app/pages/includes/post-cast.php";
          }
          
        }else{
          echo "không tìm thấy bài viết"; 
        }
        
      ?>
  </div>
  
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
  <?php include '../app/pages/includes/footer.php'; ?>