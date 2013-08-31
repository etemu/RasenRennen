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
  include ("menu.php"); 
  echo '<DIV ID="main">';		
if (isset($_GET["f"]) && $_GET["f"] == 1) {
  echo "<p class='fehler'>Login-Daten nicht korrekt</p>";
}
?>
<form method="post" action="login_md5.php">
Ihr Name: <br />
<input type="text" name="name" size="20" />
<br />
Passwort: <br />
<input type="password" name="passwort" size="20" /><br />
<input type="submit" value="Login" />
</form>
</div>
<?php
// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");
?>