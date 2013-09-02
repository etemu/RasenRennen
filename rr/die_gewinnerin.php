<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 20.07.2013
 */

// laden der DB-Einstellungen 
//include ("config.php");
 // den Header includieren
include ("header.php");
// das linke Menu laden 
include ("menu.php"); 

// start of main-DIV
echo "<DIV ID='main'>";

// der datenbankzugriff zur Anzeige der Rennergebnisse
// ab jetzt habe wir ein Objekt vom Typ eine my SQL Datenbank mit dem wir arbeiten können
// mysql ( MYSQL_HOST, BENUTZER, KENNWORT, DB_NAME );
$db = new mysqli($db_host,$db_user , $db_pass, $db_name);

if (mysqli_connect_errno()) {
	die ('<br \>  Konnte keine Verbindung zur Datenbank aufbauen: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}
else
	echo "<br \> Verbindung zur Datenbank erfolgreich hergestellt <br \>";			

// charset einstellen 31.5.2013 CLM  (Muss sonst keine Umlaute)
$db->query('SET NAMES utf8');

$sql = "SELECT btl.StrtNr, 
			btl.BattleID,
			tn.Name,
			tn.Vorname,
			tn.KAT,
			r1.runtime 
		FROM battles btl
		JOIN teilnehmer tn ON tn.userID = btl.StrtNr
		JOIN race_results r1 ON r1.userID = btl.StrtNr
		WHERE btl.battleID = 690";

// DB Zugriff
$result1 = $db->query($sql);

if (!$result1)
{
	die ('Etwas stimmte mit dem 1. Query nicht:<br /> '.$db->error);
}

$zeile = $result1->fetch_array();

echo "<br><br><b> Die Gewinnerin ist: <br><br>";
echo " <h1 class='success'> Startnummer ". $zeile['StrtNr'] . " Name " . $zeile['Vorname'] . " ". $zeile['Name'] . " </h1>";

echo "</DIV>";			
			
include ("footer.html");

?>