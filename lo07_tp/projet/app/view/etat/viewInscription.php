<!-- début viewInscription -->
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
                <h5 class='card-title'>Formulaire d'inscription</h5>
                <form class='mt-3' role="form" method='get' action='router2.php'>
                    
                    <?php
                    switch ($err) {
                        case "speimpossible":
                            echo "<div class='alert alert-danger' role='alert'> Vous devez selectionner '<b>Je ne suis pas un praticien</b>'</div>";
                            break;
                        case "loginalreadyexist":
                            echo "<div class='alert alert-danger' role='alert'> Ce login est <b>déjà utilisé ! </b></div>";
                            break;
                        default:
                            break;
                    }
                    ?>
                    
                    <input type="hidden" name='action' value='<?php echo $target; ?>'> 

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="nom">Nom </label><br>
                        <input type="text" name='nom' maxlength="40" required><br>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="prenom">Prenom </label><br>
                        <input type="text" name='prenom' maxlength="40" required><br>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="adresse">Adresse </label><br>
                        <input type="text" name='adresse' maxlength="80"required><br>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="login">Login </label><br>
                        <input type="text" name='login' maxlength="40"required><br>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="password">Password </label><br>
                        <input type="password" name='password' maxlength="40"required><br>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="statut">Votre statut </label><br>
                        <select class="form-control" id='statut' name='statut' required>
                            <option value="0">Administrateur</option>
                            <option value="1">Praticien</option>
                            <option value="2">Patient</option>
                        </select>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="specilite">Votre spécialité si vous êtes praticien</label><br>
                        <select class="form-control" id='specialite' name='specialite' required>
                            <option value="0">Je ne suis pas un praticien</option>
                            <option value="1">Médecin généraliste</option>
                            <option value="2">Infirmier</option>
                            <option value="3">Dentiste</option>
                            <option value="4">Sage-femme</option>
                            <option value="5">Ostéopathe</option>
                            <option value="6">Kinésithérapeute</option>
                        </select><br>
                    </div>

                    <p/>
                    <button class="btn btn-primary" type="submit">S'incrire</button>
                </form>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- fin viewInscription -->
