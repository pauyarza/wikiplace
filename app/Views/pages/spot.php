<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | Spot: <?=$spot['spot_name']?></title>
    <!--Spot CSS--><link rel="stylesheet" type="text/css" href="<?= base_url('css/spot.css'); ?>" />
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
<div class="container spotContainer">
    <?php if(isset($spot['images_src'])){ //print carousel if images exist?>
    <!-- carousel -->
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
    
    <div class="info-spot">
        <h1><?=$spot['spot_name']?></h1>
        <!-- post author -->
        <?php 
            if($spot['author_username']){
                echo '
                    <a 
                        href="'.base_url('UserController/displayProfile/'.$spot['author_username']).'" 
                        target="_blank"
                        class="author-spot"
                    >
                        by @'.$spot['author_username'].
                    '</a>';
            }
            else{
                echo '<p class="author-spot">by @ {deleted account}</p>';
            }
        ?>
        <p class="description-spot"><?=$spot['description']?></p>
        <hr class="hr-spot">

        <div class="comments-spot">
            <h2>Comments</h2>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
            <div class="d-flex justify-content-start">
                <!--Aqui aniria el nom d'user que ha fet el comment-->
                <img class="button-comment-spot " src="<?=base_url('img/noLikeWhite.png');?>">
                <img class="button-comment-spot comment-flag" src="<?=base_url('img/flag.png');?>">

            </div>
        </div>

        <?=form_open('CommentController/addComment','class="add-comment-spot" id="commentForm"');?>
            <textarea 
                type="text" 
                placeholder="Add a new comment..."
                id="newcommentSpot"
                class="input-new-comment-spot"
                name="comment"
            ></textarea>
            <input type="hidden" name="id_post" value="<?=$spot['id_spot']?>">
            <button class="add-comment-btn" type="submit" id="sendCommentBtn">
                Comment
            </button>
        </form>
        <script>
            //make text area auto resize
            $("textarea").each(function () {
                this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
            }).on("input", function () {
                this.style.height = "auto";
                this.style.height = (this.scrollHeight) + "px";
            });
        </script>
    </div>
</div>
<!--JS Spot--><script src="<?php echo base_url('js/spot.js');?>"></script>
<?= $this->endSection('content') ?>