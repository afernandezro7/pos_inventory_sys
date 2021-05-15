/*=============================================
=               EDIT CATEGORY                 =
=============================================*/

$(document).on('click',".btnEditCategory",function(){
    var idCategory = $(this).attr("idCategory");
    var data = new FormData();
    data.append("idCategory", idCategory);


    $.ajax({
        url: "ajax/categories.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){
            $("#editCategoryId").val(res.id);
            $("#editCategoryName").val(res.name);
        }
    })
})
/*=============================================
=               DELETE CATEGORY               =
=============================================*/
$(document).on('click',".btn_delete_category",function(){
    var btn = $(this)
    var idCategory = $(this).attr("idCategory");

    swal({
        type: 'warning',
        title: '¿Está seguro de borrar la categoría?',
        text: "¡Si no lo está puede cancelar la acción",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        comfirmButtonText: 'Si, borrar categoría!',
    }).then((res)=>{
        if(res.value){
            window.location = 'index.php?ruta=categorias&idTodelete='+idCategory;
        }
    });
})