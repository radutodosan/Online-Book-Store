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
    <title>Books</title>

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
                <li><a class="active" href="index2.php">Carti</a></li>
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

    <!-- CARTI -->
    <section class="carti" id="carti">

        <form class="search" method="GET">
            <select name="categorie" class="filter">
                <option value="" disabled selected hidden>Filter</option>
                <option value="">None</option>
                <option value="titlu">Titlu</option>
                <option value="autor">Autor</option>
                <option value="categorie">Categorie</option>
             </select>
            <input type="text" placeholder="Search" name="search" class="searchbar" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
            <button type="submit" class="searchbtn"><i class="fa fa-search"></i></button>
            
        </form>
        <div class="box-container">

        <?php

        if(isset($_GET['search'])){
            $filtervalues = $_GET['search'];
            if(isset($_GET['categorie'])){
                if($_GET['categorie'] == "titlu"){
                    $query = "select * from stoc where denumire like '%$filtervalues%'";
                }
                else if($_GET['categorie'] == "autor"){
                    $query = "select * from stoc where autor like '%$filtervalues%'";
                }
                else if($_GET['categorie'] == "categorie"){
                    $query = "select * from stoc where categorie like '%$filtervalues%'";
                }
                else{
                    $query = "select * from stoc where concat(denumire,autor) like '%$filtervalues%'";
                }

            }
            else{
                $query = "select * from stoc where concat(denumire,autor) like '%$filtervalues%'";
            }
            
            $all_product = $con -> query($query);
        }


        while($row = mysqli_fetch_assoc($all_product)){
        ?>
            <div class="box">
                <img src="<?php echo $row["img"] ?>" alt="">
                <h3 class="price"><?php echo $row["pret"] ?> RON</h3>
                <div class="content">
                    <a href="carte.php?product=<?php echo $row['ID']; ?>" class="title"><?php echo $row["denumire"] ?></a> <br>
                    <a class="autor"><i class="fas fa-user"></i> <?php echo $row["autor"] ?> </a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, beatae. Modi quos excepturi id quibusdam? Molestiae quis nihil non debitis!</p>
                    <div class="info">
                        <h3> <i class="fas fa-book"></i>  <?php echo $row["categorie"] ?> </h3>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
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