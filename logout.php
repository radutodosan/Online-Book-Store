<?php
  session_start();

  if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
    header("Location: index1.php");
  }
  else{
    header("Location: index1.php");
  }
  
  die;
?>