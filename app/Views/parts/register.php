
<?php 
    $formAttributes = [
        'id'  => 'registerForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
?>
     <!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="text-center modal-body">
            <?php
                echo form_open('UserController/registerAjax',$formAttributes); 
            ?>
            <br>
                <h1>register</h1>
                <input 
                    type="text" 
                    placeholder="username" 
                    name="username"
                    id="usernameRegister"
                    class="form-control"
                >
                <div class="invalid-feedback" id="usernameRegisterError"></div>
            <br>
                <input 
                    type="text" 
                    placeholder="mail" 
                    name="mail" 
                    id="mailRegister"
                    class="form-control"
                >
                <div class="invalid-feedback" id="mailRegisterError"></div>
            <br>
                <input 
                    type="text" 
                    placeholder="password" 
                    name="password" 
                    id="passwordRegister"
                    class="form-control"
                >
                <div class="invalid-feedback" id="passwordRegisterError"></div>
            <br>
                <input 
                    type="text" 
                    placeholder="repeat password"
                    name="passwordR" 
                    id="passwordRRegister"
                    class="form-control"
                >
                <div class="invalid-feedback" id="passwordRRegisterErrror"></div>
            <br>
                <button type="submit">Register</button>
            </form>
            <button data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Login</button>

        </div>
    </div>
  </div>
</div>