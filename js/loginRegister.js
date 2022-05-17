//===========REGISTER===========//
$("#registerForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,//get action from form (usercontroller/registerAjax)
        data: form.serialize(),
        success: function(response)
        {
            console.log(response);
            //login correct
            if (response == "registerCorrect") {
                location.reload();
            }
            //input incorrect
            else {
                updateRegisterFormErrors(response);
            }
        }
    });
});

function updateRegisterFormErrors(errorList){
    $("#registerForm").removeClass("needs-validation");
    
    errorList = JSON.parse(errorList);
    //username
    if(!errorList.username){//correct
        $("#usernameRegister").removeClass( "is-invalid" );
        $("#usernameRegister").addClass( "is-valid" );
        $("#usernameRegisterError").html("");
    }
    else{//incorrect
        $("#usernameRegister").removeClass( "is-valid" );
        $("#usernameRegister").addClass( "is-invalid" );
        $("#usernameRegisterError").html(errorList.username);
    }
    
    //mail
    if(!errorList.mail){//correct
        $("#mailRegister").removeClass( "is-invalid" );
        $("#mailRegister").addClass( "is-valid" );
        $("#mailRegisterError").html("");
    }
    else{//incorrect
        $("#mailRegister").removeClass( "is-valid" );
        $("#mailRegister").addClass( "is-invalid" );
        $("#mailRegisterError").html(errorList.mail);
    }

    //password
    if(!errorList.password){//correct
        $("#passwordRegister").removeClass( "is-invalid" );
        $("#passwordRegister").addClass( "is-valid" );
        $("#passwordRegisterError").html("");
    }
    else{//incorrect
        $("#passwordRegister").removeClass( "is-valid" );
        $("#passwordRegister").addClass( "is-invalid" );
        $("#passwordRegisterError").html(errorList.password);
    }

    //password 2
    if(!errorList.passwordR){//correct
        $("#passwordRRegister").removeClass( "is-invalid" );
        $("#passwordRRegister").addClass( "is-valid" );
        $("#passwordRRegisterErrror").html("");
    }
    else{//incorrect
        $("#passwordRRegister").removeClass( "is-valid" );
        $("#passwordRRegister").addClass( "is-invalid" );
        $("#passwordRRegisterErrror").html(errorList.passwordR);
        $("#passwordRRegisterErrror").html(errorList.passwordR);
    }
}



//===========LOG IN===========//
$("#loginForm").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    
    var form = $(this);
    var actionUrl = form.attr('action');//get action from form (usercontroller/loginAjax)
    
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function (response) {
            response = JSON.parse(response);
            console.log(response);
            if (response.found) {
                alert("good to go");
                location.reload();
            }
            else{
                updateLoginFormErrors(response);
            }
        }
    });
});

function updateLoginFormErrors(errorList) {
    $("#loginForm").removeClass("needs-validation");
    $("#customLoginError").html("");
    //username
    if (!errorList.usernameMail) {//correct
        $("#usernameMailLogin").removeClass("is-invalid");
        $("#usernameMailLogin").addClass("is-valid");
        $("#usernameMailLoginError").html("");
    }
    else {//incorrect
        $("#usernameMailLogin").removeClass("is-valid");
        $("#usernameMailLogin").addClass("is-invalid");
        $("#usernameMailLoginError").html(errorList.usernameMail);
    }

    //password
    if (!errorList.password) {//correct
        $("#passwordLogin").removeClass("is-invalid");
        $("#passwordLogin").addClass("is-valid");
        $("#passwordLoginError").html("");
    }
    else {//incorrect
        $("#passwordLogin").removeClass("is-valid");
        $("#passwordLogin").addClass("is-invalid");
        $("#passwordLoginError").html(errorList.password);
    }

    if (errorList.customError){
        $("#customLoginError").html(errorList.customError);
    }
}
