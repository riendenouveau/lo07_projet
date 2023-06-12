<?php
require_once 'Model.php';

class ModelPersonne {

    const ADMINISTRATEUR = 0;
    const PRATICIEN = 1;
    const PATIENT = 2;

    private $id, $nom, $prenom, $adresse, $login, $password, $statut, $specialite_id;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL, $login = NULL, $password = NULL, $statut = NULL, $specialite_id = NULL) {
    // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->login = $login;
            $this->password = $password;
            $this->statut = $statut;
            $this->specialite_id = $specialite_id;
        }
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }

    function setSpecialite_id($specialite_id) {
        $this->specialite_id = $specialite_id;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getStatut() {
        return $this->statut;
    }

    function getSpecialite_id() {
        return $this->specialite_id;
    }
        
    
    public static function getAllwithSpecilitie($statut) {
        try {
            $database = Model::getInstance();
            $query = "SELECT personne.id as id, personne.nom as nom, personne.prenom as prenom, personne.adresse as adresse, specialite.label as specialite FROM personne JOIN specialite ON specialite.id = personne.specialite_id WHERE personne.statut = :statut;";
            $statement = $database->prepare($query);
            $statement->execute([
                'statut' => $statut
            ]);

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0;
                    $i < $statement->columnCount();
                    $i++) {
                $meta = $statement->getColumnMeta($i);
                $cols[] = $meta['name'];
            }

            // -- Récupération des datas
            $datas = [];
            while ($row = $statement->fetch(PDO::FETCH_NUM)) {
                $datas[] = $row;
            }

            return array($cols, $datas);
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAllInfo($statut) {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT(personne.id) AS id, personne.nom AS nom, personne.prenom AS prenom FROM personne JOIN rendezvous ON personne.id = rendezvous.praticien_id  WHERE personne.statut = :statut AND rendezvous.patient_id = 0";
            $statement = $database->prepare($query);
            $statement->execute([
                'statut' => $statut
            ]);
            
            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0;
                    $i < $statement->columnCount();
                    $i++) {
                $meta = $statement->getColumnMeta($i);
                $cols[] = $meta['name'];
            }

            // -- Récupération des datas
            $datas = [];
            while ($row = $statement->fetch(PDO::FETCH_NUM)) {
                $datas[] = $row;
            }

            return array($cols, $datas);
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll($statut) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE statut = :statut";
            $statement = $database->prepare($query);
            $statement->execute([
                'statut' => $statut
            ]);

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0;
                    $i < $statement->columnCount();
                    $i++) {
                $meta = $statement->getColumnMeta($i);
                $cols[] = $meta['name'];
            }

            // -- Récupération des datas
            $datas = [];
            while ($row = $statement->fetch(PDO::FETCH_NUM)) {
                $datas[] = $row;
            }
            return array($cols, $datas);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0;
                    $i < $statement->columnCount();
                    $i++) {
                $meta = $statement->getColumnMeta($i);
                $cols[] = $meta['name'];
            }

            // -- Récupération des datas
            $datas = [];
            while ($row = $statement->fetch(PDO::FETCH_NUM)) {
                $datas[] = $row;
            }
            return array($cols, $datas);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom, $prenom, $adresse, $login, $password, $statut, $specialite) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from personne";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into personne value (:id, :nom, :prenom, :adresse, :login, :password, :statut, :specialite)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'adresse' => $adresse,
                'login' => $login,
                'password' => $password,
                'statut' => $statut,
                'specialite' => $specialite,
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    
    public static function checkConnexion($login, $password){
        try {
            $database = Model::getInstance();
            $query = "SELECT id, nom, prenom, login, statut FROM personne WHERE login = :login AND password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login,
                'password' => $password
            ]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            
            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function checklogin($login){
        try {
            $database = Model::getInstance();
            $query = "SELECT id FROM personne WHERE login = :login";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login
            ]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if ($results){
                return true;
            }else {
                return false;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelPersonne -->
