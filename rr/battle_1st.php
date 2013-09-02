<?php
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 29.7.2013
 */

 /* Die Battles finden ohne die Kategorien U11 und Women statt.
	Die Paarungen setzen sich aus den Zeiten der Rennläufe zusammen.
	D.h. jeweils die schnellste Zeit gegen die Langsamste
	Die Sieger der Battles werden in eine DB-Tabelle eingetragen und hier wieder 
	anhand der Zeiten aus den Rennläufen gepaart.
 */
 
 // Die Doku zu Mysqli
 //  http://de2.php.net/mysqli
 /* MySQLi ist eine verbesserte (das i steht für improved) Erweiterung von PHP zum Zugriff auf MySQL-Datenbanken. 
 Sie ist im Gegensatz zur ursprünglichen Variante objektorientiert, lässt sich aber auch prozedural benutzen. 
 Ein wesentlicher Vorteil ist, dass mithilfe von sogenannten Prepared Statements SQL-Injection-Angriffe verhindert werden können.
 */

// laden der DB-Einstellungen 
//include ("config.php");

 // den Header includieren
include ("header.php");
// das linke Menu laden 
include ("menu.php"); 
?>

<DIV ID='main'>

<?php
	$teilnehmerzahl = $_GET['teilnehmerzahl'];
	$battleID = $_GET['battleID'];
	$timestamp = time();
	$datum = date("d.m.Y - H:i:s", $timestamp);	
	// for Debug: Variablenübergabe mit href Hyperlink
	// echo "<b>Teilnehmerzahl = " . $teilnehmerzahl . "  battleID = " . $battleID .  " </b><br />";


	// muss hier, damit man später den SQL String zusammensetzen kann
	$my_teilnehmerzahl = (string) $teilnehmerzahl;
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

	if($_GET['zykl'] == 1)
	{
		echo "Aktualisierung automatisch alle " . $auto_refresh_cycle . " sek / letzte Aktualisierung: " . $datum .  "<br>";
	}		
	
	// Hier für das 16tel Finale (erstes Battle) die runtimeen des Finallaufs verwenden 
	// Der Finallauf hat die RennID 4
	// Die besten Zeiten in aufsteigender Reihenfolge
	$sql = "SELECT race_results.userID, teilnehmer.Name, teilnehmer.Vorname, teilnehmer.KAT
	FROM race_results, teilnehmer
	WHERE race_results.userID = teilnehmer.userID
	AND race_results.raceID = 4
	AND teilnehmer.KAT != 'U11'
	AND teilnehmer.KAT != 'Women'
	ORDER BY race_results.runtime ASC LIMIT 0 , {$my_teilnehmerzahl}";
	// DB Zugriff
	$result1 = $db->query($sql);
	if (!$result1)
	{
		die ('Etwas stimmte mit dem 1. Query nicht:<br /> '.$db->error);
	}

	// Anzahl der gelesenen Datensätze
	$anzahl = $result1->num_rows;
	// mehr Fahrer als im Battle Platz heben 
	if ($anzahl > $teilnehmerzahl)
	{
		$anzahl = $teilnehmerzahl;
	}
	echo "<b>Battle <" . $teilnehmerzahl/2 . "tel Finale > </b><br />";
	echo "<br \> Anzahl der gelesenen Datensaetze: " . $anzahl . "<br \>";
	//echo "<br \> Die Hälfte der Datensätze: " . $anzahl/2 . "<br \>";
	
	// Eintrag in die erste Spalte (das sollte als Funktion implementiert werden)
	// Als Parameter wird result als Abfrageergebnis mitgeliefert
?>	
	<table border="1" rules="all">
		  <tr>
			  <!-- das geht auch !!!!
			  <th> <? echo $php_var ?> </th>
			  -->
			  <th>Battle</th>
			  <th>userID</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>
			  <th>x</th>
			  <th>userID</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>
			</tr>
<?php
	//while ($zeile = $result->fetch_array())
	// die Tabelle teilen zur Generierung der Paarungen 
	// initialisieren des Datenzeigers (auf Startwert setzen)
	//$row = $result1->fetch_array();
	$BattleNr = 0;
	for ($i = 0; $i < floor($anzahl/2) ; $i++)
	{
		$BattleNr++;
		/* seek to row no. teilnehmerzahl -1 */
		$result1->data_seek($i);
		// fetch row
		$row1 = $result1->fetch_row();
		echo '<tr align="center" valign="middle">';
		// Die besten Zeiten aus der Quali in aufsteigender Reihenfolge
		// in die Tabelle einfügen 
		// Gibt ein Array zurück das der gelesenen Zeile entspricht und bewegt den internen Datenzeiger vorwärts
		echo "<td style='width:3%; height:20px'> $BattleNr </td>";
		echo "<td style='width:5%; height:20px'>". $row1[0] . "</td>";
		echo "<td style='width:10%; height:20px'>". $row1[1] . "</td>";
		echo "<td style='width:10%; height:20px'>". $row1[2] . "</td>";
		echo "<td style='width:10%; height:20px'>". $row1[3] . "</td>";
		echo "<td style='width:1%; height:20px'> vs </td>";
		
		// Die schlechtesten aus der Quali in absteigender Reihenfolge
		// in die Tabelle einfügen 
		// $spalte2 = $result2->fetch_array();
		echo "<td style='width:5%; height:20px'>";
		// Startnummer
		/* seek to row no. teilnehmerzahl -1 */
		$result1->data_seek($anzahl-1-$i);   
		// fetch row
		$row1 = $result1->fetch_row();
		// userID
		echo $row1[0];
		echo "</td>";
		// Name
		echo "<td style='width:10%; height:20px'>";
		echo $row1[1];
		echo "</td>";
		// Vorname
		echo "<td style='width:10%; height:20px'>";
		echo $row1[2];
		echo "</td>";
		// Kategorie
		echo "<td style='width:10%; height:20px'>";
		echo $row1[3];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
			
// end of main-DIV
echo "</DIV>";			
			
include ("footer.html");

?>