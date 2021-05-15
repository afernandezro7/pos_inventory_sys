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

	static public function ctrEditCategory(){
		if(isset($_POST['editCategoryId']))
		{
			$categoryId = $_POST['editCategoryId'];
			$categoryDb= Category::findOne($categoryId,"id");
			$editcategory = $categoryDb;

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

			//verify if category already exists
			if($categoryDb){
				// EDIT name
				if(isset($_POST['editCategoryName']) && 
				  !empty($_POST['editCategoryName']) && 
				   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editCategoryName']))
				{
					$editcategory['name'] = $_POST['editCategoryName'];
				}

				$response = Category::editCategory($editcategory);
				$type = $response['type'];
				$msg = $response['msg'];

				echo "<script>
					swal({
						type: '".$type."',
						title: '".$msg."',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'categorias';
						}
					});
				</script>";



			}else{
				echo "<script>
					swal({
						type: 'error',
						title: 'Categoría no encontrada',
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

	static public function ctrDeleteCategory(){
		if(isset($_GET['idTodelete'])){
			$idCategory = $_GET['idTodelete'];

			//verify permission
			$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador", "Gestor"]);
			if($permission == false){
				echo "<script>
					swal({
						type: 'error',
						title: 'No está autorizado a eliminar categorías',
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
				//Redirect to Dashboard page
				echo "<script>window.location='categorias'</script>";

			}

			$categoryDb = Category:: findOne( $idCategory, "id" );

			if(is_array($categoryDb)){
				$response = Category::deleteCategory("id", $idCategory);
				echo "<script>
				swal({
					type: '".$response['type']."',
					title: '".$response['msg']."',
					showConfirmButton: true,
					confirmButtonText: 'cerrar',
					closeOnConfirm: false
				 }).then((res)=>{
					if(res.value){
						window.location = 'categorias';
					}
				});
				</script>";
			}else{
				echo "<script>
				swal({
					type: 'error',
					title: 'No se encontró la categoría',
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
}