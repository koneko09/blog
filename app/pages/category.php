
<?php include '../app/pages/includes/header.php'; ?>

<div class="mx-auto col-md-10">
    <h3 class="mx-4">Thể loại</h3>

      <div class="row my-2 justify-content-center">

        <?php  

          // Giới hạn là 10
          $limit = 10;

          // biến xác định offset, nếu đang ở trang thứ 2 bắt đầu từ bài (2-1)*10 = 10, hiện từ bài thứ 10
          $offset = ($PAGE['page_number'] - 1) * $limit;

          $category_slug = $url[1] ?? null;

          // Nếu category_slug có giá trị, thực hiện truy vấn cơ sở dữ liệu để lấy bài viết thuộc danh mục
          if($category_slug)
          {
           
            // Lấy tất cả các bài viết (posts.*) và tên danh mục (categories.category).
            //từ bảng kết hợp giữa bảng posts và bảng categories dựa trên category_id.
            //Điều kiện: Lọc các bài viết trong các danh mục có slug tương ứng với $category_slug và có trạng thái disabled = 0.
            //order by id desc: Sắp xếp các bài viết theo id giảm dần, bài mới hiện trước
            //limit $limit offset $offset: Giới hạn số bài viết lấy về và bắt đầu từ vị trí $offset
            $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id where posts.category_id in (select id from categories where slug = :category_slug && disabled = 0) order by id desc limit $limit offset $offset";
            $rows = query($query,['category_slug'=>$category_slug]);
          }
          
          if(!empty($rows))
          {
            foreach ($rows as $row) {
              include '../app/pages/includes/post-cast.php';
            }

          }else{
            echo "Không tìm thấy trang!";
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

