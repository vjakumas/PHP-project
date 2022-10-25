<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location: logout.php");exit;}

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
	<header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Dalių krepšelis</h1>
					<p class="lead fw-normal text-white-50 mb-0">Vilius Jakumas IFF-9/8</p>
                </div>
						<?php
        		include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
		?>	
            </div>
        </header>
 <?php
 			$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			$currentUser = $_SESSION['user'];

			$sql = "SELECT parts.id AS daliesid, parts.manufacturer as gamintojas, parts.name as pavadinimas, parts.quantity as kiekis, parts.price as kaina, parts.delivery as pristatymodata, users.username as tiekejas
			FROM parts INNER JOIN cart
			ON parts.id = cart.part_id 
			INNER JOIN users
            ON parts.userid = users.userid
			WHERE cart.manager = '$currentUser'";


			$result = mysqli_query($db, $sql);
			if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Nėra įtrauktų dalių"; exit;}
 ?> 
		</table>
		<br>
		
		<div class="container"> 
		<table class="table">
  			<tr>
			  	<td><b>Gamintojas</b></td>
    			<td><b>Kiekis</b></td>
    			<td><b>Vieneto kaina</b></td>
				<td><b>Pavadinimas</b></td>
                <td><b>Tiekėjas</b></td>
				<td><b>Pristatymo data</b></td>
                <td><b>#ID</b></td>
  			</tr>
			
		<?php
			while($data = mysqli_fetch_array($result))
			{
			?>
  			<tr>
   				<td><?php echo $data['gamintojas']; ?></td>
    			<td><?php echo $data['kiekis']; ?></td>
    			<td><?php echo $data['kaina']; ?></td>
                <td><?php echo $data['pavadinimas']; ?></td>
				<td><?php echo $data['tiekejas']; ?></td>
				<td><?php echo $data['pristatymodata']; ?></td>
				<td><?php echo $data['daliesid']; ?></td>
  			</tr>	
		<?php
		}
		?>
		</table>
	</div>
	<form action="" method="post">
		<br>
		<div style="text-align:center;">
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Patvirtinti užsakymą"></button>
        </form>
		</div>


		<?php
if(isset($_POST['submit']))
{		
	
	//$sql = "SELECT cart.id as id, cart.manager as manager";


	//$sql2 = "INSERT INTO `orders_parts`(`part_id`, `order_id`) VALUES ('$manager',1)";
	$insert = mysqli_query($db, $sql);
	// if (!$insert || (mysqli_num_rows($insert) < 1)
	// {
	// 	echo "Nėra įtrauktų dalių"; 
	// 	exit;
	// }
			$tiekejas = $_SESSION['userid'];
			$sql2="INSERT INTO `orders` (`manager`,`status`) VALUES ('$tiekejas','1')";	
			$paleisti = mysqli_query($db, $sql2);
			$id = mysqli_insert_id($db);
			while($data = mysqli_fetch_array($insert))
			{
				$daliesid = $data['daliesid'];
				//$sql4="SELECT * FROM orders WHERE id = SCOPE_IDENTITY()";
				$sql3="INSERT INTO `order_parts` (`part_id`, `order_id`) VALUES ('$daliesid','$id')";
				$paleisti2 = mysqli_query($db, $sql3);
			
		}

	
			
}
mysqli_close($db); // Close connection
?>
  </body>
  </html>
