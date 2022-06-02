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
                        $(".spot_report"+id_spot_report).hide('slow', function(){$(".spot_report"+id_spot_report).remove(); });//delete reports from this spot
                    }
                    console.log(response);
                }
            });
        }
    })
}

function displayCommentAdmin(comment,id_comment,id_reported,id_comment_report){
    Swal.fire({
        html:
            '<br>'+
            '<b>Reported commentt:</b><br>"'+
            comment +
            '"<br><br>'+
            '<a onclick="deleteComment('+id_comment+')" class="btn btn-warning" title="Delete comment">'+
                '<i class="fa-solid fa-circle-minus"></i>'+
            '</a> '+
            '<a '+
                'onclick="deleteCommentBanUser('+id_comment+','+id_reported+')"'+
                'class="btn btn-danger"'+
                'title="Delete comment and ban user"'+
            '>'+
                '<i class="fa-solid fa-user-slash"></i>'+
            '</a> '+
            '<a '+
                'onclick="deleteCommentReport('+id_comment_report+')"'+
                'class="btn btn-secondary"'+
                'title="Discard report"'+
            '>'+
                '<i class="fa-solid fa-delete-left"></i>'+
            '</a>'
            ,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: "Cancel",
    })
}


function deleteCommentReport(id_comment_report){
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
                url: base_url+"/admin/deleteCommentReport",
                data: {
                    id_comment_report: id_comment_report
                },
                success: function(response)
                {
                    if(response == 'ok'){
                        $(".comment_report"+id_comment_report).hide('slow', function(){$(".comment_report"+id_comment_report).remove(); });//delete reports from this comment
                    }
                    console.log(response);
                }
            });
        }
    })
}