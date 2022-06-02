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
        <button class="btn mapsButton" onclick="goMaps(<?=$spot['latitude'].','.$spot['longitude']?>)">
            <img class="mapsImg" src="<?=base_url('img/maps.png')?>">
        </button>
        <div>
            <!-- report -->
            <img 
                src="<?=base_url('img/flag.png');?>"
                class="reportButton"
                onclick="reportSpot(<?=$spot['id_spot']?>)"
            >
            <!-- fav -->
            <?php if($spot["is_saved"]){?>
                <img 
                    src="<?=base_url('img/favWhite.svg');?>"
                    class="favButton faved"
                    id="favButton"
                    onclick="triggerFav(<?=$spot['id_spot']?>)"
                >
            <?php 
            }else{
            ?>
                <img 
                    src="<?=base_url('img/nofavWhite.svg');?>"
                    class="favButton"
                    id="favButton"
                    onclick="triggerFav(<?=$spot['id_spot']?>)"
                >
            <?php } ?>
            <!-- like -->
            <?php if($spot["is_liked"]){?>
                <img 
                    id="likeImg"
                    class="likeButton liked"
                    src="<?=base_url('img/like.png');?>"
                    onclick="likeSpotDisplaySpot(<?=$spot['id_spot']?>)"
                >
            <?php 
            }else{
            ?>
                <img 
                    id="likeImg"
                    class="likeButton"
                    src="<?=base_url('img/noLikeWhite.png');?>"
                    onclick="likeSpotDisplaySpot(<?=$spot['id_spot']?>)"
                >
            <?php } ?>
            <p class="totalLikes"><?=$spot["likes_count"]?></p>
        </div>
    </div>
    
    <div class="info-spot">
        <h1><?=$spot['spot_name']?></h1>
        <!-- spot author -->
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
            <?=form_open('CommentController/addComment','class="add-comment-spot" id="commentForm"');?>
                <textarea 
                    type="text" 
                    placeholder="Add a new comment..."
                    id="newcommentSpot"
                    class="input-new-comment-spot form-control"
                    name="comment"
                ></textarea>
                <div class="invalid-feedback" id="feedbackComment"></div>
                <input type="hidden" name="id_spot" value="<?=$spot['id_spot']?>">
                <?php 
                    if($sessionData["logged_in"])
                        echo '<button class="add-comment-btn" type="submit" id="sendCommentBtn">Comment</button>';
                    else
                        echo '<button class="add-comment-btn" type="button" onclick="$(\'#registerModal\').modal(\'show\');" id="sendCommentBtn">Comment</button>';
                ?>
            </form>
            <?php 
                //print comments
                foreach($spot['comments'] as $comment){
            ?>
                <div class="comment">
                    <a 
                        class="commenter" 
                        href="<?=base_url("UserController/displayProfile/")."/".$comment['commenter']?>"
                        target="_blank"
                    ><i class="fa-solid fa-user"></i> <?=$comment['commenter']?></a>
                    <p><?=$comment['comment']?></p>
                    <div>
                        <?php if($comment["userlike"]){ ?>
                            <div class="likeDiv liked">
                                <img 
                                    class="button-comment-spot comment-like"
                                    id="likeComment<?=$comment['id_comment']?>"
                                    src="<?=base_url('img/like.png');?>"
                                    onclick="triggerLikeComment(<?=$comment['id_comment']?>)"
                                >
                                <span id="totalCommentLikes<?=$comment['id_comment']?>" class="totalCommentLikes"><?=$comment['likes']?></span>
                            </div>
                        <?php }else{ ?>
                            <div class="likeDiv">
                                <img 
                                    class="button-comment-spot comment-like"
                                    id="likeComment<?=$comment['id_comment']?>"
                                    src="<?=base_url('img/noLikeWhite.png');?>"
                                    onclick="triggerLikeComment(<?=$comment['id_comment']?>)"
                                >
                                <span id="totalCommentLikes<?=$comment['id_comment']?>" class="totalCommentLikes"><?=$comment['likes']?></span>
                            </div>
                        <?php } ?>
                        <img
                            class="button-comment-spot comment-flag" 
                            src="<?=base_url('img/flag.png');?>"
                            onclick="reportComment(<?=$comment['id_comment']?>)"
                        >
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</div>
<script>
    //make text area auto resize
    $("textarea").each(function () {
        this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    }).on("input", function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });

    //display comment if necessary
    <?php if($commentAdded){ ?>
        //toast
        Swal.mixin({
            toast: true,
            position: "bottom",
            showConfirmButton: false,
            timer: 1200,
        }).fire({
            title: "Comment added"
        })
        //delete get from url
        window.history.replaceState(null, null, window.location.pathname);
    <?php }?>
</script>

<!--Load JS Spot--><script src="<?php echo base_url('js/spot.js');?>"></script>
<?= $this->endSection('content') ?>