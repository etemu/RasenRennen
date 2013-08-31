<?php
/* Verfasser: Thomas Clemens
 * Letzte Änderung: 29.07.2013
 */
/*session_start ();   */
?>
  <!-- öffnet das Menü--> 
  <DIV ID="menu">
         <H1 class='menu_title' >Rennmenu</H1>
         <ul>
		<?php
		if (!isset ($_SESSION["login"]))
			{
				echo "<li>";
				echo '<a href="login_md5.php"><b>Login</b></a>';
				echo "</li>";
			}
			else
			{
				echo "<li>";
     			echo '<a href="logout.php"><b>Logout</b></a>';
				echo "</li>";
			}  
			?>
			<li>
				<a href="my_index.php"><b>Home</b></a>
			</li>		 
			<li style="color:#F30B2A;"> <a href="form_anmeldung.php"><b>Anmeldung</b></a> </li>		 	
			<li style="color:#2B9625;"> 
				<b>Samstag</b>
					<ul> 
						<li>		
							<!-- <a href="forms_radio_Quali.php"><b>Ergebnisse der Zeitl&auml;ufe</b></a>  -->
							<!-- <a href="training1.php"><b>Training1</b></a>  -->
							<!-- <a href="training2.php"><b>Training2</b></a> -->
							<a href="rennabfragen.php?rennID=3&amp;data_sets=10&amp;zykl=1&amp;battleID=666"><b>Seeding</b></a>
						</li>
					</ul>
			</li>		 

			<li> 
				<b>Startlisten f&uuml;r Finale</b>
					<ul> 
						<li> <a href="u11_quali_startlist.php?race_ID=3"><b>U11</b></a> </li>		
						<li> <a href="u17_quali_startlist.php?race_ID=3"><b>U17</b> </a> </li>		
						<li> <a href="women_quali_startlist.php?race_ID=3"><b>Women</b></a> </li>		
						<li> <a href="men_quali_startlist.php?race_ID=3"><b>Men</b></a> </li>		
						<!-- <li> <a href="todo.php"><b>Women Lizenz</b></a> </li>	-->
						<!-- <li> <a href="todo.php"><b>Men Lizenz</b></a> </li>	-->
					</ul> 					
			</li>		 
			<li style="color:#2B9625;"> 
					<b>Sonntag</b>
					<ul> 
						<li> <a href="rennabfragen.php?rennID=4&amp;data_sets=32&amp;zykl=1&amp;battleID=666"><b>Finale</b></a> </li>		
						<li> <a href="battle_women.php?teilnehmerzahl=8&amp;battleID=693&amp;zykl=1"><b>Battle Damen (4tel)</b></a> </li>									
						<li> <a href="battle_sub.php?teilnehmerzahl=4&amp;battleID=692&amp;zykl=1"><b>Battle Damen Halbfinale</b></a> </li>									
						<li> <a href="battle_sub.php?teilnehmerzahl=2&amp;battleID=691&amp;zykl=1"><b>Battle Damen Finale</b></a> </li>									
						<li> <a href="die_gewinnerin.php?teilnehmerzahl=1&amp;battleID=690"><b>Die Gewinnerin</b></a> </li>									
						<li> <a href="battle_1st.php?teilnehmerzahl=32&amp;battleID=5&amp;zykl=1"><b>Battle (16tel)</b></a> </li>		
						<li> <a href="battle_sub.php?teilnehmerzahl=16&amp;battleID=4&amp;zykl=1"><b>Battle (8tel)</b></a> </li>		
						<li> <a href="battle_sub.php?teilnehmerzahl=8&amp;battleID=3&amp;zykl=1"><b>Battle (4tel)</b></a> </li>		
						<li> <a href="battle_sub.php?teilnehmerzahl=4&amp;battleID=2&amp;zykl=1"><b>Battle Halbfinale</b></a> </li>			
						<li> <a href="battle_sub.php?teilnehmerzahl=2&amp;battleID=1&amp;zykl=1"><b>Battle Finale</b></a> </li>			
						<li> <a href="der_gewinner.php?teilnehmerzahl=1&amp;battleID=0"><b>Der Gewinner</b></a> </li>			
					</ul> 	
			</li>		 
			<!-- <li> <a href="http://www.froerider.de"><b>frOErider</b></a> </li> -->
		</ul>
		</br>
<?php
if (!isset ($_SESSION["login"]))
{ 
  //header ("Location: login_md5.php");  //eben die Seite wo sich die Leute einloggen sollen
} 
// Adminmenu nur nach erfolgreichem LOGIN einzeigen 
else
{
?>
		<H1 class='menu_title'>Adminbereich</H1>

		<!-- Hier folgen die Standardmenüs sowie die Adminmenüs -->

		<ul>	
			<li>
				<b>Battle Dialoge</b>
					<ul> 
						<!-- <li> <a href="Info_BattleID.php"><b>Set Battle ID</b></a>  </li> -->
						<li> <a href="form_set_battle_strtNr.php"><b>Battle Dialog</b></a> </li>
					</ul> 					
			</li>		 
			<li>
				<b>DB-Zugriffe</b>
					<ul> 
						<li> <a href="teilnehmerabfrage.php"><b>Alle Teilnehmer</b></a> </li>	
						<li> <a href="form_race_results.php?race=999"><b>Rennabfragen</b></a> </li>	
						<li> <a href="ImportTeilnehmer.php"><b>Import Teilnehmer</b></a> </li>		 
					</ul> 	
			</li>		 
			<li> 
				<a href="form_system_settings.php?nbr_last_results=999"><b>System settings</b></a>  
			</li>
			<!--
			<li>
				<a><b>Listen Drucken</b></a>
				<ul> 
						<li>		
							<a href="teilnehmerabfrage.php?print=1"><b>Alle Teilnehmer</b></a>
						</li>		
				</ul> 	
			</li>		 			
			-->
		</ul>
         <!--  ein Kommentar 
		 -->
  </DIV>
 <?php
 }  
 ?>