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
= AUTOCALCULATE SELLPRICE IN ADD PRODUCT MODAL=
=============================================*/
function activateListeners(costId, sellpriceId, checkboxId, percentId){
    //Change in cost input
    $(costId).change(function(){
        percentChanger(costId, sellpriceId, checkboxId, percentId);
    })
    //Change in checkbox input
    $(checkboxId).on('ifChecked', function(event){
        $(sellpriceId).prop('readOnly',true)
        $(percentId).prop('readOnly',false)
        percentChanger(costId, sellpriceId, checkboxId, percentId);
    });
    $(checkboxId).on('ifUnchecked', function(event){
        $(sellpriceId).prop('readOnly',false)
        $(percentId).prop('readOnly',true)
    });
    //Change in percent input
    $(percentId).change(function(){
        percentChanger(costId, sellpriceId, checkboxId, percentId);
    })
}
function percentChanger(costId, sellpriceId, checkboxId, percentId){
    var isPercent = $(checkboxId).prop('checked');
    var percentValue = $(percentId).val() || 0 ;

    if(isPercent){
        var newCostPrice = parseFloat($(costId).val()) || 0
        var newSellPrice =  newCostPrice +  (newCostPrice * percentValue/100) ;
        $(sellpriceId).val(newSellPrice)
        $(sellpriceId).prop("readOnly",true)
    }
} 

var addcheckboxId = '#addProductCheckBox';
var addpercentId = '#sellPercentValue';
var addsellpriceId = '#newSellPrice';
var addcostId = '#newCostPrice';

activateListeners(addcostId, addsellpriceId, addcheckboxId, addpercentId)

/*=============================================
=                  EDIT PRODUCT               =
=============================================*/

$(document).on('click',".btnEditProduct",function(){
    var idProduct = $(this).attr("idProduct");
    var data = new FormData();
    data.append("idProduct", idProduct);


    $.ajax({
        url: "ajax/products.ajax.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(res){

            if (res.ok) {
                $("#editProductId").val(res.data.id);
                $("#editCategoryproduct").val(res.data.category_id);
                $("#editCategoryproduct").html(res.data.category);
                $("#editBarcode").val(res.data.barcode);
                $("#editStock").val(res.data.stock);
                $("#editDescription").val(res.data.description);
                $("#editCostPrice").val(res.data.cost);
                $("#editSellPrice").val(res.data.sell_price);
                if(res.data.image){
                    $(".preview_image").attr("src",res.data.image);
                }
            }else{
                window.location = 'productos';
            }
        }
    })
})

var editcheckboxId = '#editProductCheckBox';
var editpercentId = '#editsellPercentValue';
var editsellpriceId = '#editSellPrice';
var editcostId = '#editCostPrice';

activateListeners(editcostId, editsellpriceId, editcheckboxId, editpercentId)

/*=============================================
=               DELETE PRODUCT                =
=============================================*/
$(document).on('click',".btn_delete_product",function(){
    var btn = $(this)
    var idProduct = $(this).attr("idProduct");

    swal({
        type: 'warning',
        title: '¿Está seguro de borrar el producto?',
        text: "¡Si no lo está puede cancelar la acción",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        comfirmButtonText: 'Si, borrar producto!',
    }).then((res)=>{
        if(res.value){
            window.location = 'index.php?ruta=productos&idTodelete='+idProduct;
        }
    });
})
