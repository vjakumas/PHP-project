<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "useredit")))
{header("Location: logout.php");exit;
}
if ($_SESSION['prev'] == "index")								  
	{$_SESSION['mail_login'] = $_SESSION['umail'];
	$_SESSION['passn_error'] = "";      // papildomi kintamieji naujam password įsiminti
	$_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "useredit"; 
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
                    <h1 class="display-4 fw-bolder">Paskyros redagavimas</h1>
					<p class="lead fw-normal text-white-50 mb-0">Vilius Jakumas IFF-9/8</p>
                </div>
                <?php
                    include("include/meniu.php");  //įterpiamas meniu pagal vartotojo rolę
                ?>	
            </div>
        </header>
                <div align="center">   <font size="4" color="#ff0000"><?php echo $_SESSION['message']; ?><br></font>  
					
      <table bgcolor=#C3FDB8>
        <tr><td>
		<form action="procuseredit.php" method="POST" class="login">             
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
        
        <p style="text-align:left;">Dabartinis slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            <?php echo $_SESSION['pass_error']; ?>
        </p>
			
		<p style="text-align:left;">Naujas slaptažodis:<br>
            <input class ="s1" name="passn" type="password" value="<?php echo $_SESSION['passn_login']; ?>"><br>
            <?php echo $_SESSION['passn_error']; ?>
        </p>	
			
		<p style="text-align:left;">E-paštas:<br>
			<input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
			<?php echo $_SESSION['mail_error']; ?>
        </p> 
			
        <p style="text-align:left;">
            <input type="submit" name="login" value="Atnaujinti"/>     
        </p>  
        </form>
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
	


