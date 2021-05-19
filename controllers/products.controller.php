<?php

class ProductsController{

	static public function ctrListProducts(){
		$products = Product::findAll();
		return $products;
	}	

	static public function ctrAddProduct(){
			/*POST */
		// newProductCategory
		// newBarcode
		// newStock
		// newDescription
		// newCostPrice
		// newSellPrice
		// newImageProduct

		if(isset($_POST['newDescription'])){
			if(!empty($_POST['newProductCategory']) && preg_match('/^[0-9]+$/', $_POST['newProductCategory']) &&
			   !empty($_POST['newBarcode']) &&
			   !empty($_POST['newStock']) && preg_match('/^[0-9]+$/', $_POST['newStock']) &&
			   !empty($_POST['newDescription']) &&
			   !empty($_POST['newCostPrice']) && filter_var($_POST['newCostPrice'], FILTER_VALIDATE_FLOAT) &&
			   !empty($_POST['newSellPrice']) && filter_var($_POST['newSellPrice'], FILTER_VALIDATE_FLOAT) )			  
			{				

				$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador", "Gestor"]);				
				if($permission == false){
					echo "<script>
					swal({
						type: 'error',
						title: 'No está autorizado a crear productos',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
					}).then((res)=>{
						if(res.value){
							window.location = 'usuarios';
						}
					});
					</script>";
					
					return false;
				}

				$categoryId = $_POST['newProductCategory'];
				$barcode = $_POST['newBarcode'];
				$description = $_POST['newDescription'];
				$stock = $_POST['newStock'];
				$cost = $_POST['newCostPrice'];
				$sellPrice = $_POST['newSellPrice'];

				$data = array(
					"category_id"=>$categoryId,
					"barcode"=>$barcode,
					"description"=>$description,
					"image"=>"",
					"stock"=>$stock,
					"cost"=>$cost,
					"sell_price"=>$sellPrice,
				);

				if(isset($_FILES['newImageProduct']['tmp_name']) && $_FILES['newImageProduct']['tmp_name'] != ""){
					
					$file = $_FILES['newImageProduct'];
					$dir = "views/img/products/";
					$imgName = $barcode;

					$data['image']  = Helpers::processImage($file, $dir, $imgName);
				}

				$response = Product::createProduct($data);
				$type = $response['type'];
				$msg = $response['msg'];

				echo "<script>
					swal({
						type: '".$type."',
						title: '".$msg."',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'productos';
						}
					});
				</script>";

			} else {
				echo "<script>
					swal({
						type: 'error',
						title: 'hola',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
					 }).then((res)=>{
						if(res.value){
							window.location = 'productos';
						}
					});
				</script>";
			}
		}
	}	

	static public function ctrEditProduct(){
			/*POST */
		// editProductId
		// editCategoryproduct
		// editBarcode
		// editStock
		// editDescription
		// editCostPrice
		// editSellPrice
		// editImageProduct
		if(isset($_POST['editProductId'])){

			$productId = $_POST['editProductId'];
			$producDb= Product::findOne("id",$productId);
			$editProduct = $producDb;

			//verify permission
			$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador","Gestor"]);
			if($permission == false){
				echo "<script>
					swal({
						type: 'error',
						title: 'No está autorizado a editar los usuarios',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'categorias';
						}
					});
				</script>";

				return false;
			}

			//verify if product exists
			if($producDb){
				// EDIT stock
				if(isset($_POST['editStock']) && 
				  !empty($_POST['editStock']) && 
				   preg_match('/^[0-9]+$/', $_POST['editStock']))
				{
					$editProduct['stock'] = $_POST['editStock'];
				}

				// EDIT description
				if(isset($_POST['editDescription']) && !empty($_POST['editDescription']))
				{
					$editProduct['description'] = $_POST['editDescription'];
				}

				// EDIT cost
				if(isset($_POST['editCostPrice']) && 
				  !empty($_POST['editCostPrice']) && 
				  filter_var($_POST['editCostPrice'], FILTER_VALIDATE_FLOAT))
				{
					$editProduct['cost'] = $_POST['editCostPrice'];
				}

				// EDIT sell_price
				if(isset($_POST['editSellPrice']) && 
				  !empty($_POST['editSellPrice']) && 
				  filter_var($_POST['editSellPrice'], FILTER_VALIDATE_FLOAT))
				{
					$editProduct['sell_price'] = $_POST['editSellPrice'];
				}

				// EDIT avatar
				if(isset($_FILES['editImageProduct']['tmp_name']) && $_FILES['editImageProduct']['tmp_name'] != "")
				{
					//DELETE old avatar file
					$oldUrlPath = $producDb['image'];
					if($oldUrlPath){
						unlink ( $oldUrlPath );
					}

					$file = $_FILES['editImageProduct'];
					$dir = "views/img/products/";
					$imgName = $editProduct['barcode'];

					$editProduct['image'] = Helpers::processImage($file, $dir, $imgName);				
				}

				$response = Product::editProduct($editProduct);
				$type = $response['type'];
				$msg = $response['msg'];

				echo "<script>
					swal({
						type: '".$type."',
						title: '".$msg."',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'productos';
						}
					});
				</script>";

			}else{
				echo "<script>
					swal({
						type: 'error',
						title: 'Producto no encontrado, error al editarlo'
			 		}).then((res)=>{
						if(res.value){
							window.location = 'productos';
						}
					});
				</script>";
			}
		}
	}
}