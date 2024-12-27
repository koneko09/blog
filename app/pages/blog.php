
<?php include '../app/pages/includes/header.php'; ?>

<div class="mx-auto col-md-10">
 <h3 class="mx-4">Blog</h3>

  <div class="row my-2 justify-content-center">

   
      <?php
        // Giới hạn là 10
        $limit = 10;

        // biến xác định offset, nếu đang ở trang thứ 2 bắt đầu từ bài (2-1)*10 = 10, hiện từ bài thứ 10
        $offset = ($PAGE['page_number']-1) * $limit;
        // Lấy thông tin tất cả bài viết (posts) và tên danh mục (category) của chúng
        // sắp xếp theo thứ tự id giảm dần và giới hạn kết quả với phân trang dựa trên giá trị của $limit và $offset
        // offset: bỏ qua số lượng bài viết đầu tiên
        //LIMIT 10 OFFSET 10: bỏ qua 9 bài đầu, lấy từ bài thứ 10 đến bài 19 (giới hạn 10 bài)
        $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id order by id desc limit $limit OFFSET $offset";
        $rows = query($query);

        // Nếu có bài viết thì include post-cast.php
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