/*=============================================
=                  EDIT PRODUCT               =
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
            console.log(res)
            // editClientName
            // editClientIdentity
            // editClientEmail
            // editClientPhone
            // editClientAddress
            // editClientBirthDate
            
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
