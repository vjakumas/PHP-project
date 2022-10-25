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
                    <h1 class="display-4 fw-bolder">Atlikti užsakymai</h1>
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

			// $sql = "SELECT order_parts.id as uzsakymoid, parts.id AS daliesid, parts.manufacturer as gamintojas, parts.name as pavadinimas, parts.quantity as kiekis, parts.price as kaina, parts.delivery as pristatymodata, users.username as tiekejas
			// FROM parts INNER JOIN order_parts
			// ON parts.id = order_parts.part_id 
			// INNER JOIN users
            // ON parts.userid = users.userid";

			// $tiekejas = $_SESSION['userid'];

			// $sql = "SELECT id, status FROM `orders` 
			// WHERE manager = '$tiekejas'";


			// $result = mysqli_query($db, $sql);

// 			while($data = mysqli_fetch_array($result))
// 			{
// 					$orderID = $data['id'];
// 					$orderStatus = $data['status'];

// 					$sql = "SELECT order_parts.id as uzsakymoid, parts.id AS daliesid, parts.manufacturer as gamintojas, parts.name as pavadinimas, parts.quantity as kiekis, parts.price as kaina, parts.delivery as pristatymodata, users.username as tiekejas
// 					FROM parts INNER JOIN order_parts
// 					ON parts.id = order_parts.part_id 
// 					INNER JOIN users
//             		ON parts.userid = users.userid
// 					WHERE order_id = $orderID
// ";
// 					$result2 = mysqli_query($db, $sql);

// 					while($data2 = mysqli_fetch_array($result2))
// 					{

// 					}
					


				// /	echo $orderID;
			// }



 ?> 
		
			
		<?php
		$tiekejas = $_SESSION['userid'];

		$sql = "SELECT id, status FROM `orders` 
		WHERE manager = '$tiekejas'";
		$result = mysqli_query($db, $sql);
while($data = mysqli_fetch_array($result))
{
		$orderID = $data['id'];
		$orderStatus = $data['status'];

		$sql = "SELECT order_parts.id as uzsakymoid, parts.id AS daliesid, parts.manufacturer as gamintojas, parts.name as pavadinimas, parts.quantity as kiekis, parts.price as kaina, parts.delivery as pristatymodata, users.username as tiekejas
		FROM parts INNER JOIN order_parts
		ON parts.id = order_parts.part_id 
		INNER JOIN users
		ON parts.userid = users.userid
		WHERE order_id = $orderID";
		$result2 = mysqli_query($db, $sql);
		?>
		<?php echo "Užsakymo id: $orderID"; ?>
		<br>

		</table>
		<?php
		$sqlbusena = "SELECT * FROM order_status WHERE id = $orderStatus";
		$resultBusena = mysqli_query($db, $sqlbusena);
		$dataBusena = mysqli_fetch_array($resultBusena);
		$orderStatus = $dataBusena['status'];
		echo "           Būsena: $orderStatus"; ?>
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
		while($data2 = mysqli_fetch_array($result2))
		{
			?>
		
			  
			  <tr>
				   <td><?php echo $data2['gamintojas']; ?></td>
				<td><?php echo $data2['kiekis']; ?></td>
				<td><?php echo $data2['kaina']; ?></td>
				<td><?php echo $data2['pavadinimas']; ?></td>
				<td><?php echo $data2['tiekejas']; ?></td>
				<td><?php echo $data2['pristatymodata']; ?></td>
				<td><?php echo $data2['daliesid']; ?></td>
			  </tr>	
			 
		<?php
		}
		?>
		</div>
		</table>
		<?php
	}
		// $result = mysqli_query($db, $sql);
		
		// }
		?>

	</div>
	</div>
  </body>
  </html>
