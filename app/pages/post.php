<?php include '../app/pages/includes/header.php'; ?>

<div class="row">
  <div class="col-md-9">
    <h3 class="mx-auto">Bài viết</h3>
    <div class="row my-2 justify-content-center">
      <?php  
        $slug = $url[1] ?? null;
        if ($slug) {
          $query = "SELECT posts.*, categories.category 
                    FROM posts 
                    JOIN categories ON posts.category_id = categories.id 
                    WHERE posts.slug = :slug 
                    LIMIT 1";
          $row = query_row($query, ['slug' => $slug]);

          $query2 = "SELECT posts.category_id, categories.slug 
                     FROM posts 
                     JOIN categories ON posts.category_id = categories.id 
                     WHERE posts.slug = :slug 
                     LIMIT 1";
          $row2 = query_row($query2, ['slug' => $slug]);
        }

        if (!empty($row)) { ?>
          <div class="col-md-12">
            <div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
              <div class="col-12 d-lg-block">
                <img class="bd-placeholder-img w-100" height="200px" width="20%" style="object-fit: cover;" src="<?=get_image($row['image'])?>">
              </div>
              <!-- <div style="text-align: center;">
              <h3  class="mb-0"><?=esc($row['title'])?></h3>
              </div> -->
              <div class="col p-4 d-flex flex-column position-static">
                <a href="<?=ROOT?>/category/<?=esc($row2['slug'] ?? 'Unknown')?>">
                  <strong class="d-inline-block mb-2 text-primary">
                    <?=esc($row['category'] ?? 'Unknown')?>
                  </strong>
                </a>
                <h3 class="mb-0"><?=esc($row['title'])?></h3>
                <div class="mb-1 text-muted">
                  <?=date("jS M, Y", strtotime($row['date']))?>
                </div>
                <p class="card-text mb-auto">
                  <?=nl2br(add_root_to_images($row['content']))?>
                </p>
              </div>
            </div>
          </div>
        <?php } else {
          echo "Không tìm thấy bài viết!";
        } ?>
    </div>
  </div>

  <div class="col-md-3">
    <h3 class="mx-auto">Thống kê</h3>

    <div class="row my-2 justify-content-center">
      <div class="col-md-12">
        <div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
          <div class="col p-4 d-flex flex-column position-static">

            <table class="table mt-3">
                <h3 class="ms-0">Thống kê</h3>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Số lượng</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Bài viết:</th>
                    <?php 
                      $query = "SELECT COUNT(id) AS num FROM posts";
                      $res = query_row($query);
                    ?>
                    <td><?=$res['num'] ?? 0?></td>
                  </tr>
                  <tr>
                    <th scope="row">Thể loại:</th>
                    <?php 
                      $query = "SELECT COUNT(id) AS num FROM categories";
                      $res = query_row($query);
                    ?>
                    <td><?=$res['num'] ?? 0?></td>
                  </tr>
                  <tr>
                    <th scope="row">User:</th>
                    <?php 
                      $query = "SELECT COUNT(id) AS num FROM users WHERE role = 'user'";
                      $res = query_row($query);
                    ?>
                    <td><?=$res['num'] ?? 0?></td>
                  </tr>
                </tbody>
              </table>

            <div class="tags l-h-2x panel wrapper-sm padder-v-ssm mb-5 mt-4">
              <h3 class="ms-0">Danh mục</h3>
              <?php  
                $query = "SELECT * FROM categories ORDER BY id DESC";
                $categories = query($query);
              ?>
              <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                  <a href="<?=ROOT?>/category/<?=$cat['slug']?>" class="label badge" 
                     style="background-color: white; border: 2px solid black; border-radius: 0.375rem; padding: 4px;">
                    <?=$cat['category']?>
                  </a>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>

            
            
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<?php include '../app/pages/includes/footer.php'; ?>
