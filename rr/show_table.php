<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 31.07.2013
 */
 
// Funktion zur Darstellung der Ergebnisstabellen 
// Parameter: Ergebnistabelle der DB-Abfrage
// 			offset: der offset zum ersten auszugebenen Datensatz: bestimmt somit 
//					den offset zur Platzierungsberechnung
// 			pos: Anzeige der Platzierung on (1) oder off (0)
function show_table_results ($result, $offset, $pos)
{
	// Eigentlicher Beginn der Darstellung der Ergebnistabelle als Webseite
	// hier macht die VErwendung von Tabellen Sinn !!!
	// Zusammensetzen der HTML-Seite:
	echo '<table border="1" rules="all">';
		// den Tabellenkopf einmal erstellen
		  echo "<tr>";
			if (defined('DEBUG')) {
				echo "<th>Renn ID</th>";
			  }
			if ($pos)
			{
				echo "<th>Platz</th>";
			}
			echo "<th>StartNr</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>";
			  if (defined('DEBUG')) {
				echo "<th>Laufzeit [ms]</th>";
			  }
			echo "<th>Laufzeit</th>
			</tr>  ";
	$lfdNr = 0;
	$Platz = 0;
	$Platz += $offset - 1;
	while ($zeile = $result->fetch_array())
	{
		$Platz++;
		// Laufzeit in ms berechnen
		//$LaufZeit = $zeile['LaufZeit'] * 100;
		// 25.6.13 TC: change runtime datatype in DB from float to BIGINT
		// value in db table as ms 
		$LaufZeit = $zeile['LaufZeit'];
		echo '<tr align="center" valign="middle">';
		if (defined('DEBUG')) {
			echo "<td style='width:3%'>". $zeile['idRennen'] . "</td>";	
		}
		if ($pos)
		{
			echo "<td style='width:3%'>". $Platz . "</td>";
		}
		echo "<td style='width:3%'>". $zeile['StartNr'] . "</td>";
		echo "<td style='width:8%'>". $zeile['Name'] . "</td>";
		echo "<td style='width:8%'>". $zeile['Vorname'] . "</td>";
		echo "<td style='width:3%'>". $zeile['KAT'] . "</td>";
		if (defined('DEBUG')) {
					echo "<td style='width:5%'>". $LaufZeit . "</td>";
		};
		// Liefert die nächste ganze Zahl, die kleiner oder gleich dem Parameter ist
		/*
		echo "<td style='width:3%'>" . floor($LaufZeit /1000/60) . "</td>";
		echo "<td style='width:3%'>". floor(($LaufZeit %60000)/1000)  . "</td>";
		echo "<td style='width:4%'>". $LaufZeit % 1000 . "</td>";
		*/
		$format = '%d:%02d:%03d';
		echo "<td style='width:3%'>" . sprintf($format, floor($LaufZeit /1000/60), floor(($LaufZeit %60000)/1000),$LaufZeit % 1000) . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} // end of function show_table_results ($result)


// Funktion zur Darstellung der Ergebnisstabellen 
// Parameter: Ergebnistabelle der DB-Abfrage
// 			offset: der offset zum ersten auszugebenen Datensatz: bestimmt somit 
//					den offset zur Platzierungsberechnung
function show_table_best_results ($result, $offset)
{
	// Eigentlicher Beginn der Darstellung der Ergebnistabelle als Webseite
	// hier macht die VErwendung von Tabellen Sinn !!!
	// Zusammensetzen der HTML-Seite:
	echo '<table border="1" rules="all">';
		// den Tabellenkopf einmal erstellen
		  echo "<tr>";
			  if (defined('DEBUG')) {
				echo "<th>Renn ID</th>";
			  }
			echo "<th>Platz</th>
			  <th>StartNr</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>";
			  if (defined('DEBUG')) {
				echo "<th>Laufzeit [ms]</th>";
			  }
			echo "<th>Laufzeit</th>
			</tr>  ";
	$lfdNr = 0;

	$Platz = 0;
	$Platz += $offset - 1;
	while ($zeile = $result->fetch_array())
	{
		$Platz++;
		// Laufzeit in ms berechnen
		//$LaufZeit = $zeile['LaufZeit'] * 100;
		// 25.6.13 TC: change runtime datatype in DB from float to BIGINT
		// value in db table as ms 
		$LaufZeit = $zeile['LaufZeit'];
		echo '<tr align="center" valign="middle">';
		if (defined('DEBUG')) {
			echo "<td style='width:3%'>". $zeile['idRennen'] . "</td>";	
		}
		echo "<td style='width:3%'>". $Platz . "</td>";
		echo "<td style='width:3%'>". $zeile['StartNr'] . "</td>";
		echo "<td style='width:8%'>". $zeile['Name'] . "</td>";
		echo "<td style='width:8%'>". $zeile['Vorname'] . "</td>";
		echo "<td style='width:3%'>". $zeile['KAT'] . "</td>";
		if (defined('DEBUG')) {
					echo "<td style='width:5%'>". $LaufZeit . "</td>";
		};
		// Liefert die nächste ganze Zahl, die kleiner oder gleich dem Parameter ist
		/*
		echo "<td style='width:3%'>" . floor($LaufZeit /1000/60) . "</td>";
		echo "<td style='width:3%'>". floor(($LaufZeit %60000)/1000)  . "</td>";
		echo "<td style='width:4%'>". $LaufZeit % 1000 . "</td>";
		*/
		$format = '%d:%02d:%03d';
		echo "<td style='width:3%'>" . sprintf($format, floor($LaufZeit /1000/60), floor(($LaufZeit %60000)/1000),$LaufZeit % 1000) . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} // end of function show_table ($result)


// Funktion zur Darstellung der Ergebnisstabellen 
// Parameter: Ergebnistabelle der DB-Abfrage
function show_table_last_results ($result)
{
	// Eigentlicher Beginn der Darstellung der Ergebnistabelle als Webseite
	// hier macht die VErwendung von Tabellen Sinn !!!
	// Zusammensetzen der HTML-Seite:
	echo '<table border="1" rules="all">';
		echo '<table border="1" rules="all">';
		// den Tabellenkopf einmal erstellen
		  echo "<tr>";
			  if (defined('DEBUG')) {
				echo "<th>Renn ID</th>";
			  }
			  echo "<th>StartNr</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>";
			  if (defined('DEBUG')) {
				echo "<th>Laufzeit [ms]</th>";
			  }
			echo "<th>Laufzeit</th>
			</tr>  ";
	$lfdNr = 0;
	$Platz = 0;
	// die Ergebnistabelle enthält 10 Ergebinsse als Ergebnis der obigen SQL-Abfrage
	while ($zeile = $result->fetch_array())
	{
		$Platz++;
		// Laufzeit in ms berechnen
		//$LaufZeit = $zeile['LaufZeit'] * 100;
		// 25.6.13 TC: change runtime datatype in DB from float to BIGINT
		// value in db table as ms 
		$LaufZeit = $zeile['LaufZeit'];
		echo '<tr align="center" valign="middle">';
		if (defined('DEBUG')) {
			echo "<td style='width:3%'>". $zeile['idRennen'] . "</td>";	
		}
		echo "<td style='width:3%'>". $zeile['StartNr'] . "</td>";
		echo "<td style='width:8%'>". $zeile['Name'] . "</td>";
		echo "<td style='width:8%'>". $zeile['Vorname'] . "</td>";
		echo "<td style='width:3%'>". $zeile['KAT'] . "</td>";
		if (defined('DEBUG')) {
					echo "<td style='width:5%'>". $LaufZeit . "</td>";
		};
		// Liefert die nächste ganze Zahl, die kleiner oder gleich dem Parameter ist
		/*
		echo "<td style='width:3%'>" . floor($LaufZeit /1000/60) . "</td>";
		echo "<td style='width:3%'>". floor(($LaufZeit %60000)/1000)  . "</td>";
		echo "<td style='width:4%'>". $LaufZeit % 1000 . "</td>";
		*/
		$format = '%d:%02d:%03d';
		echo "<td style='width:3%'>" . sprintf($format, floor($LaufZeit /1000/60), floor(($LaufZeit %60000)/1000),$LaufZeit % 1000) . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} // end of function show_table ($result)
 

// Funktion zur Darstellung der aktuellen Fahrer auf der Strecke 
// Parameter: Ergebnistabelle der DB-Abfrage
function show_table_on_track ($result)
{
	// Eigentlicher Beginn der Darstellung der Ergebnistabelle als Webseite
	// hier macht die VErwendung von Tabellen Sinn !!!
	// Zusammensetzen der HTML-Seite:

	echo '<table border="1" rules="all">';
		// den Tabellenkopf einmal erstellen
		  echo "<tr>
			  <th>Renn-ID</th>
			  <th>StartNr</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>
			</tr>  ";
	$lfdNr = 0;

	// die Ergebnistabelle enthält 10 Ergebinsse als Ergebnis der obigen SQL-Abfrage
	while ($zeile = $result->fetch_array())
	{
		echo '<tr align="center" valign="middle">';
		echo "<td style='width:3%; height:20px'>". $zeile['idRennen'] . "</td>";
		echo "<td style='width:3%; height:20px'>". $zeile['StartNr'] . "</td>";
		echo "<td style='width:8%; height:20px'>". $zeile['Name'] . "</td>";
		echo "<td style='width:8%; height:20px'>". $zeile['Vorname'] . "</td>";
		echo "<td style='width:3%; height:20px'>". $zeile['KAT'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} // end of function show_table_on_track ($result)


// Funktion zur Darstellung der Ergebnisstabellen 
// Parameter: Ergebnistabelle der DB-Abfrage
function show_table_participants ($result)
{
	// Eigentlicher Beginn der Darstellung der Ergebnistabelle als Webseite
	// hier macht die VErwendung von Tabellen Sinn !!!
	// Zusammensetzen der HTML-Seite:
	echo '<table border="1" rules="all">';
		// den Tabellenkopf einmal erstellen
		  echo "<tr>
			  <th>StartNr</th>
			  <th>Name</th>
			  <th>Vorname</th>
			  <th>KAT</th>
			  <th>Team</th>
			</tr>  ";
	$lfdNr = 0;
	$Platz = 0;
	//$LaufZeit = 0;
	// die Ergebnistabelle enthält 10 Ergebinsse als Ergebnis der obigen SQL-Abfrage
	while ($zeile = $result->fetch_array())
	{
		$Platz++;
		// Laufzeit in ms berechnen
		//$LaufZeit = $zeile['LaufZeit'] * 100;
		// 25.6.13 TC: change runtime datatype in DB from float to BIGINT
		// value in db table as ms 
		//$LaufZeit = $zeile['LaufZeit'];
		echo '<tr align="center" valign="middle">';
		echo "<td style='width:3%'>". $zeile['StartNr'] . "</td>";
		echo "<td style='width:5%'>". $zeile['Name'] . "</td>";
		echo "<td style='width:5%'>". $zeile['Vorname'] . "</td>";
		echo "<td style='width:3%'>". $zeile['KAT'] . "</td>";
		echo "<td style='width:3%'>". $zeile['Team'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} // end of function show_table ($result)


?>
