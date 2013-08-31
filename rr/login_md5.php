<?php
session_start();
$host = htmlspecialchars($_SERVER["HTTP_HOST"]);
$uri  = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
if (isset($_POST["name"]) 
	&& $_POST["name"] == "frOErider" 
	//&& md5($_POST["passwort"]) == "e8636ea013e682faf61f56ce1cb1ab5c") {
	&& md5($_POST["passwort"]) == "8cfef1d4bef540172890befa65da4118") {
   $_SESSION["name"] = "frOErider";
   $_SESSION["login"] = "ok";
   $extra = "willkommen.php?" . session_name() . "=" . session_id();
 } else {
   $extra = "start.php?f=1";
 }
 header("Location: http://$host$uri/$extra");
 ?>
