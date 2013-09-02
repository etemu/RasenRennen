<?php
/* Verfasser: Thomas Clemens, Alex Shure
 * Letzte Änderung: 02.09.2013
 */
// MUSS als erstes stehen 
session_start ();   
include ("config.php");  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
 <HEAD>
  <TITLE>Rasenrennen 4.0 2013</TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- zyklischer Aufruf der Rennabfrage, die LaufID muss manuell angepasst werden !!!!  
  -->
  <META HTTP-EQUIV="pragma" CONTENT="no-cache">

<?php

if ($_GET['zykl'] == 1)
{
	  // die Rennläufe 
	  // Seeding
	  if($_GET['rennID'] == 3)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=rennabfragen.php?rennID=3&amp;data_sets=10&zykl=1&amp;battleID=666">';
	  }
	  // Finale 
      if($_GET['rennID'] == 4)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=rennabfragen.php?rennID=4&amp;data_sets=32&zykl=1&amp;battleID=666">';
	  }
      // die Battles der Männer 
	  // erstes Battle (Sonderfall, da aus Finalzeiten generiert ohne Women und U11)
	  if($_GET['battleID'] == 5)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_1st.php?battleID=5&amp;teilnehmerzahl=32&zykl=1&amp">';
	  }	  
      // die restlichen Battles 
	  // 8tel 
	  if($_GET['battleID'] == 4)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_sub.php?battleID=4&amp;teilnehmerzahl=16&zykl=1&amp">';
	  }	  	  
	  // 4tel 
	  if($_GET['battleID'] == 3)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_sub.php?battleID=3&amp;teilnehmerzahl=8&zykl=1&amp">';
	  }	  	  	  
	  // Halbfinale
	  if($_GET['battleID'] == 2)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_sub.php?battleID=2&amp;teilnehmerzahl=4&zykl=1&amp">';
	  }	  	  	  
	  // Finale 
	  if($_GET['battleID'] == 1)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_sub.php?battleID=1&amp;teilnehmerzahl=2&zykl=1&amp">';
	  }	  	  
      // die Battles der Damen
	  // erstes Battle (Sonderfall, da aus Finalzeiten generiert ohne Men, U11)
	  // 4tel 
	  if($_GET['battleID'] == 693)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_women.php?battleID=693&amp;teilnehmerzahl=8&zykl=1&amp">';
	  }	  	  	  
      // die restlichen Battles 
	  // Halbfinale
	  if($_GET['battleID'] == 692)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_sub.php?battleID=692&amp;teilnehmerzahl=4&zykl=1&amp">';
	  }	  	  	  
	  // Finale 
	  if($_GET['battleID'] == 691)
	  {
		echo '<META HTTP-EQUIV=REFRESH CONTENT="' . $auto_refresh_cycle . '; URL=battle_sub.php?battleID=961&amp;teilnehmerzahl=2&zykl=1&amp">';
	  }	  	  	  
}
?>

  
  <LINK REL="stylesheet" type="text/css" HREF="css/position.css">
  <LINK REL="stylesheet" type="text/css" HREF="css/design_screen.css" media="screen">
  <LINK REL="stylesheet" type="text/css" HREF="css/menu_screen.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/menu_print.css" media="print">
  <LINK REL="stylesheet" type="text/css" HREF="css/design_print.css" media="print">
  </HEAD>
 <BODY>
  <DIV ID="header">
		<img src="frOErider.jpg">
  </DIV>
