<?php echo view("openHtml.php");?>
<!-- load leaflet script --><script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<!-- load markercluster script --><script src="<?php echo base_url('js/leaflet.markercluster.js'); ?>"></script>

<?php 
    echo ("---------------------");
    print_r($spots);
?>
<div id="map"></div>

<script type="text/javascript">
    // PASS SPOTS ARRAY TO JS
    var spots = <?php echo json_encode($spots); ?>;

    // GENERATE MAP
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18
        }),

    latlng = new L.LatLng(41.548630, 2.107440);
    var map = new L.Map('map', {
        center: latlng, 
        zoom: 15, 
        layers: [tiles],
        attributionControl: false
    });


    // GENEREATE MARKERS
    var markers = new L.MarkerClusterGroup();
    var markersList = [];
    function populate() {
        spots.forEach(function(spot) {
          var m = new L.Marker([spot.latitude, spot.longitude]);
          markersList.push(m);
          markers.addLayer(m);
        });
        return false;
    }

    //APPLY
    populate();
    map.addLayer(markers);

</script>
<?php echo view("closeHtml.php"); ?>