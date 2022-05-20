<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace | About us 👨🏻‍💻</title>
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<div class="container">
    <h1 class="abouth1">About us !</h1>
    <p class="aboutp">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
    <div class="row aboutimgs">
        <div class="col">
            <img class="profile" src="<?php echo base_url('public/img/profile.png'); ?>" alt="" srcset="">
            <p class="text-center aboutp2">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="col">
            <img class="profile" src="<?php echo base_url('public/img/profile.png'); ?>" alt="" srcset="">
            <p class="text-center aboutp2">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>