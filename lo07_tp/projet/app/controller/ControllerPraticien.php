
<!-- debut ControllerPraticien -->

<?php
require_once '../model/ModelPersonne.php';
require_once '../view/objet/ViewAll.php';

class ControllerPraticien {

    //--Liste des praticiens avec leur spécialisté
    public static function praticienReadAllwithspecialite() {
        $results = ModelPersonne::getAllwithSpecilitie(ModelPersonne::PRATICIEN);
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici les praticiens avec leur spécialité']);
    }

    //--Liste de mes disponibilités
    public static function PraticienReadAllMyDispo() {
        $id_praticien = $_SESSION['id'];
        $results = ModelRdv::getAllMyDispo($id_praticien);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici toutes vos disponibilités']);
    }

    public static function PraticienCreateDispo($args) {
        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];

        //---Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewInsertDispo.php';
        require($vue);
    }

    public static function PraticienCreatedDispo() {
        $id_praticien = $_SESSION['id'];
        $rdv_date = $_GET['rdv_date'];
        $rdv_nombre = $_GET['rdv_nombre'];

        $liste_horaires = array("10h00", "11h00", "12h00", "13h00", "14h00", "15h00", "16h00", "17h00", "18h00", "19h00", "20h00", "21h00", "22h00", "23h00");
        $liste_nouveau_rdv = array();
        
        $actualRdvs = ModelRdv::getAllMyDispo($id_praticien);
        
        for ($i = 0; $i < $rdv_nombre; $i++) {
            $newrdv = "$rdv_date à $liste_horaires[$i]";
            $rdvexist = false;
            foreach($actualRdvs[1] as $actualrdv){
                if ($newrdv == $actualrdv[2]){
                    $rdvexist = true;
                } else{
                    continue;
                }
            }
            if (!$rdvexist){
                $liste_nouveau_rdv[] = $newrdv;
            }
        }

        foreach ($liste_nouveau_rdv as $rdv) {
            $ajout = ModelRdv::insertDispo($id_praticien, $rdv);
        }

        $results = ModelRdv::getAllMyDispo($id_praticien);

        //---Construction de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici toutes vos nouvelles disponibilités']);
    }

    public static function PraticienRealAllRdvWithPatientName() {
        $id_praticien = $_SESSION['id'];
        $results = ModelRdv::getMyRdvWithPatientName($id_praticien);

        //---Construction de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici tous vos rendez-vous avec le nom des patients']);
    }

    public static function PraticienReadMyDistinctPatient() {
        $id_praticien = $_SESSION['id'];
        $results = ModelRdv::getMyDistinctPatient($id_praticien);

        //---Construction de la vue
        include 'config.php';
        $vue = new ViewAll();
        $vue->render(['results' => $results, 'titre' => 'Voici la liste de vos patients ']);
    }

    public static function PraticienLocation() {
        $results = ModelPersonne::getAllwithSpecilitie(ModelPersonne::PRATICIEN);

        //---Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewLocation.php';
        require($vue);
    }

}
