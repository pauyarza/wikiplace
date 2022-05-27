$("#imageUpload").change(function () {
    var file_data = $('#imageUpload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('avatar', file_data);
    console.log(form_data);
    $.ajax({
        url: "updateProfilePic",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function (response) {
            console.log(response);
        }
    });
});