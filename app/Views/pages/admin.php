<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head') ?>
<title>Wikiplace | Admin</title>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
<div class="container">
    <h1>Manage Wikiplace</h1>
    <h2>Categories</h2>
    <?=form_open('UserController/loginAjax', $formAttributes)?>
        <h3>New category</h3>
        <input name="Name" type="text" class="form-control">
        <button class="btn"></button>
    <form action=""></form>
</div>
<?= $this->endSection('content') ?>