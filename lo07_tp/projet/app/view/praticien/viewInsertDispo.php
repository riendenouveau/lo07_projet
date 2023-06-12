
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
        <div class='card col-12'>
            <div class='card-body bg-success bg-opacity-25 rounded'>
                <form class='mt-3' role="form" method='get' action='router2.php'>
                    <div class="form-group">
                        <input type="hidden" name='action' value='<?php echo $target; ?>'> 

                        <div class='form-group col-3'>
                            <label class='fw-bold' for="rdv_date">rdv_date :</label><br>
                            <input type="date" name='rdv_date' value="2023-06-02" required><br>
                        </div>

                        <div class='form-group col-3'>
                            <label class='fw-bold' for="rdv_nombre">rdv_nombre : </label><br>
                            <input type="number" name='rdv_nombre' min = 0 max = 14 required><br><br>
                        </div>  
                    </div>
                    <p/>
                    <button class="btn btn-primary" type="submit">Ajouter mes disponibilités</button>
                </form>
                <p/>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewInsert -->