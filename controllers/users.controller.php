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

				//encrypt password			
				$cryptPassword = User::cryptPassword($password);

				if($response["userName"] == $userName && 
				   $response["password"] == $cryptPassword &&
				   $response["status"] == 1)
				{
					$_SESSION["logged"] = "ok";
					$_SESSION["user"] = array(
						'id' => $response["id"],
						'name' => $response["name"],
						'userName' => $response["userName"],
						'role' => $response["role"],
						'avatar' => $response["avatar"],
						'status' => $response["status"],
						'lastLogin' => $response["lastLogin"],
						'createdAt' => $response["createdAt"]
					);
					echo "<script>window.location='inicio'</script>";
				} else {
					if($response["userName"] == $userName && 
				       $response["password"] == $cryptPassword &&
				       $response["status"] == 0){
						//User is disabled
						echo "<br><div class='alert alert-danger'>Usuario desactivado comuníquese con un administrador</div>";
					}else{
						//User or password is incorrect
						echo "<br><div class='alert alert-danger'>Usuario y/o contraseña no válido</div>";
					}
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
				
				
				$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador"]);
				
				if($permission == false){
					echo "<script>
					swal({
						type: 'error',
						title: 'Sólo el Administrador puede crear usuarios',
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

				$table ="users";
				$name = $_POST['name'];
				$userName = $_POST['userName'];
				$role = $_POST['role'];
				$password = $_POST['password'];
				$avatar = "";

				//encrypt password			
				$cryptPassword = User::cryptPassword($password);

				$data = array(
					"name"=>$name,
					"userName"=>$userName,
					"role"=>$role,
					"password"=>$cryptPassword,
					"avatar"=>$avatar,
				);

				if(isset($_FILES['avatar']['tmp_name']) && $_FILES['avatar']['tmp_name'] != ""){
					
					$file = $_FILES['avatar'];
					$dir = "views/img/users/";
					$imgName = $data['userName'];

					$data['avatar']  = Helpers::processImage($file, $dir, $imgName);
				}

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
	

	/**
	*
	* Edit USER
	*
	*/
	static public function ctreditUser(){
		if(isset($_POST['editId']))
		{

			$table ="users";
			$userId = $_POST['editId'];
			$userDb= User::find($table,$userId,"id");
			$editUser = $userDb;

			//verify permission
			$permission = Helpers::getPermission($_SESSION['user']['role'],["Administrador"]);
			if($permission == false){
				echo "<script>
					swal({
						type: 'error',
						title: 'Sólo el Administrador puede editar los usuarios',
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

			//verify if user already exists
			if($userDb){
				// EDIT name
				if(isset($_POST['editName']) && 
				  !empty($_POST['editName']) && 
				   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editName']))
				{
					$editUser['name'] = $_POST['editName'];
				}

				//EDIT userName
				if(isset($_POST['editUserName']) && 
				  !empty($_POST['editUserName']) &&
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST['editUserName']))
				{
					$editUser['userName'] = $_POST['editUserName'];
				}

				// EDIT password
				if(isset($_POST['editPassword']) && 
				  !empty($_POST['editPassword']) &&
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST['editPassword']))
				{
					//encrypt password			
					$cryptPassword = User::cryptPassword($_POST['editPassword']);
					$editUser['password'] = $cryptPassword;
				}

				// EDIT role
				if(isset($_POST['editRole']))
				{
					$editUser['role'] = $_POST['editRole'];
				}

				// EDIT avatar
				if(isset($_FILES['editAvatar']['tmp_name']) && $_FILES['editAvatar']['tmp_name'] != "")
				{
					//DELETE old avatar file
					$oldUrlPath = $userDb['avatar'];
					if($oldUrlPath){
						unlink ( $oldUrlPath );
					}

					$file = $_FILES['editAvatar'];
					$dir = "views/img/users/";
					$imgName = $editUser['userName'];

					$editUser['avatar'] = Helpers::processImage($file, $dir, $imgName);

					
				}

				$response = User::editUser($table, $editUser);
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


			}else{
				echo "<script>
					swal({
						type: 'error',
						title: 'Usuario no encontrado',
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

	/**
	*
	* USERS LIST
	*
	*/
	static public function ctrUsersList(){
		$users = User::findAll();
		return $users;
	}

}