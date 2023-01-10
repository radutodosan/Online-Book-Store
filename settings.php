<?php
session_start();

include 'connection.php';
include 'functions.php';

$user_data = check_login($con);

if($user_data == -1){
  $login = "href='login.php'";
  $cart = "href='login.php'";
  $orders = "href='login.php'";
  $login_text = "login";
}
else{
  $login = "href='settings.php'";
  $cart = "href='cos.php'";
  $orders = "href='comenzi.php'";
  $login_text = "Settings";
  $logout = "href='logout.php'"; 
  $nume = "Hello, $user_data[user_name]";
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];

    function check_string($my_string){
      $regex = preg_match('[@_!#$%^&*()<>?/|}{~:]', $my_string);
      if($regex)
         return false;
      else
         return true;
    }

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && check_string($user_name) && check_string($password) && $password == $password2){

        $query = " update users set user_name = '$user_name', password ='$password', email = '$email' where id = '$user_data[id]'";
        
        mysqli_query($con, $query);

        echo "<meta http-equiv='refresh' content='0'>";

    }
    else if(!check_string($user_name) || !check_string($password)){
      echo '<script>alert("Caractere nepermise!")</script>';
    }
    else if($password != $password2){
      echo '<script>alert("Passwords don`t match!")</script>';
    }
    else{
      echo '<script>alert("Informatii introduse gresit")</script>';
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

  <!-- fisier CSS -->
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="signupstyle.css">

  <link href="index2.php" rel="import" />

</head>
<body>

  <!-- bara navigatie -->
  <header>

        <div id="menu" class="fas fa-bars"></div>

        <a href="index1.php" class="logo"><i class="fas fa-home"></i></a>

        <nav class="navbar">
            <ul>
                <li><a href="index1.php">acasa</a></li>
                <li><a href="index2.php">carti</a></li>
                <li><a href="index3.php">contact</a></li>
            </ul>
        </nav>

        <div class="dropdown">
            <button class="dropbtn"><i class="fas fa-user"></i></button>
            <div class="dropdown-content">
                <a <?php echo $login ?>><?php echo "$login_text" ?></a>
                
                <?php
                if($user_data != -1){
                ?>
                    <a <?php echo $cart ?> class="fas fa-shopping-cart"></a>
                    <a <?php echo $orders ?>>Orders</a>
                    <a <?php echo $logout ?>>Logout</a>
                <?php
                }
                ?>
            </div>
        </div>

  </header>

  <section class="signup" id="signup">
    
    <div class="row">
      <h1 class="heading">SETTINGS</h1>
        <form method="post" action="">
            <input type="text" placeholder="username" name="user_name" class="box" required 
            pattern = "^\d*[a-zA-Z][a-zA-Z\d]*$" value=<?php echo "$user_data[user_name]" ?>>
            <input type="password" placeholder="password" name="password" class="box" required 
            pattern = "^\d*[a-zA-Z\d]*$">
            <input type="password" placeholder="confirm password" name="password2" class="box" required pattern = "^\d*[a-zA-Z\d]*$">
            <input type="email" placeholder="your email" name="email" class="box" required value=<?php echo "$user_data[email]" ?> >

            <input type="submit" class="btn" value="update">
        </form>
    </div>
    
  </section>

  <!-- FOOTER -->
  <div class="footer">

    <div class="box-container">
        <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-map-marker-alt"></i> Timisoara, UVT </p>
            <p> <i class="fas fa-envelope"></i> examplu@yahoo.com </p>
            <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
        </div>

    </div>
  </div>


  <!-- jquery cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- JS file -->
  <script src="script1.js"></script>

</body>
</html>