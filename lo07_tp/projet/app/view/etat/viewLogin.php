<!-- début viewLogin -->
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
                <h5 class='card-title'>Formulaire de connexion</h5>
                <?php
                switch ($err) {
                    case "incorrect":
                        echo "<div class='alert alert-danger' role='alert'> La combinaison <b>login/password</b> est incorrect ou n'existe pas !</div>";
                        break;
                    default:
                        break;
                }
                ?>
                <form class='mt-3' role="form" method='GET' action='router2.php'>

                    <input type="hidden" name='action' value='<?php echo $target; ?>'> 

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="login">Login </label><br>
                        <input type="text" name='login' maxlength="40" required><br>
                    </div>

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="password">Password </label><br>
                        <input type="password" name='password' maxlength="40" required><br><br>
                    </div>

                    <p/>
                    <button class="btn btn-primary" type="submit">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewLogin -->

