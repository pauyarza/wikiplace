<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace | About us 👨🏻‍💻</title>
    <!-- Profile CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profile.css'); ?>">
    <!--Font Awesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>

<div class="container profile-box">
    <img class="profile-img" src="<?php echo base_url('public/img/profile.png'); ?>" alt="Profile pic">
    <img class="edit-img" src="<?php echo base_url('public/img/icons/pencil.png'); ?>">

    <div class="text-center modal-body form">
            <?php  
                echo form_open('UserController/displayProfile'); 
            ?> 
                <br>
                    
                    <input 
                        type="text" 
                        placeholder="username / email"
                        id="usernameMailLogin"
                        name="usernameMail"
                        class="input-group-text"
                    >
                    <div class="invalid-feedback" id="usernameMailLoginError"></div>
                <br>
                    <input 
                        type="text" 
                        placeholder="password"
                        id="passwordLogin"
                        name="password"
                        class="input-group-text"
                    >
                    <div class="invalid-feedback" id="passwordLoginError"></div>
                <br>
                    <button class="custom-btn-1" type="submit">Login</button><br>
                    <div  id="customLoginError"></div>
                    
            </form>
            <button class="custom-btn-2" data-bs-target="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">Register</button>
        </div>
    
</div>


<?= $this->endSection('content') ?>