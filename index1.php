<?php
include("loggedin.php");

$user_data = check_login($con);

if($user_data == -1){
    $login = "href='login.php'";
    $cart = "href='login.php'";
    $orders = "href='login.php'";
    $login_text = "login";
    $chat = "href='login.php'";
}
else{
    $login = "href='settings.php'";
    $cart = "href='cos.php'";
    $orders = "href='comenzi.php'";
    $login_text = "Settings";
    $logout = "href='logout.php'"; 
    $nume = "$user_data[user_name]";
    $chat = "href='chat.php'";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acasa</title>

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
                <li><a class="active" href="index1.php">Acasa</a></li>
                <li><a href="index2.php">Carti</a></li>
                <li><a href="index3.php">Contact</a></li>
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

    
<!-- HOME -->
<section class="home" id="home">

    
    <h1>Bun Venit!</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis ipsa provident totam? Dolorum, quisquam. Nobis architecto magni velit accusantium, impedit consectetur soluta nemo inventore deleniti modi ea tenetur. Illum, sed.</p>
    <a <?php echo $chat ?>><button class="btn">Chat</button></a> <br>
    <div class="slider">
      <span id="slide-1"></span>
      <span id="slide-2"></span>
      <span id="slide-3"></span>
      <span id="slide-4"></span>
      <span id="slide-5"></span>
      <span id="slide-6"></span>
      <span id="slide-7"></span>
      <span id="slide-8"></span>
      <div class="image-container">
        <img src="/images/maitreyi.png" class="slide" width="400" height="500" />
        <img src="/images/ferma.png" class="slide" width="400" height="500" />
        <img src="/images/guliver.png" class="slide" width="400" height="500" />
        <img src="/images/amintiri.jpg" class="slide" width="400" height="500" />
        <img src="/images/enigma.jpeg" class="slide" width="400" height="500" />
        <img src="/images/ion.jpg" class="slide" width="400" height="500" />
        <img src="/images/book01.png" class="slide" width="400" height="500" />
        <img src="/images/book01.png" class="slide" width="400" height="500" />
      </div>
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