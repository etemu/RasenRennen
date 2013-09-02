<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 29.3.2013
 */

// den Header includieren
// hier sind die DIVs für den Header angeordnet
//include ("config.php");
include ("header.php");
// das linke Menu laden
include ("menu.php");

// start of main-DIV
echo "<DIV ID='main'>";

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

// file open and read
// initialisiert den File-Pointer
$handle = fopen ("teilnehmer.csv", "r");

// die Teilnehmer in dei Datenbank eintragen
echo "<br \> Inhalt des csv-Files in Datenbank eintragen <br \>";

while (($data = fgetcsv($handle, 500, ";")) !== FALSE)
{
                $userID = $data[0];
                $Name = $data[1];
                $Vorname = $data[2];
                $Geburtsdatum = $data[3];
                $Geschlecht = $data[4];
                $Team = $data[5];
                $Ort = $data[6];
				$KAT = $data[7];

                $sql = "INSERT INTO teilnehmer(userID, Name, Vorname, Geburtsdatum, Geschlecht, Team, Ort, KAT)
                VALUES
                ('$userID',
                 '$Name',
                 '$Vorname',
                 '$Geburtsdatum',
                 '$Geschlecht',
                 '$Team',
                 '$Ort',
				 '$KAT'
                 )";

                 $result = $db->query($sql);

                if (!$result) {
                        die ('Etwas stimmte mit dem Query nicht:<br /> '.$db->error);
                }
} // end of while(data)

// file close
fclose ($handle);

// end of main-DIV
echo "</DIV>";

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>