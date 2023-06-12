
<?php

require_once '../model/ModelPersonne.php';
require_once '../view/objet/ViewAll.php';

class ControllerEtat {

    public static function Login($args) {
        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];
        $err = "ok";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/etat/viewLogin.php';
        require ($vue);
    }

    public static function VerificationLogin() {
        $login = filter_input(INPUT_GET, 'login', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);

        $results = ModelPersonne::checkConnexion($login, $password);

        if (!(empty($results))) {
            $_SESSION['id'] = $results[0]['id'];
            $_SESSION['nom'] = $results[0]['nom'];
            $_SESSION['prenom'] = $results[0]['prenom'];
            $_SESSION['login'] = $results[0]['login'];
            $_SESSION['statut'] = $results[0]['statut'];

            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/site/viewAccueil.php';
            require ($vue);
        } else {
            $err = "incorrect";
            $target = $_GET["action"];
            include 'config.php';
            $vue = $root . '/app/view/etat/viewLogin.php';
            require ($vue);
        }
    }

    public static function Inscription($args) {
        // Passage du nom de la méthode cible pour le champs action du formulaire
        $target = $args['target'];
        $err = "ok";

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/etat/viewInscription.php';
        require ($vue);
    }

    public static function ValidationInscription() {

        $loginalreadyexist = ModelPersonne::checklogin(htmlspecialchars($_GET['login']));

        if ((($_GET['statut'] == 2) || ($_GET['statut'] == 0)) && ($_GET['specialite'] != 0)) {
            $err = "speimpossible";
            $target = $_GET['action'];
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/etat/viewInscription.php';
            require ($vue);
        } else if ($loginalreadyexist) {
            $err = "loginalreadyexist";
            $target = $_GET['action'];
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/etat/viewInscription.php';
            require ($vue);
        } else {
            $results = ModelPersonne::insert(
                            htmlspecialchars($_GET['nom']),
                            htmlspecialchars($_GET['prenom']),
                            htmlspecialchars($_GET['adresse']),
                            htmlspecialchars($_GET['login']),
                            htmlspecialchars($_GET['password']),
                            htmlspecialchars($_GET['statut']),
                            htmlspecialchars($_GET['specialite'])
            );

            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/etat/viewValidationInscription.php';
            require ($vue);
        }
    }

    public static function Deconnexion() {
        session_unset();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/site/viewAccueil.php';
        require ($vue);
    }

}
