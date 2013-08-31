<?php
   
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 28.6.2013
 */

// laden der DB-Einstellungen 
// hier sind die DIVs für den Header angeordnet
include ("header.php");
include ("show_table.php");
// das linke Menu laden 
include ("menu.php"); 

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

echo '<br \><b>U17 Qualiläufe:</b>';
// hole alle Ergebnisse aus der DB anahnd des Laufzeit
$sql = "SELECT rennen_1.idRennen, rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, rennen_1.LaufZeit
FROM rennen_1, teilnehmer
WHERE rennen_1.StartNr = teilnehmer.StartNr
AND rennen_1.idRennen = 3
AND teilnehmer.KAT = 'U17'
ORDER BY rennen_1.Laufzeit ASC";

$result = $db->query($sql);
if (!$result)
{
	die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
}

// Anzeige der Ergebnistabellen
show_table_best_results($result,1);

// end of main-DIV
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>