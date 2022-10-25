<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev']="admin";
date_default_timezone_set("Europe/Vilnius");
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
            </div>
        </header>
        <table class="center" >
		<center><b><?php echo $_SESSION['message']; ?></b></center>
		<form name="vartotojai" action="procadmin.php" method="post">
	    <table class="center" style=" width:75%; border-width: 2px; border-style: dotted;">
		         <tr><td width=30%><a href="index.php">[Atgal]</a></td><td width=30%> 
	<?php
		   if ($uregister != "self") echo "<a href=\"register.php\"><b>Registruoti naują vartotoją<b></a><td>";
		   else echo "</td>";
	?>
		   
			<td width="30%">Atlikite reikalingus pakeitimus ir</td><td width="10%"> <input type="submit" value="Vykdyti"></td></tr></table> <br> 
<?php
    
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT username,userlevel,email,timestamp "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
?>
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vartotojo vardas</b></td><td><b>Rolė</b></td><td><b>E-paštas</b></td><td><b>Paskutinį kartą aktyvus</b></td><td><b>Šalinti?</b></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
	    $level=$row['userlevel']; 
	  	$user= $row['username'];
	  	$email = $row['email'];
      	$time = date("Y-m-d G:i", strtotime($row['timestamp']));
      	echo "<tr><td>".$user. "</td><td>";
    	echo "<select name=\"role_".$user."\">";
      	$yra=false;
		foreach($user_roles as $x=>$x_value)
  			{echo "<option ";
        	 if ($x_value == $level) {$yra=true;echo "selected ";}
             echo "value=\"".$x_value."\" ";
         	 echo ">".$x."</option>";
        	 }
		if (!$yra)
        {echo "<option selected value=".$level.">Neegzistuoja=".$level."</option>";}
        $UZBLOKUOTAS=UZBLOKUOTAS; echo "<option ";
        if ($level == UZBLOKUOTAS) echo "selected ";
          echo "value=".$UZBLOKUOTAS." ";
        echo ">Užblokuotas</option>";      // papildoma opcija
      echo "</select></td>";
          
      echo "<td>".$email."</td><td>".$time."</td>";
      echo "<td><input type=\"checkbox\" name=\"naikinti_".$user."\">";
   }
?>
        </table>
        <br> <input type="submit" value="Vykdyti">
        </form>
    </body></html>
