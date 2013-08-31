<?php

/* Verfasser: Thomas Clemens
 * Letzte Änderung: 7.5.2013
 */

// den Header includieren
// hier sind die DIVs für den Header angeordnet
// include ("config.php");
include ("header.php");
// das linke Menu laden
include ("menu.php");

// der Hauptteil der Seite
//include ("Info_BattleID.html");
?>

<DIV ID="main">

<br />
<br />
<h1>!!!! WICHTIG !!!! <br> Die Battle ID muss in der config.php manuel eingestellt werden.</h1>
<br />

<?php
echo "<br><h1>Die aktuelle BattleID lautet: " . $battle_id . "</h1><br>";
switch($battle_id)
{

	case 0:
		echo  "<h1>Der Gewinner !!!! </h1>";
		break;

	case 1:
		echo  "<h1>Finale </h1>";
		break;

	case 2:
		echo  "<h1>Halbfinale </h1>";
		break;
		
	case 3:
		echo  "<h1>4tel-Finale </h1>";
		break;
	case 4:
		echo  "<h1>8tel-Finale </h1>";
		break;
	case 5:
		echo  "<h1>16tel-Finale </h1>";
		break;
/*	
	case 6:
		echo  "<h1>32tel-Finale </h1>";
		break;
*/
	default:
			echo  "<h1 class='warning'>Keine gültige Battle ID !!!</h1>";
}

?>

</DIV>

<?php
// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");

?>