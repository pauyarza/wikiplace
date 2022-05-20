
<?php 
    $formAttributes = [
        'id'  => 'loginForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
 ?> 
 <!-- Modal -->
<div class="modal fade login" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="text-center modal-body form">
            <?php  
                echo form_open('UserController/loginAjax',$formAttributes); 
            ?> 
                <br>
                <img src="<?php echo base_url('public/img/wiki.svg') ?>" alt="wiki">
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
                <div id="customLoginError"></div>
                <button class="custom-btn-1" type="submit">Login</button><br>
            </form>
            <button class="custom-btn-2" data-bs-target="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">Register</button>
        </div>
    </div>
  </div>
</div>