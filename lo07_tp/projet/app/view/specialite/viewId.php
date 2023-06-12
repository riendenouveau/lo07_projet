
<!-- ----- début viewId -->
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

                    <div class='form-group col-3'>
                        <label for="id" class='fw-bold'>id : </label> 
                        <select class="form-control" id='id' name='id' style="width: 100px">
                            <?php
                            foreach ($results as $id) {
                                echo ("<option>$id</option>");
                            }
                            ?>
                        </select>
                    </div>

                    <p/><br/>
                    <button class="btn btn-primary" type="submit">Soumettre</button>
                </form>
                <p/>
            </div>
        </div>
    </div>

    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewId -->