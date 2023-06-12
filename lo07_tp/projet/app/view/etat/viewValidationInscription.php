<!-- début viewValidationInscription -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <p/><hr/>
        <div class='card col-12'>
            <div class='card-body bg-success bg-opacity-25 rounded'>

                <h5 class='card-title'>Votre inscription a bien été enregistrée !</h5>
                <ul>
                    <li>Id : <?php echo $results ?></li>
                    <li>Nom : <?php echo $_GET['nom'] ?></li>
                    <li>Prenom : <?php echo $_GET['prenom'] ?></li>
                    <li>Adresse : <?php echo $_GET['adresse'] ?></li>
                    <li>Login : <?php echo $_GET['login'] ?></li>
                    <li>Password : <?php echo $_GET['password'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewValidationInscription -->
