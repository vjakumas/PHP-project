<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...
session_start();
include ("dbConn.php");
include("include/functions.php");

if(isset($_POST['submit']))
{		
    $manufacturer = $_POST['manufacturer'];
    $price= $_POST['price'];
    $quantity= $_POST['quantity'];
    $name= $_POST['name'];
    $userid = $_SESSION['userid'];
    $delivery = $_POST['delivery'];
	

    $insert = mysqli_query($db,"INSERT INTO `parts`(`manufacturer`, `price`,`quantity`, `name`,`userid`,`delivery`) VALUES ('$manufacturer','$price','$quantity','$name','$userid','$delivery')");
			 
			if(!$insert)
    			{
        			echo mysqli_error($insert);
    			}else{
						?>
                        <div class="alert alert-success" role="alert">
                                 Dalis sukurta sekmingai!
                        </div>
                        <?php
    			}

}

mysqli_close($db); // Close connection
?>
<html>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>IT Projektas</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Sukurti dalį</h1>
					<p class="lead fw-normal text-white-50 mb-0">Vilius Jakumas IFF-9/8</p>
                </div>
                <?php
                    include("include/meniu.php");  //įterpiamas meniu pagal vartotojo rolę
                ?>	
            </div>
        </header>

        <!-- Section-->
		<section class="py-5">
			<div class="container px-4 px-lg-5 my-5">
			<form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="manufacturer">Gamintojas</label>
                <input type="text" class="form-control" required name="manufacturer">
                <label for="price">Kaina</label>
                <input type="number" class="form-control" required name="price" min="0">
                <label for="quantity">Kiekis</label>
                <input type="text" class="form-control" required name="quantity">
                <label for="name">Pavadinimas</label>
                <input type="text" class="form-control" required name="name">
                <label for="delivery">Pristatymo data</label>
                <input type="date" class="form-control" required name="delivery">
                <br>
                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Patvirtinti"></button>
            </div>  
        </form>
		</div>
		</section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Vilius Jakumas IFF-9/8</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
	</html>
