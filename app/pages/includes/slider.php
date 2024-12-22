  <!-- slider -->
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/slider/ism/css/my-slider.css"/>
<script src="<?php echo ROOT ?>/assets/slider/ism/js/ism-2.2.min.js"></script>

<div class="ism-slider" data-transition_type="fade" data-play_type="loop" id="my-slider">
  <ol>
    
    <?php
         $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id order by id desc limit 6";
        $rows = query($query);
        if($rows)
        {
          foreach($rows as $row)
          {
            ?>
        
            <li>
            <img src="<?=get_image($row['image'])?>">
              <div class="ism-caption ism-caption-0"><?=esc($row['title'])?></div>
            </li>
        
        <?php  } ?>
          
      <?php  }?>
  <?php   ?>
  </ol>
</div>
<!-- end slider -->