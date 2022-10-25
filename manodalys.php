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
                    <h1 class="display-4 fw-bolder">Mano dalys</h1>
					<p class="lead fw-normal text-white-50 mb-0">Vilius Jakumas IFF-9/8</p>
                </div>
						<?php
        		include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
		?>	
            </div>
        </header>
 <?php
 			$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

			$sql = "SELECT id, manufacturer as gamintojas, price as kaina, quantity as kiekis, name as pavadinimas FROM parts
			WHERE userid ='". $_SESSION['userid'] . "'";


			$result = mysqli_query($db, $sql);
			if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
 ?> 
		</table>
		<br>
		
		<div class="container"> 
		<table class="table">
  			<tr>
    			<td>Gamintojas</td>
    			<td>Kiekis</td>
    			<td>Vieneto kaina</td>
                <td>Dalies pavadinimas</td>
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
				<td><a href="delete.php?id=<?php echo $data['id']; ?>">Šalinti</a></td>
  			</tr>	
		<?php
		}
		?>
		</table>
	</div>
  </body></html>
