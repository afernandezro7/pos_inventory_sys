<?php

class UsersController{

	/**
	*
	* LOGIN
	*
	*/
	static public function ctrLoginUser(){
		if(isset($_POST['userName'])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['userName']) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST['password']) )
			{ 
				$table = "users";
				$item  = "userName";
				$userName = $_POST['userName'];
				$password = $_POST['password'];

				$response = User::find($table, $userName, $item);

				if($response["userName"] == $userName && $response["password"]== $password){
					$_SESSION["logged"] = "ok";
					echo "<script>window.location='inicio'</script>";
				} else {
					echo "<br><div class='alert alert-danger'>Usuario y/o contraseña no válido</div>";
				};
			}
		}

	}
	

	/**
	*
	* CREATE NEW USER
	*
	*/
	static public function ctrAddUser(){
		if(isset($_POST['name']) && 
		isset($_POST['userName']) && 
		isset($_POST['role']) && 
		isset($_POST['password']))
		{
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['userName']) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['name']) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST['password']) )
			{ 
				$table ="users";
				$name = $_POST['name'];
				$userName = $_POST['userName'];
				$role = $_POST['role'];
				$password = $_POST['password'];
				$avatar = null;

				if(isset($_POST['avatar'])){

				}

				$data = array(
					"name"=>$name,
					"userName"=>$userName,
					"role"=>$role,
					"password"=>$password,
					"avatar"=>$avatar,
				);

				$response = User::createUser($table, $data);
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
							window.location = 'usuarios';
						}
					});
				</script>";
			} else {
				echo "<script>
					swal({
						type: 'error',
						title: 'El usuario no puede ir vacío o llevar caracteres especiales',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'usuarios';
						}
					});
				</script>";
			}
		}
	}
	


}