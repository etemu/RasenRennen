<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 19.07.2013
 * schöne Seite für Forms: http://www.themaninblue.com/experiment/InForm/index.htm
 */

// den Header includieren
// hier sind die DIVs für den Header angeordnet
// include ("config.php");
include ("header.php");
include ("menu.php");
include ("show_table.php");
 ?>

<DIV ID="main">

<!-- <form name="eingabe" action="form_race_results.php" method="get">  -->

<!--
Das gewünschte Rennen sowie Anzahl der Datensätze über Textfedl wählen
-->
<form>
<fieldset>
	<legend><strong>Datensatz w&auml;hlen:</legend>
	<label class="first" for="race">
		Race
		<select id="race" name="race">
				<option >Finale</option>
				<option>Seeding</option>
				<!-- <option>1</option>
				<option>2</option>
				-->
		</select>
	</label>

	<label class="first" for="sort">
		Sortierung
		<select id="sort" name="sort">
				<option selected="selected">runtime</option>
				<option>Name</option>
				<option>StrtNr</option>
				<!-- <option>2</option> -->
		</select>
	</label>

	Datens&auml;tze:
	<label for="von">	
		von:
		<input id="von" name="von" type="text" value=1 size="5">
	</label>
	<label for="bis">	
		bis:
		<input id="bis" name="bis" type="text" value=10 size="5">
	</label>

	<input type="submit" name="anzeigen" value="Anzeigen" formaction="form_race_results.php" formmethod="get" >	
	<!-- <input type="submit" name="drucken" value="Drucken" formaction="print_race_results.php" formmethod="get" >	-->
</fieldset>

</form>

<?php

echo $_GET['race'];

// 0 wir beim Aufruf aus dem Menu mitgeliefert 
if($_GET['race'] != 999)
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
	if (!empty($_GET['sort']))
	{
		if ($_GET['sort'] == 'StrtNr')
		{
			$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
			FROM race_results, teilnehmer
			WHERE race_results.userID = teilnehmer.userID
			AND race_results.raceID = {$raceID}
			ORDER BY race_results.userID ASC LIMIT {$von} , {$bis}";
			// keine Platzierungen anzeigen 
			$pos = 0;
		}
		if ($_GET['sort'] == 'Name')
		{
			$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
			FROM race_results, teilnehmer
			WHERE race_results.userID = teilnehmer.userID
			AND race_results.raceID = {$raceID}
			ORDER BY teilnehmer.Name ASC LIMIT {$von} , {$bis}";
			// keine Platzierungen anzeigen 
			$pos = 0;
		}

		if ($_GET['sort'] == 'runtime')
		{
			$sql = "SELECT race_results.raceID, race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT, race_results.runtime
			FROM race_results, teilnehmer
			WHERE race_results.userID = teilnehmer.userID
			AND race_results.raceID = {$raceID}
			ORDER BY race_results.runtime ASC LIMIT {$von} , {$bis}";
			$pos = 1;
		}
	}
	
	$result = $db->query($sql);
	if (!$result)
	{
		die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
	}

	// Anzeige der Ergebnistabellen
	show_table_results($result, $_GET['von'],$pos);
}	
	
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>
