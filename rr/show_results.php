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
	
	// hole die letzten x Ergebnisse aus der DB anahnd des runtime
	$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
	FROM race_results, teilnehmer
	WHERE race_results.userID = teilnehmer.userID
	AND race_results.raceID = $race_ID
	ORDER BY race_results.runtime ASC LIMIT 0 , {$cnt}";
	
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
	$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
	FROM race_results, teilnehmer
	WHERE race_results.userID = teilnehmer.userID
	AND race_results.raceID = $race_ID
	ORDER BY race_results.Lauf_ID DESC LIMIT 0 , {$nbr_last_results}";

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
	$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
	FROM race_results, teilnehmer
	WHERE race_results.userID = teilnehmer.userID
	AND race_results.raceID = $race_ID AND race_results.onTrack = 'true'";
	*/
	// ORDER BY race_results.Lauf_ID DESC LIMIT 0 , {$nbr_last_results}";
	
	// echo '<br \>'.$race_ID.'<br \>';
	$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT
	        FROM race_results INNER JOIN teilnehmer
				USING (userID)
			WHERE race_results.raceID = $race_ID
				  AND race_results.onTrack = 1";

	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	// Anzeige der Ergebnistabellen
	show_table_on_track($result);

}  // end of show_onTrack()

?>