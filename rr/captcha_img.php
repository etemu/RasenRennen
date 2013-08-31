<?php
	// Alle Fehler und Notices anzeigen
	error_reporting(E_ALL);

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

	// Session initialisieren
	session_start();
	
	include("config_ktkt_form.php");
	
	$Schriftart = "captcha_files/truetype_$Schrift.ttf";

	// Benötige Strings überprüfen
	if (isset($_SESSION["CAPTCHA_RndText"])) {
	$CAPTCHA_RandomText = $_SESSION["CAPTCHA_RndText"];
	} else {
		// Fehlermeldung ausgeben
		header ("Content-type: image/png");
		$im = @imagecreatetruecolor(300, 30)
			or die("Cannot Initialize new GD image stream");
		$text_color = imagecolorallocate($im, 233, 14, 91);
		imagestring($im, 10, 5, 7, "Kein Zufallscode übergeben!", $text_color);
		imagepng($im);
		imagedestroy($im);
	exit();
	}

// Auf Funktion überprüfen
if ($imagettftext == "1") {
	
	// Benötige Files überprüfen
	if (!file_exists($Schriftart)) {
		// Fehlermeldung ausgeben
//		header ("Content-type: image/png");
		$im = @imagecreatetruecolor(300, 30)
			or die("Cannot Initialize new GD image stream");
		$text_color = imagecolorallocate($im, 233, 14, 91);
		imagestring($im, 10, 5, 7, "Schriftart nicht gefunden!", $text_color);
		imagepng($im);
		imagedestroy($im);
	exit();
	}
	
	if (!file_exists($bg1) OR !file_exists($bg2)) {
		// Fehlermeldung ausgeben
		header ("Content-type: image/png");
		$im = @imagecreatetruecolor(300, 30)
			or die("Cannot Initialize new GD image stream");
		$text_color = imagecolorallocate($im, 233, 14, 91);
		imagestring($im, 10, 5, 7, "Hintergrundbild nicht gefunden!", $text_color);
		imagepng($im);
		imagedestroy($im);
	exit();
	}
	
	if (!file_exists($ov1) OR !file_exists($ov2)) {
		// Fehlermeldung ausgeben
		header ("Content-type: image/png");
		$im = @imagecreatetruecolor(300, 30)
			or die("Cannot Initialize new GD image stream");
		$text_color = imagecolorallocate($im, 233, 14, 91);
		imagestring($im, 10, 5, 7, "Overlaybild nicht gefunden!", $text_color);
		imagepng($im);
		imagedestroy($im);
	exit();
	}
	

	// Zufallshintergrund
	mt_srand((double)microtime()*1000000);
	$Bild1 = mt_rand(1, 2); 
		switch ($Bild1) {
	case 1:
	$Grafik=imagecreatefrompng($bg1);
	$Grafikhilf=imagecreatefrompng($bg1);
		break 1;
	case 2:
	$Grafik=imagecreatefrompng($bg2);
	$Grafikhilf=imagecreatefrompng($bg2);
		break 1;
		}

	// Zufallsgrafik2
	mt_srand((double)microtime()*1000000);
	$Bild2 = mt_rand(1, 2); 
		switch ($Bild2) {
	case 1:
	$Grafik2=imagecreatefrompng($ov1);
		break 1;
	case 2:
	$Grafik2=imagecreatefrompng($ov2);
		break 1;
		}	

	// Textfarben ins Array speichern
	$textfarbe = array(
		imagecolorallocate($Grafik, 128, 128, 128),
		imagecolorallocate($Grafik, 0, 0, 0),
		imagecolorallocate($Grafik, 50, 171, 4),
		imagecolorallocate($Grafik, 128, 0, 128),
		imagecolorallocate($Grafik, 128, 128, 255),
		imagecolorallocate($Grafik, 255, 128, 128),
		imagecolorallocate($Grafik, 192, 122, 0),
		imagecolorallocate($Grafik, 250, 94, 250),
		imagecolorallocate($Grafik, 122, 146, 224),
		imagecolorallocate($Grafik, 122, 155, 180)
	);

	// Text auf das Bild schreiben
	imagettftext($Grafik, $Textgroesse, mt_rand(-13, 13), 10, $Texthoehe+mt_rand(-7,8), $Textfarbe1 = $textfarbe[array_rand($textfarbe)] , $Schriftart, $CAPTCHA_RandomText[0]);
	imagettftext($Grafik, $Textgroesse, mt_rand(-13, 13), 45, $Texthoehe+mt_rand(-7,8), $Textfarbe2 = $textfarbe[array_rand($textfarbe)] , $Schriftart, $CAPTCHA_RandomText[1]);
	imagettftext($Grafik, $Textgroesse, mt_rand(-13, 13), 80, $Texthoehe+mt_rand(-7,8), $Textfarbe3 = $textfarbe[array_rand($textfarbe)] , $Schriftart, $CAPTCHA_RandomText[2]);
	imagettftext($Grafik, $Textgroesse, mt_rand(-13, 13), 113, $Texthoehe+mt_rand(-7,8), $Textfarbe4 = $textfarbe[array_rand($textfarbe)] , $Schriftart, $CAPTCHA_RandomText[3]);
	imagettftext($Grafik, $Textgroesse, mt_rand(-13, 13), 150, $Texthoehe+mt_rand(-7,8), $Textfarbe5 = $textfarbe[array_rand($textfarbe)] , $Schriftart, $CAPTCHA_RandomText[4]);
	imagettftext($Grafik, $Textgroesse, mt_rand(-13, 13), 191, $Texthoehe+mt_rand(-7,8), $Textfarbe6 = $textfarbe[array_rand($textfarbe)] , $Schriftart, $CAPTCHA_RandomText[5]);
	
	if ($Welleneffekt == "2") {
		
		$stauchung = mt_rand(0,100)/400+0.10;
		$Grafikalt = $Grafik;
		$Grafik = $Grafikhilf;
		for ($i=1;$i<=65;$i++){
			imagecopy($Grafik, $Grafikalt, round((sin($i*$stauchung)*2))+3, $i, 1, $i, 230,1);
		}
		
	}
		
	// Transparente Grafik drüberlegen
	imagecopy($Grafik, $Grafik2, 0, 0, 0, 0, 230, 65); 		
			
	// Bild ausgeben
	header("Content-type: image/png");
	imagepng($Grafik); 
	imagedestroy($Grafik);


} else if ($imagettftext == "2") {
	
	// Alternativbild ausgeben
	header ("Content-type: image/png");
	$im = @imagecreatetruecolor(70, 30)
	or die("Cannot Initialize new GD image stream");
	$text_color = imagecolorallocate($im, 255, 255, 255);
	imagestring($im, 10, 5, 7, $CAPTCHA_RandomText, $text_color);
	imagepng($im);
	imagedestroy($im);
	
} else {
	
	// Fehlermeldung ausgeben
	header ("Content-type: image/png");
	$im = @imagecreatetruecolor(430, 30)
		or die("Cannot Initialize new GD image stream");
	$text_color = imagecolorallocate($im, 233, 14, 91);
	imagestring($im, 10, 5, 7, "Fehlerhafte Auswahl($imagettftext)der Funktion! (1 od. 2)", $text_color);
	imagepng($im);
	imagedestroy($im);
	exit();
}
?>
