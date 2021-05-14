/*=============================================
=          UPLOADING USER PICTURE             =
=============================================*/

$(".newAvatar").change(function(){
    var imageFile = this.files[0];

    if(imageFile.type != "image/jpeg" && 
       imageFile.type != "image/png"){
        $(".newAvatar").val("");
        swal({
            type: 'error',
            title: 'Error al subir la imagen',
            text: 'La imagen debe estar en formato png o jpg',
            confirmButtonText: '¡cerrar!',
        });
    }else if(imageFile.size > 2000000){
        $(".newAvatar").val("");
        swal({
            type: 'error',
            title: 'Error al subir la imagen',
            text: 'La imagen debe tener un tamaño menor que 2 Mb',
            confirmButtonText: '¡cerrar!',
        });
    } else {
        var imageData = new FileReader;
        imageData.readAsDataURL(imageFile);

        $(imageData).on("load", function(e){
            var urlImage = e.target.result;

            $(".preview_image").attr("src", urlImage);

        })
    }

})

/*=============================================
=                  EDIT USER                  =
=============================================*/

$(".btnEditUser").click(function(){
    var idUser = $(this).attr("idUser");
    var data = new FormData();
    data.append("idUser", idUser);


    $.ajax({
        url: "ajax/users.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){
            console.log(res)

            $("#editId").val(res.id);
            $("#editName").val(res.name);
            $("#editUserName").val(res.userName);
            $("#editRole").val(res.role);
            if(res.avatar){
                $(".preview_image").attr("src",res.avatar);
            }
        }
    })
})