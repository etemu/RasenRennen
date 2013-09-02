<?php
/* Verfasser: Thomas Clemens 
 * Letzte Änderung: 29.3.2013
 */

define('DEBUG', false); 

$race_results = "http://www.rasenrennen.de/upload/results_mirror.csv";

// --------------------------------------------------------------
// der datenbankzugriff
// ab jetzt habe wir ein Objekt vom Typ eine my SQL Datenbank mit dem wir arbeiten k�nnen 
// mysql ( MYSQL_HOST, BENUTZER, KENNWORT, DB_NAME );
if (DEBUG) echo "Verbindungsaufbau zur DB <br \>";
$db = new mysqli('www.rasenrennen.de', 'd016d337', 'frOErider2013', 'd016d337');

if (mysqli_connect_errno()) {
    die ('<br \>  Konnte keine Verbindung zur Datenbank aufbauen: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}
else 
	if (DEBUG) echo "<br \> Verbindung zur Datenbank erfolgreich hergestellt <br \>";

// das geht so nicht, da via http kein Schreibzugriff möglich ist !!!
/*if (DEBUG) echo "db_index.txt öfnnen <br \>";
$handle = fopen ("http://www.rasenrennen.de/upload/db_index.txt", "r");

$db_index_old = fgets($handle);
if (DEBUG) echo "Der db_index_old ist:  $db_index_old <br \>";

fclose ($handle);
*/

// alten renn_index laden (db_index_old in tabelle temp_values)
if (DEBUG) echo " alten Rennindex laden ... <br \>";
$sql = "SELECT  `db_index_old` FROM  `d016d337`.`temp_values`";
$result = $db->query($sql);
if (!$result) {
	die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
}

$zeile = $result->fetch_array();

if (DEBUG) echo " alter Rennindex ist:" . $zeile['db_index_old'] .  "<br \>";

$db_index_old = $zeile['db_index_old'];

// die runtimeen in dei Datenbank eintragen 
if (DEBUG) echo "<br \> Inhalt des csv-Files in Datenbank eintragen <br \>";
// file open and read
// initialisiert den File-Pointer 
$handle = fopen ($race_results, "r");
$db_index = 0;
while (($data = fgetcsv($handle, 100, ";")) !== FALSE) 
{
	$db_index++;
	if (DEBUG) echo "Der db_index ist:  $db_index <br \>";
	// die alten Werte überspringen 
        if ($db_index > $db_index_old)
	{
		$RennID = $data[0];
		$userID = $data[1];
		$runtime = $data[2];
        if (DEBUG) echo " DB-Befehl ausführen... <br \>";
		$sql = "INSERT INTO race_results(raceID, userID, runtime)
		VALUES
		('$RennID', 
		 '$userID',
		 '$runtime'
		 )";

		 $result = $db->query($sql);
		
		if (!$result) {
			die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
		}
	}
	
} // end of while(data)

// file close 
fclose ($handle);


// file open and write
// das geht so nicht, da via http kein Schreibzugriff möglich ist !!!
/*
$handle = fopen ("http://www.rasenrennen.de/upload/db_index.txt", "w");
fwrite($handle, $db_index);
// file close 
fclose ($handle);
*/


$sql = "UPDATE  `d016d337`.`temp_values` SET  `db_index_old` =  $db_index ";
$result = $db->query($sql);
if (!$result) {
	die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
}

if (DEBUG) 
{
    // die Tabelleninahlt ausgeben 
    $sql = "SELECT * FROM race_results";

    $result = $db->query($sql);
    if (!$result) 
    {
        die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
    }

    echo '<table border="1">';
    while ($zeile = $result->fetch_array())
    {
      echo "<tr>";
      echo "<td>". $zeile['Lauf_ID'] . "</td>";
      echo "<td>". $zeile['raceID'] . "</td>";
      echo "<td>". $zeile['userID'] . "</td>";
      // Zeitausgabe in Millisekunden
      echo "<td>". $zeile['runtime'] * 100 . "ms</td>";
      echo "</tr>";
    }
    echo "</table>";    
}

	
?>