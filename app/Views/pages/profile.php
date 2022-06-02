<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace | Profile 👥</title>
    <!-- Profile CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profile.css'); ?>">
    <!--Font Awesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>
<?php 
    $avatarFormAttributes = [
        'class'  => 'avatar-edit',
        'novalidate' => 'true',
        'id' => 'formUpdateAvatar',
    ];
?>
<div class="container profile-box">
    <div class="avatar-upload">
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url('<?=$user['profile_pic_src']?>');">
            </div>
        </div>
    </div>
    <div class="container">
        <?php if($user["id_user"] == $sessionData["id_user"]) {?>
            <a class="btn editProfileBtn" href="<?=base_url('UserController/displayEditProfile')?>">Edit</a>
        <?php } ?>
        <h3><?=$user["username"]?></h3>
        <hr class="hr-profile">
        <p style="color:white"><?=$user['description']?></p>
    </div>

    <div class="d-flex justify-content-center">
        <a 
            class="btn profile-btn" 
            type="submit"
            href="<?=base_url('SpotController/displayUserSpots/'.$user['id_user'])?>"
        >
            Created spots
        </a>
        <a 
            class="btn profile-btn" 
            type="submit"
            href="<?=base_url('SpotController/displaySavedSpots/'.$user['id_user'])?>"
        >
            Saved spots
        </a>
    </div>
    
</div>

<?= $this->endSection('content') ?>

