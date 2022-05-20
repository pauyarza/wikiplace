
<?php 
    $formAttributes = [
        'id'  => 'registerForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
?>
     <!-- Modal -->
<div class="modal fade register" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="text-center modal-body form">
            <?php
                echo form_open('UserController/registerAjax',$formAttributes); 
            ?>
            <br>
                <img src="<?php echo base_url('public/img/wiki.svg') ?>" alt="" srcset="">
                <input 
                    type="text" 
                    placeholder="username" 
                    name="username"
                    id="usernameRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="usernameRegisterError"></div>
            <br>
                <input 
                    type="text" 
                    placeholder="mail" 
                    name="mail" 
                    id="mailRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="mailRegisterError"></div>
            <br>
                <input 
                    type="text" 
                    placeholder="password" 
                    name="password" 
                    id="passwordRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="passwordRegisterError"></div>
            <br>
                <input 
                    type="text" 
                    placeholder="repeat password"
                    name="passwordR" 
                    id="passwordRRegister"
                    class="input-group-text"
                >
                <div class="invalid-feedback" id="passwordRRegisterErrror"></div>
            <br>
                <button class="custom-btn-1" type="submit">Register</button>
            </form>
            <button class="custom-btn-2" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Login</button>
        </div>
    </div>
  </div>
</div>