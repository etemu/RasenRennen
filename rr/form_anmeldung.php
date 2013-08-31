<?php
/***************************************************************************
 *   									                                   *
 *   copyright            : (C) 2008 Daniel Kauser                         *
 *   email                : danysahne333@mail.ru                           *
 *   website              : www.cb-talk.de/captcha.html                    *
 *                                                                         *
 *                                                                         *
 *                                                                         *
 ***************************************************************************/

/***************************************************************************
 *                                                                         *
 *   Diese Script ist gratis. Viele andere Scripte kosten viel Geld doch   *
 *   ich und zum Glück auch noch ein paar andere sind gegen sowas und      *
 *   bieten unsere Scripte gratis an. Deshalb löscht nicht den copyright   *
 *   von mir damit wir kein Stress kriegen								   *
 *                                                                         *
 ***************************************************************************/
	session_start();

	// Header
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Datum aus Vergangenheit
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // immer geändert
	header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");                          // HTTP/1.0

 
 // den Header includieren
// hier sind die DIVs für den Header angeordnet
include ("header.php");
include ("menu.php");
 
	// Alle Fehler und Notices anzeigen
	error_reporting(E_ALL);
	

	$CAPTCHA_TempString="";
	
	// Zufallsfunktion für Zahlen und Buchstaben
		function GetRandomChar() {
	
	// Zufallszahl generieren
		mt_srand((double)microtime()*1000000);
		$CAPTCHA_RandVal = mt_rand(1,2);
	
	// Buchstabensalat generieren jeh nachdem ob Randval 1 oder 2 ist
		switch ($CAPTCHA_RandVal) {
	    case 1:
	  	  // Zahlen 0-9
	        $CAPTCHA_RandVal = mt_rand(48, 57);
	        break;
	    case 2:
	  	  // Grosse Buchstaben
	        $CAPTCHA_RandVal = mt_rand(65, 90);
	        break;
		}
		
	// Zufallscode ausgeben
		return chr($CAPTCHA_RandVal);
	}
	
	// Zufallscode x-stellig ausgeben
		for ($i = 1; $i <= 6; $i++) {
	       $CAPTCHA_TempString .= GetRandomChar();
	}

	// Text in Sessionvariable speichern
	if (isset($CAPTCHA_TempString)) {
		$_SESSION["CAPTCHA_RndText"] = str_replace('I','E',str_replace('0','3',str_replace('1','S',str_replace('B','F',str_replace('O','P',str_replace('4','A',str_replace('D','K',$CAPTCHA_TempString)))))));
	} else {
		die("Zufallscode konnte nicht generiert werden!");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="language" content="de" />
	<title>Kontaktformular</title>
</head>

<body>

<!-- <div style="border: 1px #000 solid; width: 350px; padding: 5px;"> -->

<DIV ID="main">


	<form method="post" action="anmeldung_ausw.php" name="anmeldung">
	<fieldset>
		<legend><strong>Anmeldeformular</legend>
			<label>
			Name:
			<br>
			<input class="anmeldung" name="name" type="text" <?php if (isset($_SESSION['name'])) { echo 'value="' . $_SESSION['name'] . '"'; }?>/>	
			<br>
			<label> 
			Vorname: 
			<br>
			<input class="anmeldung" name="vorname" type="text" <?php if (isset($_SESSION['vorname'])) { echo 'value="' . $_SESSION['vorname'] . '"'; }?>/>
			<br>
			<label>Strasse: 
			<br>
			<input class="anmeldung" name="strasse" type="text" <?if (isset($_SESSION['strasse'])) { echo 'value="' . $_SESSION['strasse'] . '"'; }?>/>
			<br>
			<label>PLZ: 
			<br>
			<input class="anmeldung" name="plz"  type="text" <?if (isset($_SESSION['plz'])) { echo 'value="' . $_SESSION['plz'] . '"'; }?>/>
			<br>
			<label>Stadt: 
			<br>
			<input class="anmeldung" name="stadt" type="text" <?if (isset($_SESSION['stadt'])) { echo 'value="' . $_SESSION['stadt'] . '"'; }?>/>
			<br>
			<label>Team: 
			<br>
			<input class="anmeldung" name="team" type="text" <?if (isset($_SESSION['team'])) { echo 'value="' . $_SESSION['team'] . '"'; }?>/>
			<br>
			<label>Email: 
			<br>
			<input class="anmeldung" name="email" type="text" <?if (isset($_SESSION['email'])) { echo 'value="' . $_SESSION['email'] . '"'; }?>/>
			<br>
		<!-- <tr><td><p>Betreff: </p></td><td><p><input name="betreff" size="34" type="text" <?if (isset($_SESSION['betreff'])) { echo 'value="' . $_SESSION['betreff'] . '"'; }?>/></p></td></tr>  -->
		<!-- <tr><td><p>Nachricht: </p></td><td><p><textarea name="nachricht" rows="3" cols="26"><?if (isset($_SESSION['nachricht'])) { echo  $_SESSION['nachricht'] ; }?></textarea></p></td></tr>  -->
		<img border="0" src="captcha_img.php?PHPSESSID=<?echo session_id();?>&ver=<?echo time();?>" alt="" />
		<br>
		Code: 
		<br>
		<input maxlength="6" name="txtCode" size="34" type="text" />
		<input class="button" type="submit" name="eintrag" value="eintragen" />&nbsp;<input class="button" type="reset" name="reset" value="l&ouml;schen" />
	</fieldset>
	</form>
</div>
<?
// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");
?>

</body>
</html>



