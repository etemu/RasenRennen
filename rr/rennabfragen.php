<?php
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 29.07.2013
 */
include ("header.php"); 
//include ("config.php"); 
 // das linke Menu laden 
include ("menu.php"); 
include ("show_results.php");

// start of main-DIV
echo "<DIV ID='main'>";

$timestamp = time();
$datum = date("d.m.Y - H:i:s", $timestamp);
//echo $datum;

if($_GET['rennID'] == 3)
{
	echo "<h1>Seeding (Aktualisierung automatisch alle " . $auto_refresh_cycle . " sek / letzte Aktualisierung: " . $datum .  "</h1>";
}

if($_GET['rennID'] == 4)
{
	echo "<h1>Finale (Aktualisierung automatisch alle " . $auto_refresh_cycle . " sek / letzte Aktualisierung: " . $datum .  "</h1>";
}

// Aufruf der einzelnen Rennergebnisse 
// noch nicht implementiert 
// !!! WORKAROUND  !!!!
if ($_GET['data_sets'] < 33)
{
	show_last_results ($_GET['rennID']);
}

//echo "<br \><b>Die besten " . $_GET['data_sets'] . " Zeiten:</b>";
show_race_results ($_GET['rennID'],$nbr_race_results);

// end of main-DIV
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>