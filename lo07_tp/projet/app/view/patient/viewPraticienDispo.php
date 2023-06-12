<!-- début viewPraticienDispo -->
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
                    <input type="hidden" name='InfoPraticien' value='<?php echo implode("|", $InfoPraticien); ?>'>

                    <div class='form-group col-3'>
                        <label for="Dispochoisi" class='fw-bold'>Selectionner un créaneau : </label> 
                        <select class="form-control" id='Dispochoisi' name='Dispochoisi' required>
                            <?php
                            foreach ($results[1] as $InfoDispo) {
                                $rdv_id = $InfoDispo[0];
                                $rdv_date = $InfoDispo[2];
                                echo "<option value=\"$rdv_date|$rdv_id\">$rdv_date</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <p/><br/>
                    <button class="btn btn-primary" type="submit">Prendre rendez-vous</button>
                </form>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewPraticienDispo -->
