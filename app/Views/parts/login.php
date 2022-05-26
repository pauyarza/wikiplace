
<?php 
    $formAttributes = [
        'id'  => 'loginForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
?> 
<script>
    var loadingUrl = "<?=base_url('img/loadingWhite.svg')?>";
</script>

<!-- Modal -->
<div class="modal fade login" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="text-center modal-body form">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <?php  
                echo form_open('UserController/loginAjax',$formAttributes); 
            ?> 
                <img src="<?php echo base_url('img/wiki.svg') ?>" alt="wiki" class="logoLogin">
                <input 
                    type="text" 
                    placeholder="username / email"
                    id="usernameMailLogin"
                    name="usernameMail"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="usernameMailLoginError"></div>
                <input 
                    type="password" 
                    placeholder="password"
                    id="passwordLogin"
                    name="password"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="passwordLoginError"></div>
                <div id="customLoginError"></div>
                <button id="usernameMailLoginBtn" class="loginMainBtn loginBtn" type="submit">Login</button><br>
                <button class="loginSecondaryBtn loginBtn" type="button"data-bs-target="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                    Register
                </button>
            </form>
        </div>
    </div>
</div>
</div>