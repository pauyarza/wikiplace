function goMaps(lat,lng){
    window.open("http://maps.google.com/maps?q="+lat+","+lng);
}

function likeSpot(id_spot){
    $.ajax({
        type: "POST",
        url: "spotController/likeSpot",
        data: { id_spot : id_spot },
        success: function(response)
        {
            $(".totalLikes").html(response);
        }
    });
}

function unlikeSpot(id_spot){
    $.ajax({
        type: "POST",
        url: "spotController/unlikeSpot",
        data: { id_spot : id_spot },
        success: function(response)
        {
            $(".totalLikes").html(response);
        }
    });
}

function favSpot(id_spot){
    $.ajax({
        type: "POST",
        url: "spotController/favSpot",
        data: { id_spot : id_spot },
        success: function(response)
        {
            if(response == 'ok'){
                console.log("spot fav successfully");
            }
            else{
                console.log(response);
            }
        }
    });
}

function unfavSpot(id_spot){
    $.ajax({
        type: "POST",
        url: "spotController/unfavSpot",
        data: { id_spot : id_spot },
        success: function(response)
        {
            if(response == 'ok'){
                console.log("spot unfaved successfully");
            }
            else{
                console.log(response);
            }
        }
    });
}