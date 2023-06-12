
<!-- ----- debut ControllerRdv -->
<?php
require_once '../model/ModelRdv.php';
require_once '../view/objet/ViewAll.php';

class ControllerRdv {

    // --- Compter nombre patient par praticien
    public static function CountPatientByPraticien() {
        $results = ModelRdv::getCountPraticienByPatient();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici le nombre de praticien par patient']);
    }
}
?>
<!-- ----- fin ControllerRdv -->


