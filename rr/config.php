<?php
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 29.07.2013
 */

// database settings
// HOST, BENUTZERNAME, KENNWORT, DB_NAME );
$db_host='localhost';
$db_user='root';
$db_pass='satar';
$db_name='satar-server';
$db_prefix="satar_";
 

$array = file('settings.txt');
// nbr_last_results
/*
echo $array[1]. "<br>";
echo $array[3]. "<br>";
echo $array[5]. "<br>";
echo $array[7]. "<br>";
*/
$nbr_last_results = $array[1];
$nbr_race_results = $array[3];
// der Autorefreshzyklus in sek
$auto_refresh_cycle = $array[5];
// hier das aktuelle Battle in dem man sich gerade befindet eintragen 
// ...
// 16tel Finale Men = ID 5
// 8tel Finale Men = ID 4
// 4tel Finale Men = ID 3
// Halbfinale Men = ID 2
// Finale Men = ID 1
// Gewinner Men = ID 0  ;-)
// 4tel Finale Women = ID 693
// Halbfinale Women = ID 692
// Finale Women = ID 691
// Gewinner Women = ID 690  ;-)
$battle_id = $array[7];

$strt_time_seeding = $array[9];

$strt_time_finale = $array[11];

// zum schreiben 
//$dateihandle = fopen("settings.txt");

// fclose($dateihandle);

$version= 'V1.6.8';

// auskommentieren um den Debugmodus auszuschalten 
//define ('DEBUG', 1);

?>