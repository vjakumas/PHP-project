<?php
//nustatymai.php
define("DB_SERVER", "localhost");
define("DB_USER", "stud");
define("DB_PASS", "stud");
define("DB_NAME", "it_projektas");
define("TBL_USERS", "users");
define("TBL_PARTS", "parts");
$user_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
	"Direktorius"=>"9",
	"Vadybininkas"=>"4",
	"Tiekejas"=>"5",);   // galioja ir vartotojas "guest", kuris neturi userlevel
define("DEFAULT_LEVEL","Vadybininkas");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Direktorius");  // kas turi vartotojų valdymo teisę
define("UZBLOKUOTAS","255");      // vartotojas negali prisijungti kol administratorius nepakeis rolės
$uregister="both";  // kaip registruojami vartotojai
// self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai
// * Email Constants - 
define("EMAIL_FROM_NAME", "Demo");
define("EMAIL_FROM_ADDR", "demo@ktu.lt");
define("EMAIL_WELCOME", false);
