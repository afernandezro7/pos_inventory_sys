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