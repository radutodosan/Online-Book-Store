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
    $user_id = $user_data['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $context = $_POST['context'];

    function check_string($my_string){
      $regex = preg_match('[@_!#$%^&*()<>?/|}{~:]', $my_string);
      if($regex)
         return false;
      else
         return true;
    }

    if(!is_numeric($name)){

        $query = "insert into contact(user_id, name, email, context) values('$user_id','$fullname','$email','$context')";
        
        mysqli_query($con, $query);

        echo "<meta http-equiv='refresh' content='0'>";

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
  <title>Contact</title>

  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

  <!-- fisier CSS -->
  <link rel="stylesheet" type="text/css" href="style1.css?version=1">

</head>
<body>


  <!-- bara navigatie -->
  <header>

        <div id="menu" class="fas fa-bars"></div>

        <a href="index1.php" class="logo"><i class="fas fa-home"></i></a>

        <nav class="navbar">
            <ul>
                <li><a href="index1.php">Acasa</a></li>
                <li><a href="index2.php">Carti</a></li>
                <li><a class="active" href="index3.php">Contact</a></li>
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

  <!-- CONTACT -->
  <section class="contact" id="contact">

    <h1 class="heading">contact us</h1>
    
    <div class="row">
    
        <form method="post">
            <input type="text" placeholder="full name" name="fullname" class="box" required>
            <input type="email" placeholder="your email" name="email" value="<?php if($user_data != -1) echo $user_data['email']?>" class="box" required>
            <textarea name="context" cols="30" rows="10" class="box address" placeholder="context" required></textarea>
            <input type="submit" class="btn" value="send now">
        </form>
    </div>
    
  </section>


  <!-- FOOTER -->
  <div class="footer">

    <div class="box-container">
        <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-map-marker-alt"></i> Timisoara, UVT </p>
            <p> <i class="fas fa-envelope"></i> example@gmail.com </p>
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