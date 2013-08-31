<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 29.7.2013
 */

// laden der DB-Einstellungen 
// den Header includieren
// hier sind die DIVs für den Header angeordnet
include ("header.php");
//include ("config.php");
include ("menu.php"); 

// start of main-DIV
echo "<DIV ID='main'>";

$timestamp = time();
$datum = date("d.m.Y - H:i:s", $timestamp);
//echo $datum;
echo "<br /> Letzte Aktualisierung: " . $datum . "<br />";

// DB Zugriff nur bei gültiger Battel ID 
// gültige Battle ID = 1
$battle_id_valid = 1;

echo "<br><h1>Die aktuelle BattleID lautet: " . $battle_id . "</h1><br>";
switch($battle_id)
{
	case 0:
		echo  "<h1>Der Gewinner !!!! </h1>";
		break;

	case 1:
		echo  "<h1>Finale Men </h1>";
		break;

	case 2:
		echo  "<h1>Halbfinale Men </h1>";
		break;
		
	case 3:
		echo  "<h1>4tel-Finale Men </h1>";
		break;
	case 4:
		echo  "<h1>8tel-Finale Men </h1>";
		break;
	case 5:
		echo  "<h1>16tel-Finale Men </h1>";
		break;
	case 693:
		echo  "<h1>4tel-Finale Women</h1>";
		break;		
	case 692:
		echo  "<h1>Halbinale Women</h1>";
		break;		
	case 691:
		echo  "<h1>Finale Women</h1>";
		break;				
/*	
	case 6:
		echo  "<h1>32tel-Finale </h1>";
		break;
*/
	default:
			echo  "<h1 class='warning'>Keine g&uuml;ltige Battle ID !!!</h1>";
			$battle_id_valid = 0;
			echo "<br>BattleID_valid = " . $battle_id_valid . "<br>";
}

// DB Zugriff nur bei gültiger Battel ID 
// gültige Battle ID = 1
if ($battle_id_valid == 1)
{ 
	echo '<br \><b>Die Gewinnerstartnummer in die DB eintragen</b>';
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
 }

?>
<!-- Aufbau des Formulars -->
<br>
<br>
<form method="get" action="form_set_battle_strtNr.php">
	<fieldset>
		<legend><strong>Battle Dialog:</legend>
		StrtNr des Siegers: 
		<input type="text" name="StrtNr"><br>
		<input type="submit" name="senden" value="Senden">
	</fieldset>
</form>

<?php

$StrtNr = 0;
// DB Zugriff nur bei gültiger Battel ID 
// gültige Battle ID = 1
if ($battle_id_valid == 1)
{ 
	// bei Aufruf aus Menu kein Inhalt im Feld
	if (!empty($_GET['StrtNr']))
	{
		$StrtNr = $_GET['StrtNr'];
		// ACHTUNG: die über das Formular eingelesenen Startnummer in die Db Tabelle eintragen 
		// Hinweis: Man befindet sich z.B. im Viertelfinale, schreibt hier jedoch in die Tabelle für das Halbfinale !!!
		// Bsp: aktuelle BattlID = 2, es muss dann aber in die DB-Tabelle mit der BattleID = 1 geshrieben werden 
		// $battle_id -= 1;
		// nur falls StrtNr noch nicht in DB eingetragen 
		if (check_strtNr ($db, $StrtNr, $battle_id) == TRUE)
		{
			$battle_id -= 1;
			// in dei DB schreiben 
			$sql = "INSERT INTO `d016d337`.`battles` 
			(`LaufID`, `BattleID`, `StrtNr`, `Dummy1`, `Dummy2`) 
				VALUES (NULL," .$battle_id . ", " .$StrtNr . ", 0, 0)";
			$result = $db->query($sql);
			if (!$result)
			{
				die ('Etwas stimmte mit dem Query "Insert To " nicht:<br /> '.$db->error);
			}
			// Eintrag erfolgreich 
			else 
			{
				echo "<h1 class='success'> " . $StrtNr . "</h1><br>";
			}
		}
		
	}
	else 
	{
		echo " <h1 class='warning'> !!! Keine g&uuml;ltige Startnummer !!! </h1>";
		echo " <h1 class='warning'> !!! Es wurde keine Aktion durchgef&uuml;hrt !!! </h1>";
	}
 } // end of valid battle id
 else 
 {
		echo " <h1 class='warning'> !!! Es wurde keine Aktion durchgef&uuml;hrt !!! </h1>";
 }
// end of main-DIV
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>


