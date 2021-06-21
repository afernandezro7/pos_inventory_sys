<?php

class SellsController{

	static public function getSellcode(){

		$response = Sell::getLastSellCode();

		if(is_array($response) && !empty($response['sell_code'])){

			$next_sell_code = intval($response['sell_code'])+1;
			return Helpers::sellCodeViewGenerator($next_sell_code);

		}else {
			
			return Helpers::sellCodeViewGenerator(1);

		}

	}	

	static public function ctrListSells(){
		$sells = Sell::findAllBasic();
		return $sells;
	}

	static public function ctrAddSell(){
		//vendor
		//newSellCode
		//selectClientSell -->idclient

		// itemAmount
		//addProductSell
		// newAmountProduct
		// newPriceProduct
		
		//newTransactionCode

		// newSellTax
		// newNetTotalSell
		// newTotalSell
		// newPaymentMethod

		if(isset($_POST['newSellCode']) && isset($_POST['itemAmount']) && $_POST['itemAmount'] > 0){

			if(!empty($_POST['selectClientSell']) &&
			   !empty($_POST['newSellCode']) &&
			   !empty($_POST['newPaymentMethod']) &&			
			   !empty($_POST['newNetTotalSell']) &&
			   !empty($_POST['newTotalSell']) )
			{
				$sell_code = Helpers::sellCodeDecoer($_POST['newSellCode']);
				$client_id = intval($_POST['selectClientSell']);
				$vendor_id = intval($_SESSION['user']['id']);
				$taxes = floatval(empty($_POST['newSellTax']) ? 0 : $_POST['newSellTax']);
				$net_price = floatval($_POST['newNetTotalSell']);
				$total_price = floatval($_POST['newTotalSell']);
				$payment_method = $_POST['newPaymentMethod'];
				$productListAmount = intval($_POST['itemAmount']);

				// var_dump($payment_method);
				// var_dump($total_price);
				// die();
				

				if($payment_method != "efectivo"){
					$payment_method .= "-".$_POST['newTransactionCode'];
				}

				$data = array(
					'sell_code'=>$sell_code,
					'client_id'=>$client_id,
					'vendor_id'=>$vendor_id,
					'taxes'=>$taxes,
					'net_price'=>$net_price,
					'total_price'=>$total_price,
					'payment_method'=>$payment_method,
				);

				$response = Sell::createSell($data);
				$type = $response['type'];
				$msg = $response['msg'];
				$location = 'crear-venta';
				

				
				
				if($response['ok']){
					$sell_id = Sell::findOne('sell_code',$sell_code)['id'];
					

					if($productListAmount > 0){
						
						$error = false;
						$produductInventory=[];
						
						for ($i=1; $i < $productListAmount+1; $i++) { 
							$product_id = intval($_POST['addProductSell'.$i]) ;
							$units = intval($_POST['newAmountProduct'.$i]);
							$price = floatval($_POST['newPriceProduct'.$i]);
							

							$productdata = array(
								'sell_id'=>$sell_id,
								'product_id'=>$product_id,
								'units'=>$units,
								'price'=>$price
							);

							$res = Sell::createSellProducts($productdata);

							if($res['ok'] == false){
								$error = true;
							}

							$produductInventory[$product_id] = $units;
						}
						

						if ($error) {
							// DELETE PRODUCT_SELL TRASH
							Sell::deleteSellItems('sells','id',$sell_id);	
							$type = 'error';
							$msg = 'Error registrando productos en la venta';
						}else{
							$location = "ventas";
							foreach ($produductInventory as $key => $val) { 
								//REduce Inventory, add buy to client and add sell record to product
								Product::alterInventory( intval($key), $val, 'reduce' );
								Client::editUnitsBought( $client_id, $val, 'increse');
							}
						}


						
					}else{
						// TODO DELETE SELL TRASH
						Sell::deleteSellItems('sells','id',$sell_id);
						$type = 'error';
						$msg = 'La factura no puede estar vacía';

					}
					

				}

				echo "<script>
					swal({
						type: '".$type."',
						title: '".$msg."',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
					 }).then((res)=>{
						if(res.value){
							window.location = '".$location."';
						}
					});
				</script>";

			}else {

				echo "<script>
					swal({
						type: 'error',
						title: 'Error al crear la venta',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
					 }).then((res)=>{
						if(res.value){
							window.location = 'crear-venta';
						}
					});
				</script>";
			}
		}
	}

	static public function ctrDeleteSell(){
		if(isset($_GET['idTodelete'])){
			$idSell = intval($_GET['idTodelete']);

			//verify permission
			$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador", "Gestor"]);
			if($permission == false){
				echo "<script>
					swal({
						type: 'error',
						title: 'No está autorizado a eliminar productos',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'ventas';
						}
					});
				</script>";

				return false;
				//Redirect to Dashboard page
				echo "<script>window.location='ventas'</script>";

			}

			$sellDb = Sell:: findOne( "id", $idSell );
			
			if(is_array($sellDb)){
				$sellItems = Sell::findAllSellItems($idSell);
				$client_id = intval($sellDb['client_id']);
				
				foreach ($sellItems as $sellItem) { 
					//Increse Inventory, reduce sells of product, reduce bought of client
					$prod_id = intval($sellItem['product_id']);
					$prod_units = intval($sellItem['units']);
					

					Product::alterInventory( $prod_id, $prod_units, "increse" );
					Client::editUnitsBought( $client_id, $prod_units, "reduce");
					// var_dump($prod_id);
					// var_dump($prod_units);
				}

				
				// die();
				$resp = Sell::deleteSellsById($idSell);

				echo "<script>
				swal({
					type: '".$resp['type']."',
					title: '".$resp['msg']."',
					showConfirmButton: true,
					confirmButtonText: 'cerrar',
					closeOnConfirm: false
				 }).then((res)=>{
					if(res.value){
						window.location = 'ventas';
					}
				});
				</script>";

			} else {
				echo "<script>
				swal({
					type: 'error',
					title: 'No se encontró la venta',
					showConfirmButton: true,
					confirmButtonText: 'cerrar',
					closeOnConfirm: false
				 }).then((res)=>{
					if(res.value){
						window.location = 'ventas';
					}
				});
				</script>";
			}
			
		}
	}

	static public function getSellInfo($idSell){
		$idSell = intval($idSell);

		$sell = Sell::findOneAdvace('id', $idSell);
		$items = array('items' => Sell::findAllSellItems($idSell));
		
		if(is_array($sell) && is_array($items)){
			$data = array_merge($sell, $items);

			return $data;
		}

		return false;

		
		
	}

}