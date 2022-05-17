<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace</title>
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<h1 class="indexh1">wikiplace.org</h1>
<!--Typer-->
<h2><span class="ityped"></span></h2>
<!-- Necessary for typer --><script src="https://unpkg.com/ityped@0.0.10"></script>

<?= $this->endSection('content') ?>