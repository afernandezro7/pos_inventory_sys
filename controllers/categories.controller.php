<?php

class CategoriesController{

	static public function ctrAddCategory(){
		if(isset($_POST['categoryName'])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['categoryName']) && 
			  !empty($_POST['categoryName']))
			{
				$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador","Gestor"]);				
				if($permission == false){
					echo "<script>
					swal({
						type: 'error',
						title: 'No está autorizado a crear categorías',
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

				$categoryName = $_POST['categoryName'];
				$data = array(
					"name"=>$categoryName
				);

				$response = Category::createCategory($data);
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
							window.location = 'categorias';
						}
					});
				</script>";

			}else {
				echo "<script>
					swal({
						type: 'error',
						title: 'La Categoría no puede ir vacía o llevar carácteres especiales',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'categorias';
						}
					});
				</script>";
			}
		}
	}	

	static public function ctrListCategories(){
		$categories = Category::findAll();
		return $categories;
	}


}