
<!-- debut ControllerPatient -->

<?php
require_once '../model/ModelPersonne.php';
require_once '../view/objet/ViewAll.php';

class ControllerPatient {

    public static function PatientReadMyAccount() {
        $id_patient = $_SESSION['id'];
        $results = ModelPersonne::getOne($id_patient);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici les informations sur votre compte']);
    }

    public static function PatientReadAllRdvWithPraticienName() {
        $id_patient = $_SESSION['id'];
        $results = ModelRdv::getMyRdvWithPraticienName($id_patient);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici vos rendez-vous avec le nom des praticiens']);
    }

    public static function PatientShowPraticien($args) {
        $results = ModelPersonne::getAllInfo(ModelPersonne::PRATICIEN);

        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];
        $target2 = $args['targetsuiv'];

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/patient/viewPraticienInfo.php';
        require ($vue);
    }
    
    public static function PatientShowDispo($args) {
        $InfoPraticien = explode("|",$_GET["praticienInfo"]);
        $results = ModelRdv::getAllMyDispo($InfoPraticien[1]);
        
        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];
        
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/patient/viewPraticienDispo.php';
        require ($vue);
    }
    
    public static function PatientConfirmationRdv(){
        $id_patient = $_SESSION['id'];
        $InfoPraticien = explode("|",$_GET["InfoPraticien"]);
        $creneau = explode("|", $_GET["Dispochoisi"]);
        
        $results = ModelRdv::ReserverRdv($creneau[1],$id_patient);
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/patient/viewConfirmationRdv.php';
        require ($vue);
        
    }

}
