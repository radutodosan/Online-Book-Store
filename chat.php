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
    $nume = "$user_data[user_name]";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <script defer src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script defer src="script.js"></script>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

    <!-- fisier CSS -->
    <link rel="stylesheet" type="text/css" href="style1.css?version=1">
    <style>
        .message-body {
        padding-top: 10rem;
        margin: 0;
        display: flex;
        justify-content: center;
        background-color:#111;
        font-size: 1.7rem;
        }

        #message-container {
        width: 80%;
        max-width: 1200px;

        }

        #message-container div {
        background-color:#5934bd;
        padding: 5px;
        color:#fff;
        
        }

        #message-container div:nth-child(2n) {
        background-color: black;
        
        }

        #send-container {
        position: fixed;
        padding-bottom: 30px;
        bottom: 0;
        background-color: white;
        max-width: 1200px;
        width: 80%;
        display: flex;
        background-color: #111;
        }

        #message-input {
            flex-grow: 1;
            height: 50px;
            color:#fff;
            font-size: 1.7rem;
            border:.1rem solid #eee;
            background:none;
            text-transform: none;
            padding:0 1rem;
        }
        #message-input:focus{
            border-color: #5934bd;
        }
    </style>
</head>

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

<a id="check"><?php echo "$nume" ?></a>

<body>
    <div class="message-body">
        <div id="message-container"></div>
        <form id="send-container">
            <input type="text" id="message-input" placeholder="Message">
            <button type="submit" id="send-button" class="searchbtn">Send</button>
        </form>
    </div>
 <!-- jquery cdn link -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <!-- JS file -->
 <script src="script1.js"></script>

</body>
</html>