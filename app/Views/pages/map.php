<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <!--CSS leaflet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <!--CSS MarkerCluster-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/MarkerCluster.css'); ?>">
    <!--Map CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/map.css'); ?>" />
    <title>Wikiplace | Map 🗺️</title>
    <!-- load leaflet script -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <!-- load markercluster script -->
    <script src="<?php echo base_url('js/leaflet.markercluster.js'); ?>"></script>
    <!-- load custom script -->
    <script src="<?php echo base_url('js/map.js'); ?>"></script>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>



<div id="map"></div>
<a 
    href="<?= base_url('SpotController/SpotForm') ?>" 
    class="btn btn-success" 
    id="botoNewSpot"
    style="display:none"
>
    Add spot
</a>

<script type="text/javascript">
    //=======PASS SPOTS ARRAY TO JS=======//
    var spots = <?php echo json_encode($spots); ?>;

    //=======GENERATE MAP=======//
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }),

        latlng = new L.LatLng(41.548630, 2.107440);
    var map = new L.Map('map', {
        center: latlng,
        zoom: 15,
        layers: [tiles],
        attributionControl: false,
        zoomControl: false
    });

    //=======GENEREATE MARKERS=======//
    var markers = new L.MarkerClusterGroup();
    var markersList = [];
    //default icon
    var DefaultIcon = L.Icon.extend({
        options: {
            shadowUrl: '<?=base_url('public/icons/marker-shadow.png')?>',
            iconSize:     [38, 38], // size of the icon
            shadowSize:   [60, 80], // size of the shadow
            iconAnchor:   [19, 42], // point of the icon which will correspond to marker's location
            shadowAnchor: [19, 82],  // the same for the shadow
            popupAnchor:  [0, -45] // point from which the popup should open relative to the iconAnchor
        }
    });
    function populate() {
        spots.forEach(function(spot) {
            //set wich icon
            var icon = new DefaultIcon({iconUrl: '<?=base_url('public/icons')?>/'+spot.name+'.svg'});
            
            //create marker
            var marker = new L.Marker(
                [spot.latitude, spot.longitude],
                {icon: icon}
            );

            //add popup
            var popUpContent = '';
            popUpContent += spot.spot_name;
            popUpContent += "<button onclick='goMaps("+spot.latitude+","+spot.longitude+")'>Maps</button>";
            marker.bindPopup(popUpContent);

            //push maker
            markersList.push(marker);
            markers.addLayer(marker);
        });
        return false;
    }
    //apply
    populate();
    map.addLayer(markers);


    //=======NEW SPOT MARKER=======//
    map.on('click', onMapClick);
    var newSpotCoords;
    var marker = new L.Marker();

    function onMapClick(e) {
        //display new spot button
        $("#botoNewSpot").show();

        //delete past marker
        if (marker) map.removeLayer(marker);

        //save coords to local storage
        saveLatLng(e.latlng);

        //set icon
        var iconNew = L.icon({
            iconUrl: '<?=base_url('public/icons/new.svg')?>',
            shadowUrl: '<?=base_url('public/icons/marker-shadow.png')?>',
            
            iconSize:     [44, 44], // size of the icon
            shadowSize:   [70, 90], // size of the shadow
            iconAnchor:   [22, 46], // point of the icon which will correspond to marker's location
            shadowAnchor: [22, 91],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        //set marker options
        marker = new L.Marker(e.latlng, {
            draggable: true,
            icon: iconNew
        });

        //set drag options
        marker.on('dragend', function(e) {
            saveLatLng(e.target._latlng);
        });
        //add to map
        map.addLayer(marker);
    };

    function saveLatLng(latlng) {
        localStorage.setItem('newLatitude', latlng.lat);
        localStorage.setItem('newLongitude', latlng.lng);
    }
</script>
<?= $this->endSection('content') ?>