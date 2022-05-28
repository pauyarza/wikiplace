<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace | About us 👨🏻‍💻</title>
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
<script>
    var message = '<?php if(isset($message)) echo $message?>';
    if (message) alert(message);
</script>
<div class="container profile-box">
    <div class="avatar-upload">
        <?= form_open_multipart('userController/updateProfilePic', $avatarFormAttributes) ?>
        </form>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url('<?=$sessionData['profile_pic_src']?>');">
            </div>
        </div>
    </div>
    <div class="container">
    <h3><?=$sessionData["username"]?></h3>
    <h5 style="color:grey;"><?=$sessionData["mail"]?></h5>
    <hr class="hr-profile">
    <p style="color:white"><?=$description?></p></div>

    <button 
        class="profile-btn profile-btn-3" 
        type="submit">
            My collections
    </button>
    
</div>

<?= $this->endSection('content') ?>

