
<!-- ----- début viewInsert -->

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
                <form class='mt-3' role="form" method='get' action='router2.php'>
                    <?php
                    switch ($err) {
                        case "alreadyexist":
                            echo "<div class='alert alert-danger' role='alert'> Cette spécialité existe déjà !</div>";
                            break;
                        default:
                            break;
                    }
                    ?>

                    <input type="hidden" name='action' value='<?php echo $target; ?>'>  

                    <div class='form-group col-3'>
                        <label class='fw-bold' for="id">Création d'une nouvelle spécialité : </label>
                        <input type="text" name='label' size='75' required> <br/>                                    
                    </div>

                    <p/>
                    <br/> 
                    <button class="btn btn-primary" type="submit">Go</button>
                </form>
                <p/>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewInsert -->



