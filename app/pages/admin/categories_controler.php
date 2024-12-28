<?php 
 //<!-- Nếu biến action == add (hành động thêm mới thể loại) -->
 if($action == "add") {
  if(!empty($_POST))
  {
    //validate
    $erros = [];

    // Bắt lỗi danh mục
    if(empty($_POST['category']))
    {
      $erros['category'] = "Bạn phải điền tên thể loại!";
    }
    else if(!preg_match("/^[\p{L}0-9 \-\_\&]+$/u", $_POST['category']))
    {
      $erros['category'] = "Tên thể loại phải là kí tự!";
    }

    // Nếu người dùng không nhập slug, thì tự tạo slug
    if(empty($_POST['slug']))
    {
    $slug = str_to_url($_POST['category']);

    $query = "select id from categories where slug = :slug limit 1"; // :slug là tham số truyền vào ($slug)
    $slug_row = query($query, ['slug'=>$slug]); // gán biến slug_row bằng hàm query với tham số truyền vào là biến $query và mảng ['slug'=>$slug]

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
      //save to database
      $data = [];
      $data['category'] = $_POST['category'];
      $data['slug']     = $slug;
      $data['disabled'] = $_POST['disabled'];

      $query = "insert into categories (category,slug,disabled) values (:category,:slug,:disabled)"; // :category,:slug,:disabled === $data['category'],$data['slug'],$data['disabled]
      query($query, $data);

      redirect('admin/categories');

    }
  }
}
//<!-- Nếu biến action == edit (hành động chỉnh sửa danh mục) -->
else if($action=="edit")
  {
    $query = "select * from categories where id = :id limit 1";
    $row = query_row($query, ['id'=>$id]);

    if(!empty($_POST))
    {

      if($row)
      {

        //validate
        $erros = [];

        // Bắt lỗi danh mục và slug
        if(empty($_POST['category']))
        {
          $erros['category'] = "Không được để trống ô này!";
        }
        if(empty($_POST['slug']))
        {
          $erros['slug'] = "Không được để trống ô này!";
        }
        else if(!preg_match("/^[\p{L}0-9 \-\_\&]+$/u", $_POST['category']))
        {
          $erros['category'] = "tên thể loại phải là kí tự!";
        }

        // Nếu người dùng không nhập slug, thì tự tạo slug
        if(empty($_POST['slug']))
        {
        $slug = str_to_url($_POST['category']);

        $query = "select id from categories where slug = :slug limit 1";
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
          //save to database
          $data = [];
          $data['category'] = $_POST['category'];
          $data['slug'] = $_POST['slug'];
          $data['disabled'] = $_POST['disabled'];
          $data['id'] = $id;

          $query = "update categories set category = :category, slug = :slug, disabled = :disabled where id = :id limit 1";

          query($query, $data);
          redirect('admin/categories');

        }
      }
    }
}

//<!-- Nếu biến action == delete (hành động xoá danh mục) -->
else if($action=="delete")
  {
    $query = "select * from categories where id = :id limit 1";
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

              $query = "delete from categories where id = :id limit 1";
              query($query, $data);
 
              redirect('admin/categories');

            }
          }
        }
    }


?>