
<!-- début viewInfo -->
<?php
require $root . '/app/view/fragment/fragmentHeader.html';

echo "<body>";
echo "<div class='container'>";

include $root . '/app/view/fragment/fragmentMenu.php';
include $root . '/app/view/fragment/fragmentJumbotron.html';

$liste_var = array($results_specialite, $results_administrateur, $results_praticien, $results_patient, $results_rdv);
$liste_titre = array("Information sur les différentes spécialitées :", "Information sur les différents administrateurs :", "Information sur les différents praticiens :", "Information sur les differents patients :", "Information sur les rendez-vous :");
$index = 0;
foreach ($liste_var as $var) {
    echo "<p/><hr/>";
    echo "<div class='card col-12'>";
    echo "<div class='card-body bg-success bg-opacity-25 rounded'>";
    echo "<h5 class='card-title'>" . $liste_titre[$index] . "</h5>";
    $index++;
    echo "<table class = 'table table-striped table-bordered'>";
    echo "<thead><tr>";

    foreach ($var[0] as $titre) {
        echo "<th scope='col' class='table-dark'>$titre</th>";
    }

    echo "</tr></thead><tbody>";

    foreach ($var[1] as $ligne) {
        echo "<tr>";
        foreach ($ligne as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table><br>";
    echo "</div></div>";
}


echo '</div>';
include $root . '/app/view/fragment/fragmentFooter.html';
?>

<!-- ----- fin viewInfo -->