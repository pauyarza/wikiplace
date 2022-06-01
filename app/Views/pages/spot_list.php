<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | Spot list</title>
    <!--Spot list CSS--><link rel="stylesheet" type="text/css" href="<?= base_url('css/spot_list.css'); ?>" />
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
    <div class="container spotListContainer">
        <h1><?=$title?></h1>
        <div class="spots row">
            <?php foreach($spots as $spot){?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="spot">
                    <div class="topRow row">
                        <div class="col-2 d-flex align-items-center">
                            <img src="<?=base_url("icons/parkour.svg")?>" class="categoryImg">
                        </div>
                        <div class="col-10">
                            <div class="titleActions row">
                                <h2 class="title col-8"><?=$spot['spot_name']?></h2>
                                <div class="actions col-4">
                                    <img class="actionBtn favBtn" src="<?=base_url("img/favGrey.png")?>" alt="save">
                                    <div class="likeDiv liked">
                                        <img class="actionBtn likeBtn" src="<?=base_url("img/like.png")?>" alt="like">
                                        <p class="likeCount"><?=$spot['likes']?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="descriptionDiv">
                                <p class="description"><?= $spot['description']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="bottomRow row">
                        <div class="imgDiv col-8 d-flex aligns-items-center justify-content-center">
                            <img src="<?=base_url('img/placeholder-image.jpg')?>" alt="spot image">
                        </div>
                        <div class="buttons col-4 d-flex align-content-between flex-wrap">
                            <a href="" class="maps btn" onclick="goMaps(<?= $spot['latitude'].','.$spot['longitude']?>)">
                                <img src="<?=base_url('img/maps.png');?>" alt="maps">
                            </a>
                            <a href="<?=base_url('SpotController/displaySpot').'/'.$spot['id_spot']?>" class="more btn" target="_blank">
                                More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?= $this->endSection('content') ?>