<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 7.5.2013
 */

// den Header includieren
// hier sind die DIVs für den Header angeordnet
include ("header.php");

// Problem: hier kann ncoh kein code stehen 
// wenn nicht gedruckt werden soll, das linke Menu laden
include ("menu.php");

// start of main-DIV
echo "<DIV ID='main'>";

$timestamp = time();
$datum = date("d.m.Y - H:i:s", $timestamp);
//echo $datum;
echo "<br /> Letzte Aktualisierung: " . $datum . "<br />";

// Aufruf der einzelnen Abfragen
show_all_driver();



// Function generiert den HTML-Code zur Anzeige der besten 10 Läufe eines Rennens
// Parameter: RennID
function show_all_driver ()
{
	// laden der DB-Einstellungen 
	include ("config.php");
	include ("show_table.php");

	// --------------------------------------------------------------
	// der datenbankzugriff zur Anzeige der Rennergebnisse
	// ab jetzt habe wir ein Objekt vom Typ eine my SQL Datenbank mit dem wir arbeiten können
	// mysql ( MYSQL_HOST, BENUTZER, KENNWORT, DB_NAME );
	$db = new mysqli($db_host,$db_user , $db_pass, $db_name);

	if (mysqli_connect_errno()) {
		die ('<br \>  Konnte keine Verbindung zur Datenbank aufbauen: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
	}
	else
			echo "<br \> Verbindung zur Datenbank erfolgreich hergestellt <br \>";

	// der Datenbankzugriff zur Rennauswertung
	// hier die entsprechenden SQL-Befehle anhend des abgesendeten Formulars generieren
	// 31.5.2013 Thomas Clemens
	// die besten Zehn 

	// charset einstellen 31.5.2013 CLM  (Muss sonst keine Umlaute)
	$db->query('SET NAMES utf8');
	
	// hole die letzten x Ergebnisse aus der DB anahnd des Laufzeit
	$sql = "SELECT * FROM `teilnehmer`\n"
    . "ORDER BY `teilnehmer`.`StartNr` ASC LIMIT 0, 300 ";
	
	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	// Anzeige der Ergebnistabellen
	show_table_participants($result);

}  // end of show_all_driver()

// ---------------------------------------------------------------------------------------
// end of main-DIV
echo "</DIV>";


// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>