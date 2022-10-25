<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();

include ("dbConn.php");
include("include/functions.php");
// cia sesijos kontrole
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
                    <h1 class="display-4 fw-bolder">Dalių palyginimas</h1>
					<p class="lead fw-normal text-white-50 mb-0">Vilius Jakumas IFF-9/8</p>
                </div>
						<?php
           
    		if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    		{                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
				inisession("part");   //   pavalom prisijungimo etapo kintamuosius
				$_SESSION['prev']="index"; 
        
        		include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
			}		
		?>	
            </div>
        </header>


        <!-- Section-->
        <br>
		<section>
        <div class = "container">
            <div class = "row" >
        <div class = "col-">
        <form action="" method="post">
        <label for="dalisID1">1-osios dalies numeris (ID)</label>
        <input type="text" class="form-control" required name="dalisID1">
		<br>
		<label for="dalisID2">2-osios dalies numeris (ID)</label>
        <input type="text" class="form-control" required name="dalisID2">
        <br>
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Palyginti"></button>
        </form>
        </div>
        </div>
        </div>
        </section>
<?php
        if(isset($_POST['submit']))
{		
    $dalisID1 = $_POST['dalisID1'];
	$dalisID2 = $_POST['dalisID2'];

    $query = "SELECT parts.delivery as pristatymodata, parts.name as pavadinimas, parts.id as id, parts.manufacturer as gamintojas, parts.quantity as kiekis, parts.price as kaina, users.username as tiekejas 
						FROM parts INNER JOIN users ON parts.userid = users.userid WHERE parts.id = '$dalisID1' OR parts.id='$dalisID2'";

        $result = mysqli_query($db,$query);
			if(!$result)
    			{
        			echo mysqli_error($result);
    			}
                else{
                    ?>
                        <div class="container"> 
		                    <table class="table">
  			                    <tr>
    			                    <td><b>Gamintojas</b></td>
									<td><b>Pavadinimas</b></td>
    			                    <td><b>Kiekis</b></td>
    			                    <td><b>Vieneto kaina</b></td>
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
				<td><?php echo $data['pavadinimas']; ?></td>
    			<td><?php echo $data['kiekis']; ?></td>
    			<td><?php echo $data['kaina']; ?></td>
                <td><?php echo $data['tiekejas']; ?></td>
				<td><?php echo $data['pristatymodata']; ?></td>
                <td><?php echo $data['id']; ?></td>
  			</tr>
		<?php
		}
		?>
                    </table>
                </div>
                    <?php
    			}
}
mysqli_close($db); // Close connection
?>
        </body>
        </html>
