function goMaps(lat,lng){
    window.open("http://maps.google.com/maps?q="+lat+","+lng);
}

function likeSpot(id_spot){
    $.ajax({
        type: "POST",
        url: base_url+"/spotController/likeSpot",
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
        url: base_url+"/spotController/unlikeSpot",
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
        url: base_url+"/spotController/favSpot",
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
        url: base_url+"/spotController/unfavSpot",
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

function reportSpot(id_spot){
    Swal.fire({
        title: 'Report spot',
        input: 'textarea',
        inputLabel: 'Report reason:',
        inputPlaceholder: 'Type your report reason here...',
        inputAttributes: {'aria-label': 'Type your reason here'},
        confirmButtonColor: '#00C09A',
        showCancelButton: true,
        reverseButtons: true,
        heightAuto: false,
    }).then(function (alert) {
        message = alert.value;
        $.ajax({
            type: "POST",
            url: base_url+"/spotController/reportSpot",
            data: {
                id_spot: id_spot,
                report_message: message
            },
            cache: false,
            success: function(response) {
                if(response == "ok"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank you!',
                        text: 'We will take care of it 😉',
                        heightAuto: false,
                    })
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        text: response,
                        heightAuto: false,
                    })
                }
            }
        });
    },)
}