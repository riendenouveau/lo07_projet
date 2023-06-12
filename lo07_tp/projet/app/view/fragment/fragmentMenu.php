<!-- début fragmentMenu -->

<nav class="navbar navbar-expand-lg bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="router2.php?action=Accueil">HENNECHART-LETREUST  
            <?php
            if (isset($_SESSION['statut'])) {
                switch ($_SESSION['statut']) {
                    case ModelPersonne::ADMINISTRATEUR:
                        echo "| Administrateur |";
                        break;
                    case ModelPersonne::PRATICIEN:
                        echo "| Praticien |";
                        break;
                    case ModelPersonne::PATIENT:
                        echo "| Patient |";
                        break;
                    default:
                        break;
                }
            }
            ?>  
            <?php
            if (isset($_SESSION['nom'])) {
                echo $_SESSION['prenom'] . " " . $_SESSION['nom'];
            }
            ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                if (isset($_SESSION['statut'])) {
                    switch ($_SESSION['statut']) {

                        case ModelPersonne::ADMINISTRATEUR:
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Administrateur</a>";
                            echo "<ul class='dropdown-menu'>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=specialiteReadAll'>Liste des spécialités</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=specialiteReadId&target=specialiteReadOne'>Sélection d'une spécialité par son id</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=specialiteCreate&target=specialiteCreated'>Insertion d'une nouvelle spécialité</a></li>";
                            echo "<hr>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=praticienReadAllwithspecialite'>Liste des practiciens avec leur spécialité</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=CountPatientByPraticien'>Nombre de practicien par patient</a></li>";
                            echo "<hr>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=administrateurInfo'>Info</a></li>";
                            echo "</ul>";
                            echo "</li>";
                            break;

                        case ModelPersonne::PRATICIEN:
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Praticien</a>";
                            echo "<ul class='dropdown-menu'>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PraticienReadAllMyDispo'>Liste de mes disponibilités</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PraticienCreateDispo&target=PraticienCreatedDispo'>Ajout de nouvelles disponibilités</a></li>";
                            echo "<hr>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PraticienRealAllRdvWithPatientName'>Liste de rendez-vous avec le nom des patients</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PraticienReadMyDistinctPatient'>Liste de mes patients (sans doublon)</a></li>";
                            echo "</ul>";
                            echo "</li>";
                            break;

                        case ModelPersonne::PATIENT:
                            echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Patient</a>";
                            echo "<ul class='dropdown-menu'>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PatientReadMyAccount'>MonCompte</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PatientReadAllRdvWithPraticienName'>Liste de mes rendez-vous</a></li>";
                            echo "<li><a class='dropdown-item' href='router2.php?action=PatientShowPraticien&target=PatientShowDispo&targetsuiv=PatientConfirmationRdv'>Prendre un RDV avec un praticien</a></li>";
                            echo "</ul>";
                            echo "</li>";
                            break;

                        default:
                            break;
                    }
                }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router2.php?action=PraticienLocation">Localiser un praticien</a></li>
                        <li><a class="dropdown-item" href="router2.php?action=">Proposez une amélioration du code MVC</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router2.php?action=Login&target=VerificationLogin">Login</a></li>
                        <li><a class="dropdown-item" href="router2.php?action=Inscription&target=ValidationInscription">S'inscrire</a></li>
                        <li><a class="dropdown-item" href="router2.php?action=Deconnexion">Déconnexion</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav> 

<!-- ----- fin fragmentMenu -->


