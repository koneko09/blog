
<?php include '../app/pages/includes/header.php'; ?>

 <h3 class="mx-4">Nổi bật</h3>

  <div class="row my-2 justify-content-center">

   
      <?php
        // Lấy thông tin tất cả bài viết (posts) và tên danh mục (category) của
        // từ bảng posts nối với categories qua posts.category_id = categories.id
        // sắp xếp theo thứ tự id giảm dần và giới hạn 6 kết quả 
        $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id order by id desc limit 6";
        $rows = query($query);
        if($rows)
        {
          // Duyệt lần lượt từng phần tử trong mảng row
          foreach($rows as $row)
          {
            include "../app/pages/includes/post-cast.php";
          }
          
        }else{
          echo "không tìm thấy bài viết"; 
        }
        
      ?>

  </div>
  </main>
  <?php include '../app/pages/includes/footer.php'; ?>
