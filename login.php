<?php
include("loggedin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

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
                
            </div>
        </div>

  </header>

  <section class="signup" id="signup">

    
    
    <div class="row">
    <h1 class="heading">LOGIN PAGE</h1>
        <form method="post">
            <input type="text" placeholder="username" name="user_name" class="box" required 
            pattern = "^\d*[a-zA-Z][a-zA-Z\d]*$">
            <input type="password" placeholder="password" name="password" class="box" required 
            pattern = "^\d*[a-zA-Z\d]*$">
            <p class="createAcc">Don't have an account? <a href="signup.php">Sign Up</a></p>
            <input type="submit" class="btn" value="login">
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