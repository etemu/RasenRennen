<?php
   
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 28.6.2013
 */

// den Header includieren
include ("header.php");
// das linke Menu laden 
include ("menu.php"); 
include ("show_table.php");

// erst mal die DB aktualisieren
// fällt weg, da SATAR das Ergebins direkt in die DB schreibt
//include 'ReadCSV.php';

// start of main-DIV
echo "<DIV ID='main'>";

$timestamp = time();
$datum = date("d.m.Y - H:i:s", $timestamp);
//echo $datum;
echo "<br /> Letzte Aktualisierung: " . $datum . "<br />";

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

echo '<br \><b>Men Qualiläufe:</b>';
// hole alle Ergebnisse aus der DB anahnd des runtime
$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
FROM race_results, teilnehmer
WHERE race_results.userID = teilnehmer.userID
AND race_results.raceID = 3
AND teilnehmer.KAT = 'Men'
ORDER BY race_results.runtime ASC";

$result = $db->query($sql);
if (!$result)
{
	die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
}

// Anzeige der Ergebnistabellen
show_table_best_results($result, 1);

// end of main-DIV
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>