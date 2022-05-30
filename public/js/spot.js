$("#commentForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    
    var form = $(this);
    var actionUrl = form.attr('action');
    $("#sendCommentBtn").html("<img src='"+base_url+"/img/loadingWhite.svg' class='loadingBtnComment'></img>");

    // $.ajax({
    //     type: "POST",
    //     url: actionUrl,//get action from form (usercontroller/registerAjax)
    //     data: form.serialize(),
    //     success: function(response)
    //     {
    //         console.log(response);
    //         //login correct
    //         if (response == "registerCorrect") {
    //             location.reload();
    //         }
    //         //input incorrect
    //         else {
    //             $("#loginMainBtn").html("Register");
    //             updateRegisterFormErrors(response);
    //         }
    //     }
    // });
});