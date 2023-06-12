
<!-- ----- debut ControllerSpecialite -->
<?php
require_once '../model/ModelSpecialite.php';
require_once '../view/objet/ViewAll.php';

class ControllerSpecialite {

    // --- Liste des spécialités
    public static function specialiteReadAll() {
        $results = ModelSpecialite::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici toutes les spécialités']);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function specialiteReadId($args) {
        $results = ModelSpecialite::getAllId();

        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewId.php';
        require ($vue);
    }

    // Affiche un specialite particulier (id)
    public static function specialiteReadOne() {
        $specialite_id = $_GET['id'];
        $results = ModelSpecialite::getOne($specialite_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici la spécialité demandée']);
    }

    // Affiche le formulaire de creation d'un specialite
    public static function specialiteCreate($args) {

        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];
        $err = "ok";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewInsert.php';
        require ($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau specialite.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function specialiteCreated() {

        $spealreadyexist = ModelSpecialite::checkSpeciality(htmlspecialchars($_GET['label']));

        if (!empty($spealreadyexist)) {
            $err = "alreadyexist";
            $target = $_GET['action'];
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/specialite/viewInsert.php';
            require ($vue);
        } else {
            // ajouter une validation des informations du formulaire
            $results = ModelSpecialite::insert(htmlspecialchars($_GET['label']));

            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/specialite/viewInserted.php';
            require ($vue);
        }
    }

}
?>
<!-- ----- fin ControllerSpecialite -->


