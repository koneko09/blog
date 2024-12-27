<?php 
//<!-- Nếu biến action == add (hành động thêm bài viết) -->
 if($action=="add"){
  
    // Nếu tồn tại biến POST
    if(!empty($_POST))
    {
      // validate
      $erros = [];
      
      // Bắt lỗi title
      if(empty($_POST["title"]))
      {
         $erros["title"] = " bạn cần nhập tiêu đề bài viết!";
      }
      if(empty($_POST["category_id"]))
      {
         $erros["category_id"] = " bạn cần chọn thể loại của bài viết!";
      }
      
      // validate image
      $allowed = ['image/jpeg','image/png','image/webp'];
      if(!empty($_FILES['image']['name']))
      {
        $destination = "";
        if(!in_array($_FILES['image']['type'], $allowed))
        {
          $erros['image'] = "Image format not supported";
        }else
        {
          $folder = "uploads/";
          if(!file_exists($folder))
          {
            mkdir($folder, 0777, true);
          }

          $destination = $folder . time() . $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
          resize_image($destination);
        }

      }else
      {
        $erros["image"] = "cần phải có ảnh!";
      }
      
      // Nếu người dùng không nhập slug, thì tự tạo slug
      if(empty($_POST['slug']))
      {
        $slug = str_to_url($_POST['title']);
  
        $query = "select id from posts where slug = :slug limit 1";
        $slug_row = query($query, ['slug'=>$slug]);
  
        if($slug_row)
        {
          $slug .= rand(1000,9999);
        }
  
      }
      // Nếu người dùng có nhập slug, thì $slug bằng giá trị người dùng nhập vào
      else if(!empty($_POST['slug']))
      {
        $slug = $_POST['slug'];
      }
      
      // Nếu không có lỗi (mảng erros rỗng)
      if(empty($erros))
      {
        $data = [];
        $data['title'] = $_POST['title'];
        $data['content']    = $_POST['content'];
        $data['category_id']     = $_POST['category_id'];
        $data['slug']     = $slug;
        $data['user_id']     = user('id');
        
      

        $query = "insert into posts (title,content,slug,category_id,user_id) values (:title,:content,:slug,:category_id,:user_id)";
        
        // Nếu cập nhật ảnh
        if(!empty($destination))
        {
          $data['image']     = $destination;
          $query = "insert into posts (title,content,slug,category_id,user_id,image) values (:title,:content,:slug,:category_id,:user_id,:image)";
        }
        query($query, $data);

        redirect('user/posts');

      }
    }
  }

  //<!-- Nếu biến action == edit (hành động chỉnh sửa bài viết) -->
  else if($action=="edit")
  {
    $query = "select * from posts where id = :id limit 1";
    $row = query_row($query, ['id'=>$id]);

    // Nếu tồn tại biến POST
    if(!empty($_POST))
    {

      if($row)
      {

        //validate
        $erros = [];

        // Bắt lỗi tiêu đề
        if(empty($_POST['title']))
        {
          $erros['title'] = "Cần phải có tiêu đề";
        }

        // Bắt lỗi danh mục
        if(empty($_POST['category_id']))
        {
          $erros['category_id'] = "Danh mục là bắt buộc";
        }

        //validate image
        $allowed = ['image/jpeg','image/png','image/webp'];
        if(!empty($_FILES['image']['name']))
        {
          $destination = "";
          if(!in_array($_FILES['image']['type'], $allowed))
          {
            $erros['image'] = "Image format not supported";
          }else
          {
            $folder = "uploads/";
            if(!file_exists($folder))
            {
              mkdir($folder, 0777, true);
            }

            $destination = $folder . time() . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            resize_image($destination);
          }

        }

        // Nếu người dùng không nhập slug, thì tự tạo slug
        if(empty($_POST['slug']))
        {
          $slug = str_to_url($_POST['title']);
    
          $query = "select id from posts where slug = :slug limit 1";
          $slug_row = query($query, ['slug'=>$slug]);
    
          if($slug_row)
          {
            $slug .= rand(1000,9999);
          }
    
        }
        // Nếu người dùng có nhập slug, thì $slug bằng giá trị người dùng nhập vào
        else if(!empty($_POST['slug']))
        {
          $slug = $_POST['slug'];
        }

        // Nếu không có lỗi (mảng erros rỗng)
        if(empty($erros))
        {

          $new_content = remove_images_from_content($_POST['content']);
          $new_content = remove_root_from_content($new_content);

          $data = [];
          $data['title']    = $_POST['title'];
          $data['content']  = $new_content;
          $data['category_id']   = $_POST['category_id'];
          $data['id']       = $id;
          $data['slug']       = $slug;

          $image_str        = "";

          // Nếu cập nhật ảnh
          if(!empty($destination))
          {
            $image_str = "image = :image, ";
            $data['image']       = $destination;
          }
          
          $query = "update posts set title = :title, slug = :slug, content = :content, $image_str category_id = :category_id where id = :id limit 1";

          query($query, $data);
          redirect('user/posts');

        }
      }
    }
    } else if($action=="delete")
    {
        
      $query = "select * from posts where id = :id limit 1";
      $row = query_row($query, ['id'=>$id]);

      if($_SERVER['REQUEST_METHOD'] == "POST")
      {

        if($row)
        {

          //validate
          $erros = [];

          if(empty($erros))
          {
            //delete from database
            $data = [];
            $data['id']       = $id;

            $query = "delete from posts where id = :id limit 1";
            query($query, $data);

            if(file_exists($row['image']))
              unlink($row['image']);

            redirect('user/posts');

          }
        }
      }
    }


?>