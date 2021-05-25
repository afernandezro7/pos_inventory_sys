// add_sell_action rescue_btn
/*=============================================
=              Add product to sell            =
=============================================*/
$(document).on('click',".add_product_to_sell_action",function(){
    var idProduct = $(this).attr("idProduct");
    var btn = $(this).removeClass("btn-primary add_product_to_sell_action")
    var data = new FormData();
    data.append("idProduct", idProduct);

    if(localStorage.getItem('quit_product') != null){
        var idProductList = JSON.parse(localStorage.getItem('quit_product'));

        var newlist = idProductList.filter( function(prod){
            if(prod.idProduct != idProduct){
                return prod;
            }
        })

        idQuitProduct = newlist;
        localStorage.setItem('quit_product',JSON.stringify(newlist))

    }

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

                var stock = res.data.stock;
                var description = res.data.description;
                var price = Number(res.data.sell_price);
                var cost = Number(res.data.cost);

                var productdescription = `
                    <div class="col-xs-5" style="padding-right:0px">
                        <div class="input-group">
                            <span class="input-group-addon" style="padding:3px">
                                <button 
                                    class="btn btn-danger btn-xs quit_product_sell" 
                                    idProduct="${idProduct}" 
                                    type="button"
                                >
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                            <input 
                                class="form-control product_desc" 
                                type="text" 
                                name="addProduct" 
                                value="${description}" 
                                idProduct="${idProduct}" 
                                readonly
                                required
                            >
                        </div>
                    </div>`
                ;

                var productamount = `
                    <div class="col-xs-3 productamount">
                        <input  
                            class="form-control product_amount"
                            type="number"   
                            name="newAmountProduct"
                            min="1" 
                            value="1" 
                            max="${stock}"
                            stock="${stock}"
                            required
                        >
                    </div>`
                ;

                var productprice = `
                    <div class="col-xs-4 productprice" style="padding-left:0px">
                        <div class="input-group">


                            <span class="input-group-addon">
                              <input type="checkbox" class="price_checkbox" checkbox_target="${idProduct}">
                            </span>
                            
                            <input 
                                checkbox_id="${idProduct}"
                                class="form-control product_price" 
                                type="number"
                                name="newPriceProduct"
                                min="${cost}"
                                value="${price}" 
                                stock="1"
                                total="${price}"
                                step="any"
                                placeholder="000"  
                                readonly
                                required
                            >
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        </div>
                    </div>
                `;

                $(".newProduct").append(`
                    <div class="row" style="padding:5px 5px">
                        ${productdescription} 
                        ${productamount} 
                        ${productprice}
                    </div>
                `);

                sumPrices();

            }else{
                btn.addClass("btn-primary add_product_to_sell_action")
            }
        }
    })
})
//min and max value for amount of products on stock
$('#form_sell').on('change',"input.product_amount",function(){
    var maxvalue = Number($(this).attr("stock"));
    var currentvalue = Number($(this).val());
    if(currentvalue < 1){
        $(this).val(1);
    }
    if(currentvalue > maxvalue){
        $(this).val(maxvalue);
    }
    
    //set stock and total to price input
    var stockElement = $(this);
    var priceElement = $(this).parent().parent().children('.productprice').children().children('input[type=number]');
    var total = Number(stockElement.val()) * Number(priceElement.val())
    priceElement.attr("stock",stockElement.val())
    priceElement.attr("total",total)

    sumPrices();
   
    
})
//set min price to cost
$('#form_sell').on('change',"input.product_price",function(){
    var minvalue = Number($(this).attr("min"));
    var currentvalue = Number($(this).val());
    if(currentvalue < minvalue ){
        $(this).val(minvalue);
    }

    //set stock and total to price input
    var priceElement = $(this);
    var stockElement = $(this).parent().parent().parent().children('.productamount').children();
    var total = Number(stockElement.val()) * Number(priceElement.val())
    priceElement.attr("stock",stockElement.val())
    priceElement.attr("total",total)

    sumPrices();
})
//edit final price for client
$('#form_sell').on('change',"input.price_checkbox",function(){
    var target = $(this).attr("checkbox_target");
    var checkbox = $(this);

    if(checkbox.prop("checked") == true){
        $("[checkbox_id=" + target + "]").prop("readonly",false);
    }
    else if($(this).prop("checked") == false){
        $("[checkbox_id=" + target + "]").prop("readonly",true);
    }
})

