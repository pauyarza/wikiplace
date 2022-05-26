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