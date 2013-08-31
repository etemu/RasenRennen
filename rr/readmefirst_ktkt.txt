
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

#########################################################
# Requirements						#
#							#
#########################################################

Php:4.x
GD Lib ab 1.8
Truetype Support

#########################################################
# Installation  					#
#							#
#########################################################

Optionen zum Anpassen des Captchas findet man in der
config.php .
Bitte die Emailadresse in der config.php eintragen!

Alle Dateien entpacken, auf den Server laden und 
kontakt.php im Browser aufrufen. Die Scripte sind gut 
kommentiert, so dass eine Anpassung ohne Probleme 
möglich sein sollte. 
Falls es dennoch Fragen zur Funktion  
geben sollte, genügt eine kurze Email. 

Bei Fragen zum Einbau, bitte bei Foren wie z.B. php.de
nachfragen.

#########################################################
# Probleme	  					#
#							#
#########################################################

[Keine Anzeige der Buchastaben]
Bei nicht Anzeigen der Buchstabenkann eine alternative 
Grafikfunktion aktiviert werden.
Dazu die captcha_img.php öffnen und den Eintrag

	$imagettftext = "1";

[Ersetzen durch]

	$imagettftext = "2";

So wird die alternative Funktion verwendet.

#########################################################
#							#
#########################################################