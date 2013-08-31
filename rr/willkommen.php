<?php
session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>Rasenrennen 4.0 2013</TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <LINK REL="stylesheet" type="text/css" HREF="/css/position.css">
  <LINK REL="stylesheet" type="text/css" HREF="/css/design_screen.css" media="screen">
  <LINK REL="stylesheet" type="text/css" HREF="/css/menu_screen.css" media="screen">
  <link rel="stylesheet" type="text/css" href="/css/menu_print.css" media="print">
  <LINK REL="stylesheet" type="text/css" HREF="/css/design_print.css" media="print">
 </HEAD>
 <BODY>
  <DIV ID="header">
		<img src="frOErider.jpg">
  </DIV>
<?php
  // das linke Menu laden 
  // include ("menu.php"); 
  include ("menu.php"); 
  echo '<DIV ID="main">';		
  
  echo "<h1>Hallo {$_SESSION['name']}</h1>";
?>
<p>Dir steht jetzt unten links der Adminbereich zur Verf&uuml;gung !</p>
<p><a href="logout.php">Ausloggen</p>

</div>
<!-- </body> 
</html>  -->
<?php
// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");
?>

<?php
} else {
  $host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
  $uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
  $extra = "start.php";
  header("Location: http://$host$uri/$extra");
}
?>
