function deleteCategory(id_category,name,urlDelete,urlRedirect){
    if (window.confirm("Do you want to ⚠️DELETE⚠️ " + name + "?")) {
        $.ajax({  
            url:urlDelete,
            type: 'post',
            dataType:'text',
            data: {
                id_category: id_category.toString()
            },
            success:function(response){
                if(response == "ok"){
                    window.location.href = urlRedirect;
                }
                else{
                    alert(response);
                }
            }
        });
    }
}

function deleteSpotReport(id_spot_report){
    Swal.fire({
        heightAuto: false,
        title: 'Discard report?',
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
                url: base_url+"/admin/deleteSpotReport",
                data: {
                    id_spot_report: id_spot_report
                },
                success: function(response)
                {
                    if(response == 'ok'){
                        $(".spot_report"+id_spot_report).hide('slow', function(){ $target.remove(); });//delete reports from this spot
                    }
                    console.log(response);
                }
            });
        }
    })
}