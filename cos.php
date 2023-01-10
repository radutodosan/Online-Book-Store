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
    <title>Cart</title>

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


    <!-- detalii cos -->
    <div class="cart-container">
        <table>
            <tr>
                <th>Produs</th>
                <th>Pret unitar</th>
                <th>Cantitate</th>
                <th>Total(RON)</th>
            </tr>
            <?php
            $id_user = $user_data['id'];
            $cos_data = "select * from cos where id_user='$id_user'";
            $cos = $con -> query($cos_data);
            $pret_total = 0;
            $check = 0;
            while($row = mysqli_fetch_assoc($cos))
            {
            $check = 1;
            ?>
            <tr>
                <td>
                    <div class="cos-detalii">
                        <img src="<?php echo $row["img"] ?>">
                        <div>
                            <p><?php echo $row['denumire_carte'];?></p>
                    </div>
                </td>
                <td>
                    <div>
                        <p><?php echo $row['pret_unitar'];?></p>
                    </div>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $row['id_user'];?>">
                        <input type="hidden" name="id_carte" value="<?php echo $row['id_carte'];?>">
                        <input type="hidden" name="cantitate" value="<?php echo $row['cantitate'];?>">
                        <button type="submit" name="decreaseQty">-</button>
                        <a name="Qty"><?php echo $row['cantitate'];?></a>
                        <button type="submit" name="increaseQty">+</button>
                    </form>
                    <?php
                    
                    ?>
                </td>
                <td><?php echo $row['pret'];?> </td>
            <?php
            $pret_total += (int)$row['pret'];
            }
            if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['decreaseQty'])){
                decreaseQty($_POST['id_user'],$_POST['id_carte']);
                unset($_POST['decreaseQty']);
                echo "<meta http-equiv='refresh' content='0'>";
            }
            else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['increaseQty'])){
                $id_carte = $_POST['id_carte'];
                $tabel = "select stoc from stoc where ID='$id_carte'";
                $tabel2 = $con -> query($tabel);
                $vf_stoc = mysqli_fetch_assoc($tabel2);
                $int_vf_stoc = (int)$vf_stoc['stoc'];
                $qty = (int)$_POST['cantitate'];
                if($int_vf_stoc > $qty){
                    increaseQty($_POST['id_user'],$_POST['id_carte']);
                    unset($_POST['increaseQty']);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                else{
                    echo "<script>alert('Stocul maxim este: $int_vf_stoc')</script>";
                }
                
            }
            
            ?>
                
            </tr>
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Total</td>
                    <td><?php echo $pret_total;?></td>
                </tr>
            </table>
        </div>

        <?php
            if($check == 1){
        ?>
            <button onClick="location.href = 'checkout.php';"" type="submit" name="checkout" class="btn">Checkout</button>
        <?php
            }
        ?>
    </div>



    <!-- jquery cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JS file -->
    <script src="script1.js"></script>

</body>

</html>