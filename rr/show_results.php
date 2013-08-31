<?php
   
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 16.7.2013
 */
 
include ("show_table.php");
 
// Function generiert den HTML-Code zur Anzeige der besten 10 Läufe eines Rennens
// Parameter: RennID 
//			  cnt: Anzahl der auszulesenden Datensätze 
function show_race_results ($race_ID, $cnt)
{
	// laden der DB-Einstellungen (in php keine globalen variablen)
	include ("config.php");

	// --------------------------------------------------------------
	// der datenbankzugriff zur Anzeige der Rennergebnisse
	// ab jetzt habe wir ein Objekt vom Typ eine my SQL Datenbank mit dem wir arbeiten können
	// mysql ( MYSQL_HOST, BENUTZER, KENNWORT, DB_NAME );
	$db = new mysqli($db_host,$db_user , $db_pass, $db_name);

	if (mysqli_connect_errno()) {
		die ('<br \>  Konnte keine Verbindung zur Datenbank aufbauen: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
	}
	else
			echo "  ( Verbindung zur Datenbank erfolgreich hergestellt ) <br \>";

	// der Datenbankzugriff zur Rennauswertung
	// hier die entsprechenden SQL-Befehle anhend des abgesendeten Formulars generieren
	// 31.5.2013 Thomas Clemens
	// die besten Zehn 

	// charset einstellen 31.5.2013 CLM  (Muss sonst keine Umlaute)
	$db->query('SET NAMES utf8');
	
	// hole die letzten x Ergebnisse aus der DB anahnd des Laufzeit
	$sql = "SELECT rennen_1.idRennen, rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, rennen_1.LaufZeit
	FROM rennen_1, teilnehmer
	WHERE rennen_1.StartNr = teilnehmer.StartNr
	AND rennen_1.idRennen = $race_ID
	ORDER BY rennen_1.Laufzeit ASC LIMIT 0 , {$cnt}";
	
	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	// Anzahl der tatsächlich gelesenen Datensätze 
	echo "Die besten " . $result->num_rows . " Zeiten ";
	// Anzeige der Ergebnistabellen
	show_table_best_results($result,1);

}  // end of show_race_results()


// ---------------------------------------------------------------------------------------

// Function generiert den HTML-Code zur Anzeige der letzten x Rennläufe
// Parameter: RennID
function show_last_results ($race_ID)
{
	// laden der DB-Einstellungen (in php keine globalen variablen)
	include ("config.php");

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

			
	// charset einstellen 31.5.2013 CLM  (Muss sonst keine Umlaute)
	$db->query('SET NAMES utf8');						
			
	// der Datenbankzugriff zur Rennauswertung
	// hier die entsprechenden SQL-Befehle anhend des abgesendeten Formulars generieren
	// 31.5.2013 Thomas Clemens
	// hole die letzten 5 Ergebnisse aus der DB anahnd des Primary Key (autoinkrement)
	$sql = "SELECT rennen_1.idRennen, rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, rennen_1.LaufZeit
	FROM rennen_1, teilnehmer
	WHERE rennen_1.StartNr = teilnehmer.StartNr
	AND rennen_1.idRennen = $race_ID
	ORDER BY rennen_1.Lauf_ID DESC LIMIT 0 , {$nbr_last_results}";

	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	echo '<br \><b>Die ' . $result->num_rows . ' letzten Zeiten:</b>';
	// Anzeige der Ergebnistabellen
	show_table_last_results($result);

}  // end of show_last_results()


// ---------------------------------------------------------------------------------------

// Function generiert den HTML-Code zur Anzeige der letzten x Rennläufe
// Parameter: RennID
function show_onTrack ($race_ID)
{
	// laden der DB-Einstellungen 
	
	// laden der DB-Einstellungen (in php keine globalen variablen)
	include ("config.php");

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

			
	// charset einstellen 31.5.2013 CLM  (Muss sonst keine Umlaute)
	$db->query('SET NAMES utf8');						
			
	// der Datenbankzugriff zur Rennauswertung
	// hier die entsprechenden SQL-Befehle anhend des abgesendeten Formulars generieren
	// 3.6.2013 Thomas Clemens
	echo '<br \><b>Aktuell auf der Strecke: </b>';
	// hole die aktuellen Fahrer anhand des bool-Wertes "Ontrack" aus der DB auslesen 
	/*
	$sql = "SELECT rennen_1.idRennen, rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, rennen_1.LaufZeit
	FROM rennen_1, teilnehmer
	WHERE rennen_1.StartNr = teilnehmer.StartNr
	AND rennen_1.idRennen = $race_ID AND rennen_1.onTrack = 'true'";
	*/
	// ORDER BY rennen_1.Lauf_ID DESC LIMIT 0 , {$nbr_last_results}";
	
	// echo '<br \>'.$race_ID.'<br \>';
	$sql = "SELECT rennen_1.idRennen, rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT
	        FROM rennen_1 INNER JOIN teilnehmer
				USING (StartNr)
			WHERE rennen_1.idRennen = $race_ID
				  AND rennen_1.onTrack = 1";

	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	// Anzeige der Ergebnistabellen
	show_table_on_track($result);

}  // end of show_onTrack()

?>