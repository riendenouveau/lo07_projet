<?php session_start()?>
<!-- ----- debut Router2 -->
<?php
require ('../controller/ControllerSpecialite.php');
require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerPatient.php');
require ('../controller/ControllerPraticien.php');
require ('../controller/ControllerRdv.php');
require ('../controller/ControllerEtat.php');
require ('../controller/ControllerSite.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

//Modification du routeur pour prendre en compte l'ensemble des paramètres
$action = $param['action'];

// -- On supprime l'élément action de la structure
unset($param['action']);

$args = $param;

if(method_exists(new ControllerSpecialite(), $action)){
    ControllerSpecialite::$action($args);
} 
else if(method_exists(new ControllerPraticien(), $action)){
    ControllerPraticien::$action($args);
} 
else if(method_exists(new ControllerEtat(), $action)){
    ControllerEtat::$action($args);
} 
else if(method_exists(new ControllerAdministrateur(), $action)){
    ControllerAdministrateur::$action($args);
} 
else if(method_exists(new ControllerRdv(), $action)){
    ControllerRdv::$action($args);
} 
else if(method_exists(new ControllerPatient(), $action)){
    ControllerPatient::$action($args);
} 
else {
    $action = "Accueil";
    ControllerSite::$action();
}
?>
<!-- ----- Fin Router2 -->