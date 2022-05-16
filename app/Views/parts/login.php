
<?php 
    $formAttributes = [
        'id'  => 'loginForm',
        'class'  => 'container needs-validation',
        'novalidate' => 'true',
    ];
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
        <button type="submit">Login</button>
        <div id="customLoginError"></div>
</form>