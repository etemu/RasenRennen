<?php
	// Session starten und config.php includen
	session_start();
	include ("config_ktkt_form.php");

// den Header includieren
// hier sind die DIVs für den Header angeordnet
include ("header.php");
include ("menu.php");
 	
	// CaptchaCodes abfragen
	$CAPTCHA_RandomText = "";
	if (isset($_POST['txtCode']))
	{
		$CAPTCHA_EnteredText = str_replace("<","",str_replace(">","",str_replace("'","",str_replace("[","",str_replace("]","",$_POST['txtCode'])))));
	}
	if (isset($_SESSION['CAPTCHA_RndText'])) 
	{
		$CAPTCHA_RandomText = $_SESSION['CAPTCHA_RndText'];
	}

	// Eingabefelder abfragen
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['vorname'] = $_POST['vorname'];
	$_SESSION['email'] = $_POST['email'];
	// $_SESSION['betreff'] = $_POST['betreff'];
	// $_SESSION['nachricht'] = $_POST['nachricht'];
	
	$email_i = $_SESSION['email'];
	
	// Email Funktion
	function pruefe_mail($email_i) 
	{
		if(strstr($email_i, "@")) 
		{
			$email_i = explode ("@", $email_i);
			if(strstr($email_i[1], ".")) $ok = TRUE;
		}
		return $ok;
	}
	
	// Eingaben prüfen
	$fehler = "";
	if(!pruefe_mail($email_i) && !empty($email_i)) 
	{
		$fehler .= "<li>Email fehlerhaft!</li>";
	}
	if ($_SESSION['name'] == "")
	{ 
		$fehler .= "<li>Name fehlt!</li>";
	}
		if ($_SESSION['vorname'] == "")
	{ 
		$fehler .= "<li>Vorname fehlt!</li>";
	}

	if ($_SESSION['email'] == "")
	{ 
		$fehler .= "<li>Email fehlt!</li>";
	}
	/*
	if ($_SESSION['betreff'] == "")
	{ 
		$fehler .= "<li>Betreff fehlt!</li>";
	}
	if ($_SESSION['nachricht'] == "")
	{ 
		$fehler .= "<li>Nachricht fehlt!</li>";
	}
	*/
	if ($CAPTCHA_EnteredText == $CAPTCHA_RandomText and isset($_POST['txtCode']) == true and isset($_SESSION['CAPTCHA_RndText']))
	{
		$captcha = true;
	} 
	else 
	{
		$fehler .= "<li>Captcha fehlt oder fehlerhaft!</li>";
	}
	
	// echo '<div style="border: 1px #000 solid; width: 350px; padding: 5px;">';		
	echo '<DIV ID="main">';		
	
	if ($fehler == "")
	{
		// Email zumsammensetzen
		$email = "From: " . $_SESSION['email'];
		// $nachrichtfertig = $_SESSION['name']. " schrieb: \n\n" . $_SESSION['nachricht'];
		//$versand = mail($empfaenger, $_SESSION['betreff'], $nachrichtfertig, $email);
		$versand = mail($empfaenger, "Deine Anmeldung zum R4 ", "Der Nachrichtentext", $email);
		if ($versand) 
		{
			echo '<h3>Kontaktformular</h3>
			<p>Email ist erfolgreich versendet worden!</p>';
			// Sessionvariablen löschen
			unset($_SESSION['name']);
			unset($_SESSION['vorname']);
			unset($_SESSION['email']);
			// unset($_SESSION['betreff']);
			// unset($_SESSION['nachricht']);
		}
	} 
	else 
	{
		echo '<h3>Kontaktformular</h3>';
		echo $fehler;
		echo '<p><a href="form_anmeldung.php">zur&uuml;ck</a></p>';
	}
	echo '</div>';	

	// Session unset
	unset($_SESSION['CAPTCHA_RndText']);

// den Footer includieren
// hier sind die DIVs für den Footer angeordnet
include ("footer.html");
	
?>