<?php

class ControllerSite {

    // --- page d'acceuil
    public static function Accueil() {
        include 'config.php';
        $vue = $root . '/app/view/site/viewAccueil.php';
        require ($vue);
    }
}
