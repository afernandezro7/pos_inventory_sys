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
                var newcode = nextcodegenerator(res.code)

                if(newcode){
                    $('#newBarcode').val(newcode)
                }else{
                    swal({
                        type: 'warning',
                        title: 'Ocurrió un error generando el código',
                    }).then((res)=>{
                        window.location = 'productos';                  
                    });
                }
            } else if( Number.isInteger( parseInt(idCategory) ) ){

                var category = parseInt(idCategory)
                var newcode = nextcodegenerator(category,'firstItem')
                
                $('#newBarcode').val(newcode)
            } else{
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

function nextcodegenerator(item,type='lastcode'){
    if(type == 'lastcode'){

        var category = item.split('-')[0];
        var product = Number(item.split('-')[1]) + 1;
        if(product <= 999999){
            var prodlenght = product.toString().length;
            var zeros = 6 - prodlenght;
        
            var cifra = "";
            for(var i = 0; i <zeros; i++){
                cifra +='0'
            }
        
            return newCode = category + '-' +cifra+product;
        }else{
            return false;
        }
    } else if(type == 'firstItem'){
        var catlenght = item.toString().length;
        var zeros = 3 - catlenght;
        
            var cifra = "";
            for(var i = 0; i <zeros; i++){
                cifra +='0'
            }
        var categoryform = 'P'+ cifra + item
        return categoryform + '-' + '000001'
    }

}

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
        var newCostPrice = parseFloat($('#newCostPrice').val()) || 0
        var newSellPrice =  newCostPrice +  (newCostPrice * percentValue/100) ;
        $('#newSellPrice').val(newSellPrice)
        $('#newSellPrice').prop("readOnly",true)
    }
} 