<?php		// Funktion überprüft die gültige Eingabe einer Startnummer 
		// 1. Überprüfung: Ist die StrtNr bereit eingetragen worden 
		// 2. Überprüfung: Ist dis StrtNr aus dem Pool der Battleteilnehmer 
function check_strtNr ($db, $StrtNr, $battleID)
{
	// erst mal auf gültig setzen 
	$ret = TRUE;		
	// überprüfen, ob sie aus dem Pool der letzten Battleteilnehmer stammt

	// TODO workaround (unschön)
	// das ertse Battle ist nicht in der Battle Tabelle vorhanden 
	// sondern wird aus der Rennen Tabelle mit der ID 4 zusammengesetzt 
	if ($battleID == 5)
	{
		$sql = "SELECT rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT
			FROM rennen_1, teilnehmer
			WHERE rennen_1.StartNr = teilnehmer.StartNr
			AND rennen_1.idRennen = 4
			AND teilnehmer.KAT != 'U11'
			AND teilnehmer.KAT != 'Women'
			ORDER BY rennen_1.LaufZeit ASC LIMIT 0 , 32";
		$result = $db->query($sql);
		if (!$result)
		{
			die ('Etwas stimmte mit dem Query "Battleteilnehmer" nicht:<br /> '.$db->error);
			$ret = FALSE;
		}
		// nachschauen, ob die Satrnummer dabei ist
		$ret = FALSE;
		while ($zeile = $result->fetch_array())
		{
			if ($StrtNr == $zeile['StartNr'])
			{
				$ret = TRUE;
			}
		}
	}
	
	// NEU: 27.8.13  WOMENS BATTLE 
	// TODO workaround (unschön)
	// das ertse Battle ist nicht in der Battle Tabelle vorhanden 
	// sondern wird aus der Rennen Tabelle mit der ID 4 zusammengesetzt 
	else if ($battleID == 693)
	{
		$sql = "SELECT rennen_1.StartNr, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT
			FROM rennen_1, teilnehmer
			WHERE rennen_1.StartNr = teilnehmer.StartNr
			AND rennen_1.idRennen = 4
			AND teilnehmer.KAT != 'U11'
			AND teilnehmer.KAT != 'Men'
			ORDER BY rennen_1.LaufZeit ASC LIMIT 0 , 8";
		$result = $db->query($sql);
		if (!$result)
		{
			die ('Etwas stimmte mit dem Query "Battleteilnehmer" nicht:<br /> '.$db->error);
			$ret = FALSE;
		}
		// nachschauen, ob die Satrnummer dabei ist
		$ret = FALSE;
		while ($zeile = $result->fetch_array())
		{
			if ($StrtNr == $zeile['StartNr'])
			{
				$ret = TRUE;
			}
		}
	}	
	
	// hier die Überprüfung eines gültigen Battle-Startnummernentrags 
	// anhand der Battletabelle
	else
	{
		$sql = "SELECT battles.BattleID, battles.StrtNr
				FROM battles 
				WHERE battles.BattleID = {$battleID} AND battles.StrtNr = {$StrtNr}";
		$result = $db->query($sql);
		if (!$result)
		{
			die ('Etwas stimmte mit dem Query "Battleteilnehmer" nicht:<br /> '.$db->error);
			$ret = FALSE;
		}
		// die Abfrage lieferte kein Ergebnis, also keine gültige Startnummer
		else if ($result->num_rows == 0)
		{
			$ret = FALSE;
		}
	}
	
	// falls Starnummer noch gültig ist
	if ($ret == TRUE)
	{
		// prüfen ob die StrtNr schon für das NÄCHSTE Battle eingetragen ist (ACHTUNG: battlID - 1)
		// erst mal alle bereits eingetragenen SrtNr auslesen 
		$battleID -= 1;
		$sql = "SELECT StrtNr FROM `battles` WHERE BattleID = $battleID ORDER BY  LaufID ASC ";	
		$result = $db->query($sql);
		if (!$result)
		{
			die ('Etwas stimmte mit dem Query "Letzte StrtNr" nicht:<br /> '.$db->error);
		}
		echo "Bereits eingetragene Startnummern (letzter Eintrag unten): <br>";
		while ($zeile = $result->fetch_array())
		{
			echo " " . $zeile['StrtNr'] . "<br>";
			if ($StrtNr == $zeile['StrtNr'])
			{
				echo "<h1 class='warning'> !!! Startnummer " .$StrtNr .  " bereits in DB vorhanden !!! </h1>";
				$ret = FALSE;
			}
		}
	}
	else
	{
		echo "<h1 class='warning'> !!! Startnummer " .$StrtNr .  " ist nicht im Battle vorhanden !!! </h1>";
	}	
	return $ret;
}
?>