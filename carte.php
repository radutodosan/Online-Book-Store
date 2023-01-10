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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- fisier CSS -->
    <link rel="stylesheet" type="text/css" href="style1.css?version=1">
</head>
<body>

    
    <!-- bara navigatie -->
    <header style="padding:0.5rem 7%; ">

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

    <section class="product" id="product">
    <?php
        if(isset($_GET['product'])){
            $stoc_id = $_GET['product'];
            $_SESSION['carte_id'] = $stoc_id;
            $stoc_data = get_active("stoc", $stoc_id);
            $stoc = mysqli_fetch_array($stoc_data);
            if($stoc){
    ?>
        <div class="image">
            <img src="<?php echo $stoc["img"] ?>" alt="">
        </div>
            <div class ="content">
                <h1><?php echo $stoc["denumire"] ?></h1>
                <h2><i class="fas fa-user"></i>  <?php echo $stoc["autor"] ?></h2>
                <h3><i class="fas fa-book"></i>  <?php echo $stoc["categorie"] ?></h3>
    			<div class="mb-3">
    				<i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <i class="fas fa-star star-light mr-1 main_star"></i>
                    <b style="color:gold; font-size:12px"><span id="average_rating">0.0</span> / 5</b><br>
                    <h3><span id="total_review">0</span> Reviews</h3>
				</div>
                <h2>Pret: <?php echo $stoc["pret"] ?> RON</h3>
                <h3>Stoc: <?php echo $stoc["stoc"] ?> </h3>
                
                <form class="addtocart"
                <?php if($user_data == -1){ ?> action="login.php" <?php }else{ ?> method="POST" <?php } ?>
                >
                    <input type="number" name="cantitate" class="addtocartbar" value="1">
                    <button type="submit" class="addtocartbtn"><i class="fas fa-shopping-cart"></i></button>
                </form>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, beatae. Modi quos   excepturi id quibusdam? Molestiae quis nihil non debitis!Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, beatae. Modi quos   excepturi id quibusdam? Molestiae quis nihil non debitis!</p>
            </div>
        <?php
            }
            else{
            }
        }
        else{
        }
        if($user_data != -1)
            addtocart($user_data['id']);
    ?>
    </section>

    <div class="container">
    	<h1 class="mt-5 mb-5">Review <?php echo $stoc["denumire"] ?></h1>
    	<div class="card">
    		<div class="card-header"> </div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">Write Review Here</h3>
    					<button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content"></div>
    </div>

    
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

</body>
</html>




<div id="review_modal" class="modal" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="close" >
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        	<div class="form-group">
	        		<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
	        	</div>
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>




<script>

$(document).ready(function(){

var rating_data = 0;

$('#add_review').click(function(){

    $('#review_modal').addClass('popup');

});


$('.close').click(function(){

    $('#review_modal').removeClass('popup');

});


$(document).on('mouseenter', '.submit_star', function(){

    var rating = $(this).data('rating');

    reset_background();

    for(var count = 1; count <= rating; count++)
    {

        $('#submit_star_'+count).addClass('text-warning');

    }

});

function reset_background()
{
    for(var count = 1; count <= 5; count++)
    {

        $('#submit_star_'+count).addClass('star-light');

        $('#submit_star_'+count).removeClass('text-warning');

    }
}

$(document).on('mouseleave', '.submit_star', function(){

    reset_background();

    for(var count = 1; count <= rating_data; count++)
    {

        $('#submit_star_'+count).removeClass('star-light');

        $('#submit_star_'+count).addClass('text-warning');
    }

});

$(document).on('click', '.submit_star', function(){

    rating_data = $(this).data('rating');

});

$('#save_review').click(function(){

    var user_name = $('#user_name').val();

    var user_review = $('#user_review').val();

    var carte_id = <?php echo $stoc["ID"] ?>;

    if(user_name == '' || user_review == '')
    {
        alert("Please Fill Both Field");
        return false;
    }
    else
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{rating_data:rating_data, carte_id:carte_id, user_name:user_name, user_review:user_review},
            success:function(data)
            {
                $('#review_modal').removeClass('popup');

                load_rating_data();

                alert(data);
            }
        })
    }

});

load_rating_data();

function load_rating_data()
{
    $.ajax({
        url:"submit_rating.php",
        method:"POST",
        data:{action:'load_data'},
        dataType:"JSON",
        success:function(data)
        {
            $('#average_rating').text(data.average_rating);
            $('#total_review').text(data.total_review);

            var count_star = 0;

            $('.main_star').each(function(){
                count_star++;
                if(Math.ceil(data.average_rating) >= count_star)
                {
                    $(this).addClass('text-warning');
                    $(this).addClass('star-light');
                }
            });

            $('#total_five_star_review').text(data.five_star_review);

            $('#total_four_star_review').text(data.four_star_review);

            $('#total_three_star_review').text(data.three_star_review);

            $('#total_two_star_review').text(data.two_star_review);

            $('#total_one_star_review').text(data.one_star_review);

            $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

            $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

            $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

            $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

            $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

            if(data.review_data.length > 0)
            {
                var html = '';

                for(var count = 0; count < data.review_data.length; count++)
                {
                    
                    html += '<div class="row mb-3">';

                    html += '<div class="col-sm-11">';

                    html += '<div class="card">';

                    html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                    html += '<div class="card-body">';

                    for(var star = 1; star <= 5; star++)
                    {
                        var class_name = '';

                        if(data.review_data[count].rating >= star)
                        {
                            class_name = 'text-warning';
                        }
                        else
                        {
                            class_name = 'star-light';
                        }

                        html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                    }

                    html += '<br />';

                    html += data.review_data[count].user_review;

                    html += '</div>';

                    html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                    html += '</div>';

                    html += '</div>';

                    html += '</div>';
                    
                    html += '</div>';
                    

                }

                $('#review_content').html(html);
            }
        }
    })
}

});

</script>

<!-- jquery cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- JS file -->
<script src="script1.js"></script>