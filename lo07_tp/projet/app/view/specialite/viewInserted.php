
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results) {
            echo "<p/><hr/>";
            echo "<div class='card col-12'>";
            echo "<div class='card-body bg-success bg-opacity-25 rounded'>";        
            echo ("<h5 class='card-title'>La nouvelle spécialité a été ajoutée </h5>");
            echo("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>specialite = " . $_GET['label'] . "</li>");
            echo("</ul>");
            echo "</div>";
            echo "</div>";
        } else {
            echo ("<h3>Problème d'insertion de la specialite</h3>");
            echo ("id = " . $_GET['label']);
        }

        echo("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>
        <!-- ----- fin viewInserted -->    