/*=============================================
=           Quit product of sell list         =
=============================================*/
var idQuitProduct = [];
localStorage.removeItem('quit_product');

$('.sellTable').on("draw.dt", function(){
    if(localStorage.getItem('quit_product') != null){
        var idProductList = JSON.parse(localStorage.getItem('quit_product'));
        for (var i = 0; i < idProductList.length; i++) {
            (idProductList[i].idProduct)

            $('button.rescue_btn[idProduct='+idProductList[i].idProduct+']').addClass("btn-primary add_product_to_sell_action")            
        }
    }
})

$('#form_sell').on('click',"button.quit_product_sell",function(){   
    $(this).parent().parent().parent().parent().remove();
    var idProduct = $(this).attr("idProduct");


    if(localStorage.getItem('quit_product') == null){
        idQuitProduct = []
    }else{
        idQuitProduct.concat(localStorage.getItem['quit_product'])
    }

    idQuitProduct.push({"idProduct":idProduct})
    localStorage.setItem('quit_product',JSON.stringify(idQuitProduct))

    $('button.rescue_btn[idProduct='+idProduct+']').addClass("btn-primary add_product_to_sell_action")
    sumPrices();
})



/*=============================================
=         Add product to sell(mobile)         =
=============================================*/
$(document).on('click',".add_product_mobile",function(){
    var data = new FormData();
    data.append("allProducts", true);

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
                var data = res.data;
                var options = data.map(function(product){
                    if(product.stock > 0){
                        return `<option value="${product.id}">${product.description}</option>`
                    }
                })


                var productdescription = `
                    <div class="col-xs-12 col-sm-5 mb-xs pr-sm-0">
                        <div class="input-group">
                            <span class="input-group-addon" style="padding:3px">
                                <button 
                                    class="btn btn-danger btn-xs quit_product_sell_mobile" 
                                    idProduct="" 
                                    type="button"
                                >
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                            <select class="form-control new_description_product product_desc" name="addProduct" required>
                            <option value="" disabled selected>Seleccionar Producto</option>
                                ${options.join()} 
                            </select>
                        </div>
                    </div>`
                ;

                var productamount = `
                    <div class="col-xs-6 col-sm-3 productamount">
                        <input  
                            class="form-control "
                            type="number" 
                            name="newAmountProduct"
                            min="1" 
                            value="1" 
                            max=""
                            stock=""
                            required
                        >
                    </div>`
                ;

                var productprice = `
                    <div class="col-xs-6 col-sm-4 productprice pl-sm-0">
                        <div class="input-group">


                            <span class="input-group-addon check">
                              <input type="checkbox" class="" checkbox_target="">
                            </span>
                            
                            <input 
                                checkbox_id=""
                                class="form-control " 
                                type="number"
                                name="newPriceProduct"
                                min=""
                                value="" 
                                step="any"
                                placeholder="000"  
                                readonly
                                required
                            >
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        </div>
                    </div>
                `;

                $(".newProduct").append(`
                    <div class="row" style="padding:5px 5px">
                        ${productdescription} 
                        ${productamount} 
                        ${productprice}
                    </div>
                `);

            }
        }
    })
})

