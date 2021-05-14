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

				if(isset($_FILES['avatar']['tmp_name']) ){
					$file = $_FILES['avatar'];

					//cut image to 500x500
					list($width,$height) = getimagesize($file['tmp_name']);
					$newWidth = 500;
					$newHeight = 500;

					$path="";

					if($file['type'] == "image/jpeg"){
						$path = "views/img/users/".$userName.".jpg";

						$origin = imagecreatefromjpeg($file['tmp_name']);
						$destiny = imagecreatetruecolor($newWidth,$newHeight);

						imagecopyresized($destiny, $origin, 0 , 0 , 0, 0, $newWidth, $newHeight, $width, $height );

						imagejpeg($destiny, $path);
					}

					if($file['type'] == "image/png"){
						$path = "views/img/users/".$userName.".png";

						$origin = imagecreatefrompng($file['tmp_name']);
						$destiny = imagecreatetruecolor($newWidth,$newHeight);

						imagecopyresized($destiny, $origin, 0 , 0 , 0, 0, $newWidth, $newHeight, $width, $height );

						imagepng($destiny, $path);
					}

					$data['avatar'] = $path;

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
	* CREATE NEW USER
	*
	*/
	static public function ctreditUser(){
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

				if(isset($_FILES['avatar']['tmp_name']) ){
					$file = $_FILES['avatar'];

					//cut image to 500x500
					list($width,$height) = getimagesize($file['tmp_name']);
					$newWidth = 500;
					$newHeight = 500;

					$path="";

					if($file['type'] == "image/jpeg"){
						$path = "views/img/users/".$userName.".jpg";

						$origin = imagecreatefromjpeg($file['tmp_name']);
						$destiny = imagecreatetruecolor($newWidth,$newHeight);

						imagecopyresized($destiny, $origin, 0 , 0 , 0, 0, $newWidth, $newHeight, $width, $height );

						imagejpeg($destiny, $path);
					}

					if($file['type'] == "image/png"){
						$path = "views/img/users/".$userName.".png";

						$origin = imagecreatefrompng($file['tmp_name']);
						$destiny = imagecreatetruecolor($newWidth,$newHeight);

						imagecopyresized($destiny, $origin, 0 , 0 , 0, 0, $newWidth, $newHeight, $width, $height );

						imagepng($destiny, $path);
					}

					$data['avatar'] = $path;

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
	* USERS LIST
	*
	*/
	static public function ctrUsersList(){
		$users = User::findAll();
		return $users;
	}

}