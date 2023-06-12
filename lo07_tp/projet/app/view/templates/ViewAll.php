<!-- début Templates ViewAll -->
<?php
require (dirname(dirname(__DIR__)) . '/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include dirname(dirname(__DIR__)) . '/view/fragment/fragmentMenu.php';
        include dirname(dirname(__DIR__)) . '/view/fragment/fragmentJumbotron.html';
        ?>
        <p/><hr/>
        <div class='card col-12'>
            <div class='card-body bg-success bg-opacity-25 rounded'>
                <h5 class='card-title'><?php echo $titre; ?></h5><br>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <?php
                            foreach ($results[0] as $i) {
                                echo "<th scope='col' class='table-dark'>$i</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results[1] as $ligne) {
                            echo "<tr>";
                            foreach ($ligne as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include dirname(dirname(__DIR__)) . '/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin Templates ViewAll -->