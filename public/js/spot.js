$("#commentForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    
    var form = $(this);
    var actionUrl = form.attr('action');
    $("#sendCommentBtn").html("<img src='"+base_url+"/img/loadingWhite.svg' class='loadingBtnComment'></img>");

    $.ajax({
        type: "POST",
        url: actionUrl, //get action from form
        data: form.serialize(),
        success: function(response)
        {
            if(response == 'ok'){
                window.location.href += "?commentAdded=true";
            }
            else{
                $("#feedbackComment").text(response);
                $("#newcommentSpot").addClass("is-invalid");
                $("#sendCommentBtn").html("Comment");
            }
        }
    });
});

function likeSpotDisplaySpot(id_spot){
    image = $("#likeImg");
    //unlike
    if($(".likeButton").hasClass("liked")){
        unlikeSpot(id_spot);
        image.fadeOut(100, function () {
            image.attr('src', base_url+'/img/noLikeWhite.png');
            image.fadeIn(100);
        });
    }
    //like
    else{
        likeSpot(id_spot);
        image.fadeOut(100, function () {
            image.attr('src', base_url+'/img/like.png');
            image.fadeIn(100);
        });
    }

    $(".likeButton").toggleClass("liked");
}

function triggerFav(id_spot){
    image = $("#favButton");
    image.attr('src', base_url+'/img/loadingWhite.svg');
    if($(".favButton").hasClass("faved")){
        unfavSpot(id_spot);
        image.fadeOut(100, function () {
            image.attr('src', base_url+'/img/noFav.svg');
            image.fadeIn(100);
        });
    }
    //like
    else{
        favSpot(id_spot);
        image.fadeOut(100, function () {
            image.attr('src', base_url+'/img/fav.svg');
            image.fadeIn(100);
        });
    }

    $(".favButton").toggleClass("faved");
}