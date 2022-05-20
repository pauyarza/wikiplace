<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace</title>
    <!-- Index CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/index.css'); ?>">

<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<div class="index">
    <div class="container index-box">
        <img class="index-logo" src="<?php echo base_url('public/img/logo.svg'); ?>" alt="wikiplace.org">
        <?=form_open('home/search')?>
        
        <div class="input-group mb-3">
            <input type="text" class="form-control search-input" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="fas fa-search"></i>
            </button>
        </div>    
        
        <!--<div class="input-group">
                <div class="form-outline">
                    <input type="search" name="search" class="form-control search-input" />
                    <label class="form-label" for="form1">Search</label>
                </div>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-search search-ico"></i>
                </button>
            </div>-->
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