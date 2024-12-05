<?php 
 // add new
 if($action=="add"){
  
    if(!empty($_POST))
    {
      // validate
      $erros = [];
  
      if(empty($_POST["username"]))
      {
         $erros["username"] = " bạn cần nhâp tên người dùng!";
      }
      else if(!preg_match("/^[a-zA-z]+$/",$_POST['username']))
      {
          $erros["username"] = "tên người dùng phải là ký tự và không có khoảng cách!";
      }
  
      if(empty($_POST["password"]))
      {
         $erros["password"] = " bạn cần nhâp mật khẩu!";
      }
      else if(strlen($_POST["password"]) < 8)
      {
          $erros["password"] = "mật khẩu phải lớn hơn 8 kí tự!";
      }
      else if($_POST["password"] !== $_POST['rePassword'])
      {
          $erros["password"] = "mật khẩu không trùng khớp!";
      }
      
      $query = " select id from users where email = :email limit 1 ";
      $email = query($query,['email' => $_POST['email']]);
  
      if(empty($_POST["email"]))
      {
         $erros["email"] = " bạn cần nhập email!";
      }
      else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
      {
          $erros["email"] = "Địa chỉ email không khả dụng!";
      }
      else if($email)
      {
          $erros["email"] = "Địa chỉ email đã tồn tại!";
      }
  
      // validate image
      $allowed = ['image/jpeg','image/png','image/webp'];
      if(!empty($_FILES['image']['name']))
      {
        $destination = "";
        if(!in_array($_FILES['image']['type'], $allowed))
        {
          $errors['image'] = "Image format not supported";
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
    
  
      if(empty($errors))
      {
        //save to database
        $data = [];
        $data['username'] = $_POST['username'];
        $data['email']    = $_POST['email'];
        $data['role']     = $_POST['role'];
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "insert into users (username,email,password,role) values (:username,:email,:password,:role)";
        
        if(!empty($destination))
        {
          $data['image']     = $destination;
          $query = "insert into users (username,email,password,role,image) values (:username,:email,:password,:role,:image)";
        }

        query($query, $data);

        redirect('admin/users');

      }
    }
  }else if($action=="edit")
  {
    $query = "SELECT * FROM users WHERE id = :id limit 1";
    $row = query_row($query,['id' => $id]);

      
    if(!empty($_POST))
    {
  
      if($row){

      
          // validate
          $erros = [];
      
          if(empty($_POST["username"]))
          {
            $erros["username"] = " bạn cần nhâp tên người dùng!";
          }
          else if(!preg_match("/^[a-zA-z]+$/",$_POST['username']))
          {
              $erros["username"] = "tên người dùng phải là ký tự và không có khoảng cách!";
          }
      
          if(empty($_POST["password"]))
          {
            
          }
          else if(strlen($_POST["password"]) < 8)
          {
              $erros["password"] = "mật khẩu phải lớn hơn 8 kí tự!";
          }
          else if($_POST["password"] !== $_POST['rePassword'])
          {
              $erros["password"] = "mật khẩu không trùng khớp!";
          }
          
          $query = " select id from users where email = :email && id !=:id limit 1 ";
          $email = query($query,['email' => $_POST['email'],'id'=>$id]);
      
          if(empty($_POST["email"]))
          {
            $erros["email"] = " bạn cần nhập email!";
          }
          else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
          {
              $erros["email"] = "Địa chỉ email không khả dụng!";
          }
          else if($email)
          {
              $erros["email"] = "Địa chỉ email đã tồn tại!";
          }
          
          // validate image
          $allowed = ['image/jpeg','image/png','image/webp'];
          if(!empty($_FILES['image']['name']))
          {
            $destination = "";
            if(!in_array($_FILES['image']['type'], $allowed))
            {
              $errors['image'] = "Image format not supported";
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
        
      
          if(empty($errors))
          {
            //save to database
            $data = [];
            $data['username'] = $_POST['username'];
            $data['email']    = $_POST['email'];
            $data['role']     = $_POST['role'];
            $data['id']       = $id;

            $password_str     = "";
            $image_str        = "";

              if(!empty($_POST['password']))
              {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password_str = "password = :password, ";
              }

              if(!empty($destination))
              {
                $image_str = "image = :image, ";
                $data['image']       = $destination;
              }
            
              $query = "update users set username = :username, email = :email, $password_str $image_str role = :role where id = :id limit 1";

            query($query, $data);
            redirect('admin/users');

          }
        }
      }
    }


    
    else if($action=="delete")
  {
    $query = "SELECT * FROM users WHERE id = :id limit 1";
    $row = query_row($query,['id' => $id]);

      
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      if($row){
          // validate
          $erros = [];
      
          
        
      
          if(empty($erros)){
            // delete from database
            $data = [];
            $data['id'] = $id;

            
            $query = "delete from users where id =:id limit 1 ";
            query($query,$data);
            
            if(file_exists($row['image']))
            {
              unlink($row['image']);
            }
            redirect('admin/users');
          }
        }
     }
    }


?>