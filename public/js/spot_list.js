
function triggerSpotListLike(id_spot){
    if(!logged_in){
        $('#registerModal').modal('show');
    }
    else{
        image = $("#likeButton"+id_spot);
        div = image.parent();
        //unlike
        if($(div).hasClass("liked")){
            $.ajax({
                type: "POST",
                url: base_url+"/spotController/unlikeSpot",
                data: { id_spot : id_spot },
                success: function(response)
                {
                    $("#totalLikes"+id_spot).html(response);
                }
            });
            image.fadeOut(100, function () {
                image.attr('src', base_url+'/img/noLikeGrey.png');
                image.fadeIn(100);
            });
        }
        //like
        else{
            $.ajax({
                type: "POST",
                url: base_url+"/spotController/likeSpot",
                data: { id_spot : id_spot },
                success: function(response)
                {
                    $("#totalLikes"+id_spot).html(response);
                }
            });
            image.fadeOut(100, function () {
                image.attr('src', base_url+'/img/like.png');
                image.fadeIn(100);
            });
        }

        div.toggleClass("liked"); 
    }
    
}

function triggerSpotListFav(id_spot){
    if(!logged_in){
        $('#registerModal').modal('show');
    }
    else{
        image = $("#favButton"+id_spot);
        image.attr('src', base_url+'/img/loadingBlack.svg');
        if($("#favButton"+id_spot).hasClass("faved")){
            unfavSpot(id_spot);
            image.fadeOut(100, function () {
                image.attr('src', base_url+'/img/noFavGrey.png');
                image.fadeIn(100);
            });
            console.log("faved");
        }
        //like
        else{
            favSpot(id_spot);
            console.log("notfaved");
            image.fadeOut(100, function () {
                image.attr('src', base_url+'/img/favGrey.png');
                image.fadeIn(100);
            });
        }

        image.toggleClass("faved");
    }
}