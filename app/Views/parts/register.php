
<?php 
    $formAttributes = [
        'id'  => 'registerForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
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