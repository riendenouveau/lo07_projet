<!-- début viewPraticienInfo -->
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

                    <input type="hidden" name='action' value='<?php echo $target; ?>'>
                    <input type="hidden" name='target' value='<?php echo $target2?>'>

                    <div class='form-group col-3'>
                        <label for="praticienInfo" class='fw-bold'>Selectionner un praticien : </label> 
                        <select class="form-control" id='praticienInfo' name='praticienInfo' required>
                            <?php
                            foreach ($results[1] as $praticien) {
                                $NomPrenomPraticien = $praticien[1] . " " . $praticien[2];
                                $IdPraticien = $praticien[0];
                                echo "<option value=\"$NomPrenomPraticien|$IdPraticien\">$NomPrenomPraticien</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <p/><br/>
                    <button class="btn btn-primary" type="submit">Je choisis ce praticien</button>
                </form>
            </div>
        </div>
    </div>

    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewPraticienInfo -->

