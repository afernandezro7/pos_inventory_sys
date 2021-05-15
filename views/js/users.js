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

/*=============================================
=             ENABLE/DISABLE USER             =
=============================================*/
$(".btn_activation").click(function(){
    var btn = $(this)
    var idUser = $(this).attr("idUser");
    var userStatus = $(this).attr("toggleStatus");

    var data = new FormData();
    data.append("activateId", idUser);
    data.append("userStatus", userStatus);

    $.ajax({
        url: "ajax/users.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){           
            if(res.ok){
                if(userStatus == 0){
                    btn.removeClass('btn-success');
                    btn.addClass('btn-danger');
                    btn.html('Desactivado');
                    btn.attr('toggleStatus', '1')
                }else if(userStatus == 1){
                    btn.removeClass('btn-danger');
                    btn.addClass('btn-success');
                    btn.html('Activado');
                    btn.attr('toggleStatus', '0')
                }
            }
            
        }
    })
   
});

/*=============================================
=           USER EXIST IN DB REALTIME         =
=============================================*/
$("#newUsername").change(function(){

    $(".alert").remove();
    var user = $(this).val();

    var data = new FormData();
    data.append("searchUsername", user);


    $.ajax({
        url: "ajax/users.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){
            
            if(res){
                $("#newUsername").parent().after('<div class="alert alert-warning">El usuario ya existe en el sistema</div>')
                $("#newUsername").val("");
            }
        }
    })

});