/*=============================================
=        select product to sell(mobile)       =
=============================================*/
$('#form_sell').on('change',"select.new_description_product",function(){
    var idProduct = $(this).val();
    var data = new FormData();
    data.append("idProduct", idProduct);

    selectElement = $(this)
    stockElement = $(this).parent().parent().parent().children('.productamount').children();
    priceElement = $(this).parent().parent().parent().children('.productprice').children().children('input[type=number]');
    checkElement = $(this).parent().parent().parent().children('.productprice').children().children('.check').children('input[type=checkbox]');

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

                selectElement.attr("idProduct",res.data.id)

                stockElement.addClass("product_amount")
                stockElement.prop("max",res.data.stock)
                stockElement.attr("stock",res.data.stock)

                checkElement.addClass("price_checkbox")
                checkElement.attr("checkbox_target",res.data.id)

                priceElement.addClass("product_price")
                priceElement.prop("min",res.data.cost)
                priceElement.val(res.data.sell_price)
                priceElement.attr("checkbox_id",res.data.id)
                priceElement.attr("stock",1)
                priceElement.attr("total",res.data.sell_price)

                sumPrices();

            }
        }
    })

})

/*=============================================
=     Quit product of sell list(mobile)        =
=============================================*/
$('#form_sell').on('click',"button.quit_product_sell_mobile",function(){   
    $(this).parent().parent().parent().parent().remove();
    sumPrices();
})

/*=============================================
=                   SUM PRICES                =
=============================================*/
function sumPrices() {
    
    var itemPrice = $('.product_price')

    var total = 0;
    for (var i = 0; i < itemPrice.length; i++) {

        total += Number($(itemPrice[i]).attr("total"));
        
    }


    var tax=Number( $('#newSellTax').val() )

    $('#newTotalSell').val(total + ( tax/100 * total))
    $('#newTotalSell').number(true,2)
    cashreturn()

}

$('#form_sell').on('change',"input#newSellTax",function(){
    sumPrices();
})


/*=============================================
=              Payment Methods                =
=============================================*/
$('#form_sell').on('change',"#newPaymentMethod",function(){
    var method = $(this).val();

    if(method === "efectivo"){

        $(this).parent().parent().removeClass('col-xs-6')
        $(this).parent().parent().addClass('col-xs-4')
        $(this).parent().parent().parent().children('.newTransactionCode').remove()

        $(this).parent().parent().parent().append(`
            <div class="col-xs-4 deliveredcash" style="padding-left: 0px">
                <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input 
                        type="text"
                        class="form-control"
                        id="delivered_cash"
                        step="any"
                        name="delivered_cash"
                        placeholder="Entregado"

                    >
                </div>
            </div>
            <div class="col-xs-4 changecash" style="padding-left: 0px">
                <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input 
                        type="text"
                        class="form-control"
                        id="change_cash"
                        name="change_cash"
                        placeholder="Devolver"

                    >
                </div>
            </div>
        `)

        $("#delivered_cash").number(true,2);

    }else {
        $(this).parent().parent().removeClass('col-xs-4')
        $(this).parent().parent().addClass('col-xs-6')
        $(this).parent().parent().parent().children('.deliveredcash').remove()
        $(this).parent().parent().parent().children('.changecash').remove()
        $(this).parent().parent().parent().children('.newTransactionCode').remove()

        $(this).parent().parent().parent().append(`
            <div class="col-xs-6 newTransactionCode" style="padding-left: 0px">
                <div class="input-group">
                    <input 
                        type="text"
                        class="form-control"
                        id="newTransactionCode"
                        name="newTransactionCode"
                        placeholder="Código Transacción"
                    >
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
            </div>
        `)
        

    }
})

$('#form_sell').on('change',"#delivered_cash",function(){
    cashreturn()
})


function cashreturn() {

    var cash = Number($('#delivered_cash').val()) || null;
    var total = Number($('#newTotalSell').val() ) || null; 

    if(cash && total){

        if( cash >= total){
    
            $('#change_cash').val(cash - total)
            $('#change_cash').prop('readonly',true)
        } else {
            $('#change_cash').val("Faltan $" + (total-cash))  
            $('#change_cash').prop('readonly',true)
        }  
    }
    
}

/*=============================================
=             SELL PRODUCTS LIST              =
=============================================*/





