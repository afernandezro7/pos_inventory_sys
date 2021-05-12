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

				$response = User::findbyUserName($table, $item, $userName);

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
		if(isset($_POST['userName'])){

		}
	}
	


}