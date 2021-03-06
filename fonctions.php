<?php
/*
Par Matthieu ONFRAY (http://www.onfray.info)
Licence : CC by sa
Toutes question sur le blog ou par mail, possibilité de m'envoyer des bières via le blog
*/

//SECURITE 
//contrôle des accès : selon le fichier constantes.php
//on charge des constantes
require_once("constantes.php");

//si pas de cookie déposé, c'est qu'on est nouveau ici !
if (! isset($_COOKIE["cookie_sam_id"]) && SECURISER == true) 
{
	header("Location: login.php");
	exit();
}

//filtre des variables postées
foreach ($_REQUEST as $key => $val) 
{
	$val = trim(stripslashes(@htmlentities($val)));
	$_REQUEST[$key] = $val;
}
 
ecrire_log("a visité la page ". basename($_SERVER['PHP_SELF']));


//FONCTIONS

//jour de la semaine, une fonction d'une complexité absolue
function jour($numjour)
{
	switch ($numjour)
	{
		case 7 : return "dimanche"; break;
		case 1 : return "lundi"; break;
		case 2 : return "mardi"; break;
		case 3 : return "mercredi"; break;
		case 4 : return "jeudi"; break;
		case 5 : return "vendredi"; break;
		case 6 : return "samedi"; break;
	}
}

//log les événements
function ecrire_log($texte)
{
	if (LOG === false) return false;
	//écriture de la conf personnelle
	$pointeur_log = fopen(HISTO, "a");
	fwrite($pointeur_log, "Le " . date("d/m/Y à H:i") . ", " . $_COOKIE["cookie_sam_id"] . " " . $texte . "\n");
	fclose($pointeur_log);
}

//sélectionner un élement dans une liste déroulante
function marquer_champs($val, $choix_utilisateur)
{
	$msg = " value=\"" . $val . "\"";
	if ($choix_utilisateur == $val) $msg .= " selected";
	return $msg;
}

//crée une liste déroulante avec valeur numérique de min à max + choix automatique
function creer_liste($nom, $min, $max, $val_utilisateur)
{
	echo "$nom :<br>";
	echo "<select name='$nom'>\n";
	
	//horaires solaires
	switch ($nom)
	{
		//gestion inversée des volets/lampes en fonction du soleil
		//le matin
		case "Ouverture" : case "Extinction" : $com_le_soleil = "Au lever du soleil"; break;
		//le soir
		case "Fermeture" : case "Allumage" : $com_le_soleil = "Au coucher du soleil"; break;
	}
	//heures fixes
	echo "<option" . marquer_champs("auto", $val_utilisateur)  . ">$com_le_soleil</option>\n";
	for ($i=$min; $i<=$max; $i++) echo "<option" . marquer_champs($i, $val_utilisateur) . ">" .$i . "h00</option>\n";
	//option minuit sauf pour ouvrir les volets
	if ($nom != "Ouverture") echo "<option" . marquer_champs("24", $val_utilisateur)  . ">Minuit</option>\n";

	//possiblité de ne pas utiliser l'élément ou le groupe d'éléments
	echo "<option" . marquer_champs("25", $val_utilisateur)  . ">Ne rien faire</option>\n";
	echo "</select><br>\n";
}

//ouvrir et fermer un objet
function activer($objet, $etat)
{
	$commande = './radioEmission ' . PIN . ' ' . SENDER . ' ' . $objet . ' ' . $etat;
	system($commande);
	ecrire_log("a passé à $etat l'objet $objet");
}

//charge le fichier utilisateur et retourne un tableau associatif
function charger_conf()
{
	//charge le fichier
	$conf_fic = @parse_ini_file(MA_CONF);
	//en cas d'absence, charge des valeurs par défaut
	if ($conf_fic === FALSE) $conf_fic = ["liste_volets" => "3 4 5 6 7", "liste_lampes" => "1 2", "volets_on" => 7, "volets_off" => 23, "lampes_on" => 18, "lampes_off" => 23, "jours" => "12345", "ville" => "Rouen" ];
	return $conf_fic;
}
?>
