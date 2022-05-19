<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace</title>
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<div class="index">
    <div class="container index-box">
        <img class="index-logo" src="<?php echo base_url('public/img/logo.svg'); ?>" alt="wikiplace.org">
        <?=form_open('home/search')?>
            <img class="search-icon" src="<?php echo base_url('public/img/search.svg'); ?>">
            <input type="search" name="search" class="search-input">
            <!-- <div class="search results">
                <div>result1</div>
                <div>result2</div>
            </div> -->
        </form>
        <!--Typer-->
        <h2 class="typer"><span class="ityped"></span></h2>
        <!-- Necessary for typer --><script src="https://unpkg.com/ityped@0.0.10"></script>
    </div>
</div>

<script>
    var categories = [];
    <?php
        foreach($categories as $category){
            echo "categories.push('".$category['name']."');";
        }
    ?>
    console.log(categories);
    window.ityped.init(document.querySelector('.ityped'),{
        strings: categories,
        loop: true,
        typeSpeed:  90,
        startDelay: 200,
        backDelay:  700,
    })
</script>


<?= $this->endSection('content') ?>