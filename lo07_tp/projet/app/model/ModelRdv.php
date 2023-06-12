<?php
require_once 'Model.php';

class ModelRdv {

    private $id, $patient_id, $praticien_id, $rdv_date;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $patient_id = NULL, $praticien_id = NULL, $rdv_date = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->patient_id = $patient_id;
            $this->praticien_id = $praticien_id;
            $this->rdv_date = $rdv_date;
        }
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPatient_id($patient_id) {
        $this->patient_id = $patient_id;
    }

    function setPraticien_id($praticien_id) {
        $this->praticien_id = $praticien_id;
    }

    function setRdv_date($rdv_date) {
        $this->rdv_date = $rdv_date;
    }

    function getId() {
        return $this->id;
    }

    function getPatient_id() {
        return $this->patient_id;
    }

    function getPraticien_id() {
        return $this->praticien_id;
    }

    function getRdv_date() {
        return $this->rdv_date;
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT id, patient_id AS Patient, praticien_id AS Praticien, rdv_date FROM rendezvous WHERE patient_id != 0";
            $statement = $database->query($query);
            $statement->execute();

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0; $i < $statement->columnCount(); $i++) {
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

    public static function getCountPraticienByPatient() {
        try {
            $database = Model::getInstance();
            $query = "SELECT patient_id AS patient, COUNT(DISTINCT praticien_id) AS nombre_praticien FROM rendezvous WHERE patient_id != 0 GROUP BY patient_id;";
            $statement = $database->prepare($query);
            $statement->execute();

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0; $i < $statement->columnCount(); $i++) {
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

    public static function getAllMyDispo($praticien_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT id, praticien_id AS praticien, rdv_date FROM rendezvous WHERE praticien_id = :id AND patient_id = 0";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $praticien_id
            ]);
            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0; $i < $statement->columnCount(); $i++) {
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

    public static function getMyRdvWithPatientName($praticien_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT personne.nom AS Nom, personne.prenom AS Prenom, rendezvous.rdv_date AS rdv_date FROM rendezvous JOIN personne ON rendezvous.patient_id = personne.id WHERE rendezvous.praticien_id = :id AND rendezvous.patient_id != 0";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $praticien_id
            ]);

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0; $i < $statement->columnCount(); $i++) {
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

    public static function getMyRdvWithPraticienName($patient_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT personne.nom AS Nom, personne.prenom AS Prenom, rendezvous.rdv_date AS rdv_date FROM rendezvous JOIN personne ON rendezvous.praticien_id = personne.id WHERE rendezvous.patient_id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $patient_id
            ]);

            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0; $i < $statement->columnCount(); $i++) {
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

    public static function getMyDistinctPatient($praticien_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT personne.nom AS nom, personne.prenom AS prenom, personne.adresse AS adresse FROM rendezvous JOIN personne ON rendezvous.patient_id = personne.id WHERE rendezvous.praticien_id = :id AND rendezvous.patient_id != 0 GROUP BY rendezvous.patient_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $praticien_id
            ]);
            //-- Récupération du noms des colonnes
            $cols = [];
            for ($i = 0; $i < $statement->columnCount(); $i++) {
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

    public static function ReserverRdv($rdv_id, $patient_id) {
        try {
            $database = Model::getInstance();
            $query = "UPDATE rendezvous SET patient_id = :patient_id WHERE id = :rdv_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'patient_id' => $patient_id,
                'rdv_id' => $rdv_id
            ]);
            return 1;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insertDispo($praticien_id, $rdv) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from rendezvous";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "INSERT INTO rendezvous value (:id, 0, :praticien_id, :rdv)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'praticien_id' => $praticien_id,
                'rdv' => $rdv
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
?>
<!-- ----- fin ModelPersonne -->
