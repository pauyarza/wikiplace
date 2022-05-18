function deleteCategory(id_category,name,url){
    if (window.confirm("Do you want to ⚠️DELETE⚠️ " + name + "?")) {
        $.ajax({  
            url:url,
            type: 'post',
            dataType:'text',
            data: {
                id_category: id_category.toString()
            },
            success:function(response){
                if(response == "ok"){
                    location.reload();
                }
                else{
                    alert(response);
                }
            }
        });
    }
}