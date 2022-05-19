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
    window.ityped.init(document.querySelector('.ityped'),{
    strings: ['parkour','climbing','xavi handsome'],
    loop: true
})
</script>


<?= $this->endSection('content') ?>