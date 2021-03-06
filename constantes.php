<?php
/*
Par Matthieu ONFRAY (http://www.onfray.info)
Licence : CC by sa
Toutes question sur le blog ou par mail, possibilité de m'envoyer des bières via le blog
*/
//CONSTANTES
//sécuriser l'accès par login
define('SECURISER', true);
//Numéro WiringPi du pin raspberry branché a l'emetteur radio
define('PIN', 0);
//Code télécommande du raspberry (ne dois pas exceder les 2^26)
define('SENDER', 555);
//nom du fichier de conf
define('MA_CONF', 'mamaison.conf');
//nom de fichier des horaires
define('MES_HORAIRES', 'levers_couchers.conf');
//nos références françaises : villes => latitude, longitude
$villes = [ "Lille" => [ 50.6329700, 3.0585800 ] , "Rouen" => [ 49.4431300, 1.0993200 ] , "Paris" => [ 48.8534100, 2.348800 ] , "Strasbourg" => [ 48.5839200,  7.7455300 ], "Rennes" => [ 48.1119800, -1.6742900 ], "Nantes" => [47.2172500, -1.5533600 ], "Orléans" => [ 47.9028900, 1.9038900 ], "Dijon" => [ 47.3166700, 5.0166700 ], "Lyon" => [ 45.7484600, 4.8467100 ], "Bordeaux" => [ 44.8404400, -0.5805000 ], "Toulouse" => [ 43.6042600, 1.4436700 ], "Marseille" => [ 43.2969500, 5.3810700 ], "Ajaccio" => [ 41.9272300, 8.7346200] ];
// RETENTION DU COOKIE : 1 an
define('COOKIE_EXPIRE', 365*24*3600);
//faut-il loguer
define('LOG', true);
//fichier de log
define('HISTO', 'historique.log');
//version du logiciel
define('VERSION', '1.0');
?>
