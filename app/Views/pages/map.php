<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <!--CSS leaflet--><link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <!--CSS MarkerCluster--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/MarkerCluster.css'); ?>">
    <!--Map CSS--><link rel="stylesheet" type="text/css"  href="<?php echo base_url('css/map.css'); ?>"/>
    <title>Wikiplace | Map 🗺️</title>
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<!-- load leaflet script --><script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<!-- load markercluster script --><script src="<?php echo base_url('js/leaflet.markercluster.js'); ?>"></script>

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
<?= $this->endSection('content') ?>