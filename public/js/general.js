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
                Swal.mixin({
                    toast: true,
                    position: "bottom",
                    showConfirmButton: false,
                    timer: 1200,
                }).fire({
                    title: "Spot saved!"
                })
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
                Swal.mixin({
                    toast: true,
                    position: "bottom",
                    showConfirmButton: false,
                    timer: 1200,
                }).fire({
                    title: "Spot unsaved."
                })
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
                        confirmButtonColor: '#00C09A',
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

function deleteSpot(id_spot){//check if it's owner or admin at the controller
    Swal.fire({
        heightAuto: false,
        title: 'Delete spot?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#DC3545',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                type: "POST",
                url: base_url+"/spotController/deleteSpot",
                data: { id_spot : id_spot },
                success: function(response)
                {
                    if(response == 'ok'){
                        console.log("Spot deleted successfully");
                        $(".spot"+id_spot).hide('slow', function(){ $target.remove(); });//delete reports from this spot
                    }
                    else{
                        console.log(response);
                    }
                }
            });
        }
    })
}

function deleteSpotBanUser(id_spot,id_user){//check if it's admin at the controller
    Swal.fire({
        heightAuto: false,
        title: 'Delete spot and ban user?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: '#DC3545',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed){
            if(!id_user) id_user = null;
            $.ajax({
                type: "POST",
                url: base_url+"/admin/deleteSpotBanUser",
                data: {
                    id_spot: id_spot,
                    id_user: id_user
                },
                success: function(response)
                {
                    if(response == 'ok'){
                        $(".spot"+id_spot).hide('slow', function(){ $target.remove(); });//delete reports from this spot
                        console.log("spot deleted successfully");
                    }
                    else{
                        console.log(response);
                    }
                }
            });
        }
    })
}