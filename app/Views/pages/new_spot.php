<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace | New spot 📍</title>
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<h1>New spot</h1>
<?php 
    $formAttributes = [
        'id'  => 'registerForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
?>
<?=form_open('SpotController/NewSpot', $formAttributes)?>


<?= $this->endSection('content') ?>