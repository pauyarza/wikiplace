<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace | About us 👨🏻‍💻</title>
    <!--Snippet description--><meta name="description" content="Know information about Wikiplace creators!">
    <!-- CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/about_us.css'); ?>">
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<div class="container">
    <h1 class="abouth1">About us!</h1>
    <p class="aboutp">
        We are two junior developers who made this web page with love and passion. We decided to do this project because we care about the Internet as a free tool to bring people and communities together.</p>
    <div class="row aboutimgs">
        <div class="col">
            <img class="profile" src="<?php echo base_url('img/pau.jpg'); ?>" alt="" srcset="">
            <p class="text-center aboutp2">@Pau Yarza<br><a href="https://www.pauyarza.com">pauyarza.com</a></p>
            <p class="text-center aboutp2">With an artistic background, I love designing and creating websites.</p>
        </div>
        <div class="col">   
            <img class="profile" src="<?php echo base_url('img/xavi.jpg'); ?>" alt="" srcset="">
            <p class="text-center aboutp2">@Xavier Patiño<br><a href="https://www.xpatinyo.com">xpatinyo.com</a></p>
            <p class="text-center aboutp2">I have enjoyed playing with computers since childhood, and that has continued up to now, that I can proudly say that I am a web developer!</p>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>