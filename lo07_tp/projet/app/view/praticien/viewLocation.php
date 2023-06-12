<!-- début viewLocation -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <p/><hr/>
        <div class='card col-12'>
            <div class='card-body bg-success bg-opacity-25 rounded'>
                <h5 class='card-title'>Trouvez un praticien près de chez vous</h5>
                <div id='map'></div>
            </div>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
    <script type="text/javascript">
        const accessToken = 'pk.eyJ1IjoicmllbmRlbm91dmVhdSIsImEiOiJjbGlvZWpsd3gxN2owM2Rwa2tpc2FzcDRyIn0.J-taVmQpL0OR-tUKsYWuwA';

        //Récupération des données de la base
        var InfoPraticiens = <?php echo json_encode($results[1]); ?>;

        //Création de la carte Leaflet
        var map = L.map('map').setView([48.833, 2.333], 6);

        // Ajout de la couche de tuiles
        var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        });

        map.addLayer(osmLayer);

        //Ajout de la latitude et de la longitude au dataset
        for (let i = 0; i < InfoPraticiens.length; i++) {
            var cityName = InfoPraticiens[i][3];
            var geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(cityName)}.json?access_token=${accessToken}`;

            fetch(geocodingUrl)
                    .then(response => response.json())
                    .then(data => {
                        var latitude = data.features[0].center[1];
                        var longitude = data.features[0].center[0];
                        InfoPraticiens[i].push(latitude);
                        InfoPraticiens[i].push(longitude);

                        let ShowText = InfoPraticiens[i][1] + " " + InfoPraticiens[i][2] + "<br>" + InfoPraticiens[i][3] + "<br> <b>" + InfoPraticiens[i][4] + "</b>";
                        L.marker([latitude, longitude]).addTo(map)
                                .bindPopup(ShowText);
                    })
                    .catch(error => {
                        console.log('Une erreur s\'est produite :', error);
                    });
        }
    </script>
</body>
<!-- ----- fin viewLocation -->

