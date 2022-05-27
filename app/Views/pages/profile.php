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
            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"></label>
        </form>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url('<?=$sessionData['profile_pic_src']?>');">
            </div>
        </div>
    </div>
    <script >
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    </script>

    <h3><?=$sessionData["username"]?></h3>
    <h5 style="color:grey;"><?=$sessionData["mail"]?></h5>
    <div class="text-center modal-body form">
            <?php  
                echo form_open('UserController/editProfile'); 
            ?> 
                <input 
                    type="text" 
                    id="usernameedit"
                    name="username"
                    class="input-group-text profile-input-group"
                    value="<?=$sessionData["username"]?>"
                >
                <div class="invalid-feedback" id="usernameMailLoginError"></div>                  
                <textarea 
                    id="descriptionedit" 
                    name="description" 
                    placeholder="Describe yourself here..."
                    class="input-group-text profile-input-group"
                ><?=$description?></textarea>
                <div class="invalid-feedback" id="passwordLoginError"></div>
                <button 
                    class="profile-btn profile-btn-1" 
                    type="submit">
                        Save changes
                </button>
            </form>
        </div>
    
</div>

<!--Edit profile script--><script src="<?php echo base_url('js/editProfile.js'); ?>"></script>
<?= $this->endSection('content') ?>
