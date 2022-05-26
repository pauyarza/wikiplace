
<?php 
    $formAttributes = [
        'id'  => 'registerForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
?>
<!-- Modal -->
<div class="modal fade register" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="text-center modal-body form">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <?php
                echo form_open('UserController/registerAjax',$formAttributes); 
            ?>
                <img src="<?php echo base_url('img/wiki.svg') ?>" class="logoLogin">
                <input 
                    type="text" 
                    placeholder="username" 
                    name="username"
                    id="usernameRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="usernameRegisterError"></div>
                <input 
                    type="text" 
                    placeholder="mail" 
                    name="mail" 
                    id="mailRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="mailRegisterError"></div>
                <input 
                    type="password" 
                    placeholder="password" 
                    name="password" 
                    id="passwordRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="passwordRegisterError"></div>
                <input 
                    type="password" 
                    placeholder="repeat password"
                    name="passwordR" 
                    id="passwordRRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="passwordRRegisterErrror"></div>
                <button id="loginMainBtn" class="loginMainBtn loginBtn" type="submit">Register</button>
                <button class="loginSecondaryBtn loginBtn" type="button" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
</div>