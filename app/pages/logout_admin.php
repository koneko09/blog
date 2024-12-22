<?php
 if(!empty($_SESSION['ADMIN']))
      unset($_SESSION['ADMIN']);


 redirect('home');   

?>