<html>
<html lang="en">
<style type="text/css">
	td.white {color: white;}
</style>
<?php
// meniu.php  rodomas meniu pagal vartotojo rolę
$_SESSION['filtras'] = "VISOS"; 
if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td class=\"white\">";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
        if (($userlevel == $user_roles["Vadybininkas"] || $userlevel == $user_roles["Direktorius"])) {
            echo "[<a href=\"useredit.php\">Redaguoti paskyra</a>] &nbsp;&nbsp;";
            echo "[<a href=\"tiekejai.php\">Tiekeju sąrašas</a>] &nbsp;&nbsp;";
            echo "[<a href=\"daliespaieska.php\">Dalies paieška</a>] &nbsp;&nbsp;";
            echo "[<a href=\"palygintidalis.php\">Palyginti dalis</a>] &nbsp;&nbsp;";
            echo "[<a href=\"manouzsakymai.php\">Mano užsakymai</a>] &nbsp;&nbsp;";
            echo "[<a href=\"krepselis.php\">Krepšelis</a>] &nbsp;&nbsp;";
       		}   
     //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        if (($userlevel == $user_roles["Tiekejas"])) {
            echo "[<a href=\"useredit.php\">Redaguoti paskyra</a>] &nbsp;&nbsp;";
            echo "[<a href=\"manodalys.php\">Mano dalys</a>] &nbsp;&nbsp;";
            echo "[<a href=\"sukurtidali.php\">Sukurti dalį</a>] &nbsp;&nbsp;";
       		}   
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles["Direktorius"] ) {
            echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 