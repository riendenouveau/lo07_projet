<!-- debut ControllerAdministrateur -->
<?php
require_once '../model/ModelSpecialite.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelRdv.php';

class ControllerAdministrateur {
    
    public static function administrateurInfo($param){
        $results_specialite = ModelSpecialite::getAll();
        $results_administrateur = ModelPersonne::getAll(ModelPersonne::ADMINISTRATEUR);
        $results_praticien = ModelPersonne::getAll(ModelPersonne::PRATICIEN);
        $results_patient = ModelPersonne::getAll(ModelPersonne::PATIENT);
        $results_rdv = ModelRdv::getAll();
        
        //-- Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewInfo.php';
        require ($vue);
    }
    
}
