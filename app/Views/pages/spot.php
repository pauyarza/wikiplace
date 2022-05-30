<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | Spot: <?=$spot['spot_name']?></title>
    <!--Spot CSS--><link rel="stylesheet" type="text/css" href="<?= base_url('css/spot.css'); ?>" />
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
<div class="container">
    <div class="spotContainer">
        <?php if(isset($spot['images_src'])){ //print carousel if images exist?>
        <!-- crousel -->
        <div id="carouselUserIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php 
                    if(count($spot['images_src']) > 1){ //print indicators if multiple images
                        for($i = 0; $i<count($spot['images_src']); $i++){
                            if($i==0){
                                echo '<button type="button" data-bs-target="#carouselUserIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
                            }
                            else{
                                echo '<button type="button" data-bs-target="#carouselUserIndicators" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'"></button>';
                            }
                        }
                    }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                    $active = ' active';
                    foreach($spot['images_src'] as $image_src){
                        echo "<div class='carousel-item ".$active."' style=\"background-image: url('".$image_src."')\"></div>";
                        $active = '';
                    }
                ?>
            </div>
            <?php if(count($spot['images_src']) > 1){ //print arrows if multiple images ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselUserIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselUserIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            <?php } ?>
        </div>
        <?php } ?>
        <!-- interact buttons -->
        <div class="d-flex justify-content-between interactButtons">
            <button class="btn mapsButton" onclick="goMaps()">
                <img class="mapsImg" src="<?=base_url('img/maps.png');?>">
            </button>
            <div>
                <img 
                    src="<?=base_url('img/flag.png');?>"
                    class="favButton"
                >
                <img 
                    src="<?=base_url('img/noFav.svg');?>"
                    class="favButton"
                >
                <img 
                    class="likeButton"
                    src="<?=base_url('img/noLikeWhite.png');?>"
                >
            </div>
        </div>
        
        <div class="container info-spot">
            <h1><?=$spot['spot_name']?></h1>
            <p class="author-spot">by @<?=session()->username?></p>
            <p class="description-spot"><?=$spot['description']?></p>
            <hr class="hr-spot">

            <div class="coments-spot">
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                <div class="d-flex justify-content-start">
                    <!--Aqui aniria el nom d'user que ha fet el coment-->
                    <img class="button-coment-spot " src="<?=base_url('img/noLikeWhite.png');?>">
                    <img class="button-coment-spot coment-flag" src="<?=base_url('img/flag.png');?>">

                </div>
            </div>

            <div class="add-coment-spot">
            <input 
                    type="text" 
                    placeholder="new coment"
                    id="newComentSpot"
                    class="input-new-coment-spot"
                >
            </div>
            <button class="add-coment-btn" type="button">
                    Add
            </button>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>