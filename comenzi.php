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


$sql = "select * from stoc";
$all_product = $con -> query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

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

    <!-- detalii comenzi -->
    <div class="cart-container">
        <table>
            <tr>
                <th>Cod comanda</th>
                <th>Produse</th>
                <th>Nume</th>
                <th>Adresa livrare</th>
                <th>Data</th>
                <th>Total(RON)</th>
            </tr>
            <?php
            $id_user = $user_data['id'];
            $comanda_data = "select * from comenzi where user_id='$id_user'";
            $comanda = $con -> query($comanda_data);
            while($row = mysqli_fetch_assoc($comanda))
            {
                
            ?>
            <tr>
                <td>
                    <div>
                        <p><?php echo $row['id'];?></p>
                    </div>
                </td>
                <td>
                    <div class="cos-detalii">
                        <div>
                            <p><?php echo $row['produse'];?></p>
                        </div>
                </td>
                <td>
                    <div>
                        <p><?php echo $row['nume'];?></p>
                    </div>
                </td>
                <td>
                    <div>
                        <p><?php echo $row['adresa'];?></p>
                    </div>
                </td>
                <td>
                    <div>
                        <p><?php echo $row['data'];?></p>
                    </div>
                </td>
                <td>
                    <div>
                        <p><?php echo $row['total'];?></p>
                    </div>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>

    </div>

    <!-- jquery cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JS file -->
    <script src="script1.js"></script>

</body>

</html>