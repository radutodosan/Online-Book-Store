<?php
include_once 'connection.php';

function check_login($con){
  if(isset($_SESSION['id']))
  {
      $id = $_SESSION['id'];
      $query = "select * from users where id = '$id' limit 1";
      
      $result = mysqli_query($con, $query);

      if($result && mysqli_num_rows($result) > 0){
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
      }
      
  }
  return -1;
}


function get_active($table, $id){
  global $con;
  $query = "select * from $table where ID='$id'";
  $query_run = $con -> query($query);
  return $query_run;
}

function addtocart($id){
  global $con;
  $stoc_id = $_GET['product'];
  $stoc_data = get_active("stoc", $stoc_id);
  $stoc = mysqli_fetch_array($stoc_data);

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id_user = $id;
    $id_carte = $stoc["ID"];
    $denumire_carte = $stoc["denumire"];
    $autor_carte = $stoc["autor"];
    $cantitate = $_POST['cantitate'];
    $pret = $stoc["pret"];
    $img = $stoc["img"];

    if($cantitate > 0 && $stoc["stoc"] >= $cantitate){

      $sql = "select cantitate from cos where id_carte = '$id_carte' and id_user = '$id_user'";
      $c1 = $con -> query($sql);
      $c2 = mysqli_fetch_array($c1);
      $query = "";

      if($c2['cantitate'] != null){
        $cantitate = (int)$c2['cantitate'] + (int)$cantitate;
        $query = "delete from cos where id_carte = '$id_carte' and id_user = '$id_user'";
        mysqli_query($con, $query);
      }

      $new_pret = (int)$pret * (int)$cantitate;
      $query = "insert into cos(id_user,id_carte,denumire_carte,autor_carte,pret_unitar,img, cantitate,pret) values('$id_user','$id_carte', '$denumire_carte', '$autor_carte', '$pret','$img', '$cantitate', '$new_pret')";  

      mysqli_query($con, $query);

      echo "<meta http-equiv='refresh' content='0'>";

    }
    else if($cantitate <= 0){
      echo '<script>alert("Numarul trebuie sa fie mai mare decat 0")</script>';
    }
    else if($stoc["stoc"] < $cantitate){
      echo '<script>alert("Nu sunt suficiente carti pe stoc")</script>';
    }
    else{
      echo '<script>alert("Informatii introduse gresit")</script>';
    }
  }
  
}

function decreaseQty($id_user, $id_carte){
  global $con;
  $query = "select * from cos where id_user='$id_user' and id_carte='$id_carte' limit 1";
  $query_run = $con -> query($query);
  $row = mysqli_fetch_array($query_run);

  if($row['cantitate'] == 1){
    $query = "delete from cos where id_user='$id_user' and id_carte='$id_carte'";
  }
  else if($row['cantitate'] > 1){
    $pret = $row['pret'] - $row['pret_unitar'];
    $cantitate = $row['cantitate'] - 1;
    $query = "update cos set pret = '$pret',cantitate = '$cantitate' where id_user='$id_user' and id_carte='$id_carte'";
  }

  mysqli_query($con, $query);
}

function increaseQty($id_user, $id_carte){
  global $con;
  $query = "select * from cos where id_user='$id_user' and id_carte='$id_carte' limit 1";
  $query_run = $con -> query($query);
  $row = mysqli_fetch_array($query_run);

  $pret = $row['pret'] + $row['pret_unitar'];
  $cantitate = $row['cantitate'] + 1;
  $query = "update cos set pret = '$pret',cantitate = '$cantitate' where id_user='$id_user' and id_carte='$id_carte'";

  mysqli_query($con, $query);
}

function checkout($id, $fname, $lname, $adress){
  global $con;
  $cos_data = "select * from cos where id_user='$id'";
  $cos = $con -> query($cos_data);
            

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $total = 0;
    $produse = "";
    while($row = mysqli_fetch_assoc($cos)){
      $produse = $produse . $row['cantitate'] . "x " . $row['denumire_carte'] . "<br>\n";
      $total = $total + $row['pret'];
    }

    $query = "delete from cos where id_user='$id'";
    mysqli_query($con, $query);

    $date = date("Y-m-d H:i");
    $name = $fname . " " . $lname;
    $query = "insert into comenzi(user_id, produse, nume, adresa, total, data) values('$id','$produse','$name','$adress', '$total', '$date')";  
    mysqli_query($con, $query);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}



