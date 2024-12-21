<?php include '../app/pages/includes/header.php'; ?>

<div class="mx-auto col-md-10">
    <h3 class="mx-4">tìm kiếm</h3>

      <div class="row my-2 justify-content-center">

        <?php  

          $limit = 10;
          $offset = ($PAGE['page_number'] - 1) * $limit;

          $find = $_GET['find'] ?? null;

          if($find)
          {
            $find = "%$find%";
            $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id where posts.title like :find order by id desc limit $limit offset $offset";
            $rows = query($query,['find'=>$find]);
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


  <div class="col-md-12 mb-4">
    <a href="<?=$PAGE['first_link']?>">
      <button class="btn btn-primary">Trang đầu</button>
    </a>
    <a href="<?=$PAGE['prev_link']?>">
      <button class="btn btn-primary">trang trước</button>
    </a>
    <a href="<?=$PAGE['next_link']?>">
      <button class="btn btn-primary float-end">trang tiếp</button>
    </a>
  </div>
</div>
<?php include '../app/pages/includes/footer.php'; ?>
