/*=============================================
=          PARTIAL LOAD OF PRODUCTS BY        =
=============================================*/
// $.ajax({
//     url: "ajax/datatable-products.ajax.php",
//     success: function(res){
//         console.log(res)
//     }
// })

// $('#datatableProduct').DataTable( {
//     "ajax": "ajax/datatable-products.ajax.php"
// } );

/*=============================================
=           AUTOGENERATE BARCODE              =
=============================================*/
$('#newCategoryproduct').change(function(){

    var idCategory = $(this).val();
    var data = new FormData();
    data.append("idCategory", idCategory);
    

    $.ajax({
        url: "ajax/products.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){

            if(res.ok){
                $('#newBarcode').val(res.code)

            }else if( Number.isInteger( parseInt( idCategory) ) ){
                var newCode = parseInt(idCategory) * 10000000 + 1
                $('#newBarcode').val(newCode)
            }else{
                swal({
                    type: 'warning',
                    title: 'Ocurrió un error generando el código',
                }).then((res)=>{
                    window.location = 'productos';                  
                });
            }
        }
    })
})

/*=============================================
=          AUTOCALCULATE SELLPRICE            =
=============================================*/
//Change in cost input
$('#newCostPrice').change(function(){
    percentChanger();
})
//Change in checkbox input
$('#addProductCheckBox').on('ifChecked', function(event){
    $('#newSellPrice').prop('readOnly',true)
    $('#sellPercentValue').prop('readOnly',false)
    percentChanger();
});
$('#addProductCheckBox').on('ifUnchecked', function(event){
    $('#newSellPrice').prop('readOnly',false)
    $('#sellPercentValue').prop('readOnly',true)
});

//Change in percent input
$('#sellPercentValue').change(function(){
    percentChanger();
})

function percentChanger(){
    var isPercent = $('#addProductCheckBox').prop('checked');
    var percentValue = $('#sellPercentValue').val() || 0 ;

    if(isPercent){
        var newCostPrice = parseInt($('#newCostPrice').val()) || 0
        var newSellPrice =  newCostPrice +  (newCostPrice * percentValue/100) ;
        $('#newSellPrice').val(newSellPrice)
        $('#newSellPrice').prop("readOnly",true)
    }
} 