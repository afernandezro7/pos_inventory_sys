/*=============================================
=                  EDIT Client               =
=============================================*/

$(document).on('click',".btnEditClient",function(){
    var idClient = $(this).attr("idClient");
    var data = new FormData();
    data.append("idClient", idClient);

    $.ajax({
        url: "ajax/clients.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){
            
            if (res.ok) {


                $("#editClientId").val(res.data.id);
                $("#editClientName").val(res.data.name);
                $("#editClientIdentity").val(res.data.identity);
                $("#editClientEmail").val(res.data.email);
                $("#editClientPhone").val(res.data.phone);
                $("#editClientAddress").val(res.data.address);
                $("#editClientBirthDate").val(res.data.birth);
                
            }else{
                window.location = 'clientes';
            }
        }
    })
})

/*=============================================
=               DELETE Client                =
=============================================*/
$(document).on('click',".btn_delete_client",function(){
    var btn = $(this)
    var idClient = $(this).attr("idClient");

    swal({
        type: 'warning',
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        comfirmButtonText: 'Si, borrar cliente!',
    }).then((res)=>{
        if(res.value){
            window.location = 'index.php?ruta=clientes&idTodelete='+idClient;
        }
    });
})