
<?php 
    $formAttributes = [
        'id'  => 'loginForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
 ?> 
 <!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="text-center modal-body">
            <?php  
                echo form_open('UserController/loginAjax',$formAttributes); 
            ?> 
                <br>
                    <h1>login</h1>
                    <input 
                        type="text" 
                        placeholder="username / email"
                        id="usernameMailLogin"
                        name="usernameMail"
                        class="form-control"
                    >
                    <div class="invalid-feedback" id="usernameMailLoginError"></div>
                <br>
                    <input 
                        type="text" 
                        placeholder="password"
                        id="passwordLogin"
                        name="password"
                        class="form-control"
                    >
                    <div class="invalid-feedback" id="passwordLoginError"></div>
                <br>
                    <button type="submit">Login</button><br>
                    <div id="customLoginError"></div>
                    
            </form>
            <button data-bs-target="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">Register</button>
        </div>
    </div>
  </div>
</div>