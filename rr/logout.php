<?php
session_start();
// l�schen aller Inhalte
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    // cookies l�schen mit negativem Ablaufdatum
	setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();
$host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
$uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
$extra = "my_index.php";
header("Location: http://$host$uri/$extra");
?>
