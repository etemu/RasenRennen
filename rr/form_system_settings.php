<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 7.5.2013
 */

// den Header includieren
// hier sind die DIVs für den Header angeordnet
include ("header.php");
// das linke Menu laden
include ("menu.php");

?>

<DIV ID="main">

<form>
<fieldset>
	<legend><strong>Webseiten-Systemeinstellungen (aktuelle Werte)</legend>
	<label class="first" for="nbr_last_results ">
		Number of last race results:
		<?php
			// Aufruf über Eintragen Button 
			if($_GET['nbr_last_results'] != 999)
			{
				echo '<input id="nbr_last_results" name="nbr_last_results" type="text" size="5" value="' . $_GET['nbr_last_results'] . '"size="5">';
			}
			// wenn Aufruf aus Menü
			else 
			{
				echo '<input id="nbr_last_results" name="nbr_last_results" type="text" value="' .$nbr_last_results. '"size="5">';
			}
		?>
		</label>

	<label class="first" for="nbr_race_results">
		Number of race results:
		<?php
			// Aufruf über Eintragen Button 
			if($_GET['nbr_last_results'] != 999)
			{
				echo '<input id="nbr_race_results" name="nbr_race_results" type="text" value="' . $_GET['nbr_race_results'] . '"size="5">';
			}
			// wenn Aufruf aus Menü
			else 
			{
				echo '<input id="nbr_race_results" name="nbr_race_results" type="text" value="' . $nbr_race_results . '"size="5">';
			}
		?>
	</label>
	<label class="first" for="auto_refresh_cycle">
		Autorefresh cycle:
		<?php
			// Aufruf über Eintragen Button 
			if($_GET['nbr_last_results'] != 999)
			{
				echo '<input id="auto_refresh_cycle" name="auto_refresh_cycle" type="text" value="' . $_GET['auto_refresh_cycle'] . '"size="5">';
			}
			// wenn Aufruf aus Menü
			else 
			{
				echo '<input id="auto_refresh_cycle" name="auto_refresh_cycle" type="text" value="' . $auto_refresh_cycle . '"size="5">';
			}
		?>		
	</label>
	<label class="first" for="battleID">
		BattleID:
		<?php
			// Aufruf über Eintragen Button 
			if($_GET['nbr_last_results'] != 999)
			{
				echo '<input id="battleID" name="battleID" type="text" value="' . $_GET['battleID'] . '"size="5">';
			}
			// wenn Aufruf aus Menü
			else 
			{
				echo '<input id="battleID" name="battleID" type="text" value="' . $battle_id . '"size="5">';
			}
			echo '</br>';
		?>				
	</label>
	
	<label class="first" for="strt_time_seeding">
		Start Time Seeding:
		<?php
			// Aufruf über Eintragen Button 
			if($_GET['nbr_last_results'] != 999)
			{
				echo '<input id="strt_time_seeding" name="strt_time_seeding" type="text" value="' . $_GET['strt_time_seeding'] . '"size="5">';
			}
			// wenn Aufruf aus Menü
			else 
			{
				echo '<input id="strt_time_seeding" name="strt_time_seeding" type="text" value="' . $strt_time_seeding . '"size="5">';
			}
		?>				
	</label>	

	<label class="first" for="strt_time_finale">
		Start Time Finale:
		<?php
			// Aufruf über Eintragen Button 
			if($_GET['nbr_last_results'] != 999)
			{
				echo '<input id="strt_time_finale" name="strt_time_finale" type="text" value="' . $_GET['strt_time_finale'] . '"size="5">';
			}
			// wenn Aufruf aus Menü
			else 
			{
				echo '<input id="strt_time_finale" name="strt_time_finale" type="text" value="' . $strt_time_finale . '"size="5">';
			}
			echo '</br>';
		?>				
	</label>	
	
	<input type="submit" name="eintragen" value="Eintragen" formaction="form_system_settings.php" formmethod="get" >	
</fieldset>

</form>

</DIV>

<?php

// 999 wir beim Aufruf aus dem Menu mitgeliefert 
if($_GET['nbr_last_results'] != 999)
{
	// die Formularauswertung
	$array = file('settings.txt');
	$array[1] = $_GET['nbr_last_results']."\r\n";
	$array[3] = $_GET['nbr_race_results']."\r\n";
	$array[5] = $_GET['auto_refresh_cycle']."\r\n";
	$array[7] = $_GET['battleID']."\r\n";
	$array[9] = $_GET['strt_time_seeding']."\r\n";
	$array[11] = $_GET['strt_time_finale']."\r\n";

	// das Ergebnis in der Datei speichern 
	$datei = fopen("settings.txt","r+");
	// alten Inhalt setzen 
	$array[0] = fgets($datei, 30);
	// dummy read
	fgets($datei, 30);
	// alten Inhalt setzen 
	$array[2] = fgets($datei, 30);
	// dummy read
	fgets($datei, 30);
	// alten Inhalt setzen 
	$array[4] = fgets($datei, 30);
	// dummy read
	fgets($datei, 30);
	// alten Inhalt setzen 
	$array[6] = fgets($datei, 30);
	// dummy read
	fgets($datei, 30);
	// alten Inhalt setzen 
	$array[8] = fgets($datei, 30);
	// dummy read
	fgets($datei, 30);
	// alten Inhalt setzen 
	$array[10] = fgets($datei, 30);
	
	// alten Dateiinhalt löschen 
	ftruncate($datei, 0);
	// Dateizeiger zurücksetzten, da der mit dem read verschoben wurde 
	rewind($datei);
	foreach($array as $values) fputs($datei, $values); 
	// fwrite($datei, $array);
	fclose($datei);
}
// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>