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
                    <h1 class="display-4 fw-bolder">Dalies paieška</h1>
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
        <label for="daliespavadinimas">Dalies pavadinimas</label>
        <input type="text" class="form-control" required name="daliespavadinimas">
        <br>
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Ieškoti"></button>
        </form>
        </div>
        </div>
        </div>
        </section>
<?php
        if(isset($_POST['submit']))
{		
    $daliespavadinimas = $_POST['daliespavadinimas'];

    $query = "SELECT parts.name as pavadinimas, parts.id as id, parts.manufacturer as gamintojas, parts.quantity as kiekis, parts.price as kaina, parts.delivery as pristatymodata, users.username as tiekejas FROM parts INNER JOIN users ON parts.userid = users.userid WHERE parts.name = '$daliespavadinimas'";

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
    			                    <td><b>Kiekis</b></td>
    			                    <td><b>Vieneto kaina</b></td>
                                    <td><b>Tiekėjas</b></td>
                                    <td><b>Pristatymo data</b></td>
                                    <td><b>#ID</b></td>
  			                    </tr>
                                  <?php
                                    echo "Ieškoma dalis: $daliespavadinimas";
			while($data = mysqli_fetch_array($result))
			{
			?>
            <br>
  			<tr>
   				<td><?php echo $data['gamintojas']; ?></td>
    			<td><?php echo $data['kiekis']; ?></td>
    			<td><?php echo $data['kaina']; ?></td>
                <td><?php echo $data['tiekejas']; ?></td>
                <td><?php echo $data['pristatymodata']; ?></td>
                <td><?php echo $data['id']; ?></td>
                <td><a href="pridetiiuzsakyma.php?id=<?php echo $data['id']; ?>">Įtraukti į užsakymą</a></td>
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
