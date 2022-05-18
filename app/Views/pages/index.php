<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace</title>
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<div class="index">

    <img class="indexsvg" src="<?php echo base_url('public/img/logo.svg'); ?>" alt="wikiplace.org">
    <!--Typer-->
    <h2 class="typerh2"><span class="ityped"></span></h2>
    <!-- Necessary for typer --><script src="https://unpkg.com/ityped@0.0.10"></script>
</div>


<?= $this->endSection('content') ?>