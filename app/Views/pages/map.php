<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | Map 🗺️</title>
    <!--Snippet description--><meta name="description" content="Map with all the spots shared by our users!">
    <!--CSS Leaflet--><link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <!--CSS MarkerCluster--><link rel="stylesheet" type="text/css" href="<?= base_url('css/MarkerCluster.css'); ?>">
    <!--Map CSS--><link rel="stylesheet" type="text/css" href="<?= base_url('css/map.css'); ?>" />
    <!-- load leaflet script --><script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <!-- load markercluster script --><script src="<?php echo base_url('js/leaflet.markercluster.js'); ?>"></script>
    <script>        
        //=======PASS PHP ARRAYS TO JS=======//
        var spots = <?= json_encode($spots); ?>;
        var categories = <?= json_encode($categories); ?>;
        var catFiltered = <?= json_encode($catFiltered); ?>;
        if(!catFiltered) catFiltered = [];

        $('#user_button').click(function() {
            $('#user_options').toggle();
            $(this).toggleClass('active');
            return false;
        })
        
    </script>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
    <img src="<?=base_url('img/cross.svg')?>" style="display: none;"><!--preload image to prevent lag-->
    <div id="categoriesListWrapper">
        <div id="categoriesList"></div>
    </div>
    <div id="map"></div>
    <img
        type="image"
        src="<?=base_url('img/current.svg'); ?>"
        onclick="setMapToUserLocation()"
        id="userLocationButton"
        class="userLocationButton"
        style="display: none"
    >
    </img>
    <img
        type="image"
        src="<?= base_url('img/newButton.svg'); ?>"
        onclick="redirectToSpotForm()"
        id="newSpotButton"
        class="newSpotButton"
        style="display:none"
    >
    </img>
    <script type="text/javascript">
        function redirectToSpotForm(){
            <?php
                if($sessionData["logged_in"]){
                    echo "location.replace('".base_url('SpotController/SpotForm')."');";
                }
                else{
                    echo "$('#registerModal').modal('show');";
                }
            ?>
        }
    </script>

    <script>
        var newCategoryMenuOpened = false;
        var allCategoriesSelected;
        var selectedSpotId = '<?php if(isset($selectedSpot)) echo $selectedSpot['id_selected_spot']?>';
        var selectedMarker = null;

        function updateEverything(){//update page with js according to catFiltered[] values (also called at the end of this <script>)
            if(!catFiltered.length){// if no filter
                //filter all
                categories.forEach(function(category) {
                    catFiltered.push(category.name);
                });
                allCategoriesSelected = true;
            }
            else allCategoriesSelected = false;
            setCategoryList();
            populate();
        }

        //=======PRINT CATEGORIES=======//
        function setCategoryList(){
            if(categories.length == catFiltered.length){
                allCategoriesSelected = true;
            }
            else{
                allCategoriesSelected = false;
            }

            $("#categoriesList").empty();

            if(!allCategoriesSelected){
                categories.forEach(function(category) {
                    if(catFiltered.includes(category.name)){
                        var divCat = document.createElement("div");
                        divCat.className = "catFiltered d-flex align-items-center";
        
                        var cross = document.createElement("img");
                        cross.src = "<?=base_url('img/cross.svg')?>";
                        
                        var crossDiv = document.createElement("div");
                        crossDiv.className = "crossDiv d-flex align-items-center";
                        crossDiv.onclick = function() {
                            removeCategory(category.name)
                        }
    
                        var categoryP = document.createElement("p");
                        categoryP.append(category.name);
        
                        crossDiv.append(cross);
                        divCat.append(crossDiv);
                        divCat.append(categoryP);
                        $("#categoriesList").append(divCat);                
                    }
                });
            }
            
            $('#divNewCat').remove();
            $('#newCatButton').remove();

            if(!newCategoryMenuOpened){
                closeNewCategoryMenu();
            }
            else if(allCategoriesSelected || newCategoryMenuOpened){
                openNewCategoryMenu();
            }
        }

        function closeNewCategoryMenu(){
            newCategoryMenuOpened = false;
            $('#divNewCat').remove();
            $('#newCatButton').remove();
            //new category button
            var newCatButton = document.createElement("div");
            newCatButton.id = "newCatButton";
            newCatButton.className = "catFiltered newCatButton d-flex align-items-center";
            newCatButton.onclick = function() {
                openNewCategoryMenu();
            }
            
            if(allCategoriesSelected){
                var selectCategoryMsg = document.createElement("p");
                selectCategoryMsg.append("Select category");
                newCatButton.append(selectCategoryMsg);
            }else{
                var cross = document.createElement("img");
                cross.src = "<?=base_url('img/cross.svg')?>"; //turned 45deg with css
                newCatButton.append(cross);
            }
            $("#categoriesListWrapper").append(newCatButton);
        }

        function openNewCategoryMenu(){
            newCategoryMenuOpened = true;
            $('#divNewCat').remove();
            $('#newCatButton').remove();
            var divNewCat = document.createElement("div");
            divNewCat.id = "divNewCat";
            divNewCat.className = "catFiltered listNotFiltered";
            divNewCat.append("Select category");
            categories.forEach(function(category) {
                if(!catFiltered.includes(category.name) || allCategoriesSelected){
                    var newCatElement = document.createElement("div");
                    newCatElement.className = "d-flex align-items-center listNotFilteredElement";

                    newCatElement.onclick = function() {
                        addCategory(category.name);
                    }

                    var crossDiv = document.createElement("div");
                    crossDiv.className = "notFilteredCrossDiv";

                    var cross = document.createElement("img");
                    cross.src = "<?=base_url('img/cross.svg')?>"; //turned 45deg with css

                    var categoryP = document.createElement("p");
                    categoryP.append(category.name);

                    crossDiv.append(cross);
                    newCatElement.append(crossDiv);
                    newCatElement.append(categoryP);

                    divNewCat.append(newCatElement);
                }
            });

            $('#categoriesListWrapper').append(divNewCat);
        }

        

        //=======MANAGE SELECTED CATEGORIES=======//
        function removeCategory(categoryToRemove){
            catFiltered.splice(catFiltered.indexOf(categoryToRemove), 1);
            updateEverything();
        }

        function addCategory(categoryToAdd){
            if(allCategoriesSelected){
                catFiltered = [];
            } 
            catFiltered.push(categoryToAdd);
            updateEverything();
        }


        //=======GENERATE MAP=======//

        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }),

        latlng = new L.LatLng(30.75, -37.96);
        var map = new L.Map('map', {
            setView: true,
            enableHighAccuracy: true,
            center: latlng,
            zoom: 3,
            layers: [tiles],
            attributionControl: false,
            zoomControl: false,
        });

        //spawn coords
        if(selectedSpotId){
            var selectedSpotLat = '<?php if(isset($selectedSpot)) echo $selectedSpot['latitude']?>';
            var selectedSpotLng = '<?php if(isset($selectedSpot)) echo $selectedSpot['longitude']?>';
            map.flyTo([selectedSpotLat,selectedSpotLng], 15, {
                animate: true,
                duration: 0.5
            });
        }
        else if(localStorage.getItem('lastCoords')){
            var lastCoords = JSON.parse(localStorage.getItem('lastCoords'));
            var lastZoom = localStorage.getItem('lastZoom');

            map.setView(lastCoords,lastZoom);
        }
        else{
            //move map to location by IP
            $.getJSON('https://geolocation-db.com/json/').done(function(location){
                latlng = new L.LatLng(location.latitude, location.longitude);
                map.flyTo(latlng, 8, {
                    animate: true,
                    duration: 0.5
                });
            });
        }
        
        //=======MAP LISTENERS=======//
        //close category list
        map.on('click', function(e) {
            newCategoryMenuOpened = false;  
            setCategoryList();
        });
        map.on("movestart", function () {
            newCategoryMenuOpened = false;  
            setCategoryList();
        });

        //save last coords and zoom
        map.on('move', function() {
            localStorage.setItem('lastCoords', JSON.stringify(map.getCenter()));
            localStorage.setItem('lastZoom', map.getZoom());
        });
        

        //======="YOU ARE HERE"=======//
        var userLocation = null;
        var markerUserLocation;
        var circleUserLocation;
        var iconHere = L.icon({
            iconUrl: '<?=base_url('icons/youarehere.svg')?>',
            
            iconSize:     [16, 16], // size of the icon
            iconAnchor:   [8, 8], // point of the icon which will correspond to marker's location
            tooltipAnchor:  [8, 0] // point from which the popup should open relative to the iconAnchor
        });

        var firstUserLocationOpen = true;
        function onLocationFound(e) {
            userLocation = e.latlng;
            var radius = e.accuracy / 2 * 10;
            
            var enoughPrecision = true;
            if(radius > 900){
                enoughPrecision = false;
            }            
            
            if(enoughPrecision){
                if(markerUserLocation){
                    map.removeLayer(markerUserLocation);
                }
                if(circleUserLocation){
                    map.removeLayer(circleUserLocation);
                }

                //marker
                markerUserLocation = L.marker(
                    e.latlng,
                    {icon:iconHere}
                ).addTo(map).bindTooltip("You are here").removeEventListener('click');

                //circle
                circleUserLocation = L.circle(
                e.latlng, radius,
                {
                    fillOpacity: 0.2,
                    opacity: 0.1
                }
                ).addTo(map).removeEventListener('click');

                //display button
                $("#userLocationButton").show(100);
                //circleUserLocation.setStyle({fillColor: 'red'});

                //display tooltip on first try
                if(firstUserLocationOpen){
                    firstUserLocationOpen = false;
                    markerUserLocation.openTooltip();
                    setTimeout(function(){//close tooltip after x seconds
                        markerUserLocation.closeTooltip();
                    }, 4000);
                }
            }           
        }

        function setMapToUserLocation(){
            //display tooltip
            markerUserLocation.openTooltip();
            //close tooltip after x seconds
            setTimeout(function(){
                markerUserLocation.closeTooltip();
            }, 4000);

            //zoom in only
            var zoomToSet;
            if(map.getZoom() < 14){
                zoomToSet = 14;
            }
            else{
                zoomToSet = map.getZoom();
            }

            //relocate map
            map.flyTo(userLocation, zoomToSet, {
                animate: true,
                duration: 1.5
            });
        }

        map.on('locationfound', onLocationFound);
        map.locate({watch: true});

        //=======GENEREATE MARKERS=======//
        var markers = new L.markerClusterGroup({
            showCoverageOnHover: false,        
        });

        //default icon
        var DefaultIcon = L.Icon.extend({
            options: {
                shadowUrl: '<?=base_url('icons/marker-shadow.png')?>',
                iconSize:     [38, 38], // size of the icon
                shadowSize:   [60, 80], // size of the shadow
                iconAnchor:   [19, 42], // point of the icon which will correspond to marker's location
                shadowAnchor: [19, 82],  // the same for the shadow
                popupAnchor:  [0, -45] // point from which the popup should open relative to the iconAnchor
            }
        });
        
        function populate() {
            var markersList = [];
            map.removeLayer(markers)
            markers = new L.MarkerClusterGroup();
            spots.forEach(function(spot) {
                if(catFiltered.includes(spot.name)){
                    //set wich icon
                    var icon = new DefaultIcon({iconUrl: '<?=base_url('icons')?>/'+spot.name+'.svg'});
                    
                    //create marker
                    var marker = new L.Marker(
                        [spot.latitude, spot.longitude],
                        {icon: icon}
                        ).on('click', function(){loadSpotData(marker,spot.id_spot);}
                    );
                        
                    //push maker
                    markersList.push(marker);
                    markers.addLayer(marker);

                    //open spot if selected
                    if(selectedSpotId){
                        selectedMarker = marker;
                    }
                }
            });

            if(selectedMarker){//open selected marker
                $(document).ready(function() {//wait for map to load
                    setTimeout(function(){
                        loadSpotData(selectedMarker,selectedSpotId);
                    },300);
                });
            }

            map.addLayer(markers);
        }


        //=======NEW SPOT MARKER=======//
        map.on('click', onMapClick);
        var newSpotCoords;
        var marker = new L.Marker();

        function onMapClick(e) {
            //display new spot button
            $("#newSpotButton").show();

            //delete past marker
            if (marker) map.removeLayer(marker);

            //save selected coords to local storage
            saveLatLng(e.latlng);

            //set icon
            var iconNew = L.icon({
                iconUrl: '<?=base_url('icons/new.svg')?>',
                shadowUrl: '<?=base_url('icons/marker-shadow.png')?>',
                
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

            marker.on('click', function(e) {
                Swal.fire({
                    heightAuto: false,
                    title: 'Add new spot?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes!',
                    confirmButtonColor: '#00C09A',
                    reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed){
                        redirectToSpotForm();
                    }
                })
            });

            //add to map
            map.addLayer(marker);
        };

        function saveLatLng(latlng) {
            localStorage.setItem('newLatitude', latlng.lat);
            localStorage.setItem('newLongitude', latlng.lng);
        }


        //=======LOAD POPUP DATA=======//
        function loadSpotData(marker,id_spot){
            marker.unbindPopup().bindPopup(
                "<img class='loadingGif' src='<?= base_url('img/loadingBlack.svg')?>'></img>",
                {'className' : 'spotPopup'}
            );
            marker.openPopup();
            $.ajax({
                type: "POST",
                url: "spotController/getSpotPopupAjax",
                data: { id_spot : id_spot },
                success: function (response) {
                    marker.bindPopup(response);
                }
            });
        }

        //=======LIKE=======//
        $(document).on('click', '.likeDiv', function () {
            if(!logged_in){
                $('#registerModal').modal('show');
            }
            else{
                var isLiked = $(this).hasClass('liked');
                var id_spot = $(this).parent().find('input').val();

                //unlike
                if(isLiked){
                    unlikeSpot(id_spot);
                    image = $(this).find('img');
                    image.fadeOut(100, function () {
                        image.attr('src', 'img/noLikeGrey.png');
                        image.fadeIn(100);
                    });
                }
                //like
                else{
                    likeSpot(id_spot);
                    image = $(this).find('img');
                    image.fadeOut(100, function () {
                        image.attr('src', 'img/like.png');
                        image.fadeIn(100);
                    });
                }

                $(this).toggleClass("liked");
            }
        });
        
        //=======FIRST LOAD=======//
        updateEverything();
    </script>
<?= $this->endSection('content') ?>