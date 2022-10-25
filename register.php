<!DOCTYPE html>
<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
if (empty($_SESSION['prev'])) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include("include/nustatymai.php");
include("include/functions.php");
if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti

$_SESSION['prev']="register";
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<div class="login-form">
    <form action="procregister.php" method="POST" class="login">  
        <h2 class="text-center">Registruotis</h2>      
		<div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Elektroninis paštas" value="<?php echo $_SESSION['mail_login']; ?>">
        </div>
        <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="Naudotojo vardas" value="<?php echo $_SESSION['name_login'];  ?>">
			<?php echo $_SESSION['name_error']; ?>
        </div>
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Slaptažodis" value="<?php echo $_SESSION['pass_login']; ?>">
			<?php echo $_SESSION['pass_error']; ?>        
		</div>
		<?php
			if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] )
				{echo "<p style=\"text-align:left;\">Rolė<br>";
				echo "<select name=\"role\">";
   				foreach($user_roles as $x=>$x_value)
  				{echo "<option ";
        	 		if ($x == DEFAULT_LEVEL) echo "selected ";
             		echo "value=\"".$x_value."\" ";
         	 		echo ">".$x."</option></p>";
				}
			}
		?>
        <div class="form-group">
            <input type="submit" value="Registruoti" class="btn btn-primary btn-block"</button>
        </div>       
    </form>
    <p class="text-center"><a href="login.php">Jau naudotojas? Prisijunk čia</a></p>
	<p class="text-center"><a href="index.php">Grįžti į pagrindinį puslapį</a></p>
</div>
</body>
</html>