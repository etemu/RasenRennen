<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 19.07.2013
 * schöne Seite für Forms: http://www.themaninblue.com/experiment/InForm/index.htm
 */

// den Header includieren
// hier sind die DIVs für den Header angeordnet
include ("header.php");
// include ("config.php");
include ("menu.php");
include ("show_table.php");
 ?>

<DIV ID="main">

<?php

echo $_GET['race'];

// 0 wir beim Aufruf aus dem Menu mitgeliefert 
if($_GET['race'] != NIX)
{
	
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
	
	// Hier alle möglichen Rennabfragen 
	if($_GET['race'] == 'Seeding')
	{
		$raceID = 3;
	}
	else if($_GET['race'] == 'Finale')
	{
		$raceID = 4;
	}
		
	echo "<br><h1>Die " . $_GET['race'] ."-L&auml;ufe sortiert nach " .$_GET['sort'] . " DS " .$_GET['von']. " bis " .$_GET['bis'] . "</h1>";
	/* hier jetzt die entsprechenden SQL Befehle formulieren */
	// Anzahl der zu lesenden Datensätze 
	$cnt = $_GET['bis'] - $_GET['von'] + 1;
	$von = $_GET['von'] -1;
	$bis = $_GET['bis'];
	if ($_GET['sort'] == StrtNr)
	{
		$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
		FROM race_results, teilnehmer
		WHERE race_results.userID = teilnehmer.userID
		AND race_results.raceID = {$raceID}
		ORDER BY race_results.userID ASC LIMIT {$von} , {$bis}";
	}

	if ($_GET['sort'] == Name)
	{
		$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
		FROM race_results, teilnehmer
		WHERE race_results.userID = teilnehmer.userID
		AND race_results.raceID = {$raceID}
		ORDER BY teilnehmer.Name ASC LIMIT {$von} , {$bis}";
	}

	if ($_GET['sort'] == runtime)
	{
		$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
		FROM race_results, teilnehmer
		WHERE race_results.userID = teilnehmer.userID
		AND race_results.raceID = {$raceID}
		ORDER BY race_results.runtime ASC LIMIT {$von} , {$bis}";
	}

	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	// Anzeige der Ergebnistabellen
	show_table_best_results($result, $_GET['von']);
}	
	
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>
