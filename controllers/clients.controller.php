<?php

class ClientsController{

	static public function ctrAddClient(){
			/*POST */
		// newClientName
		// newClientIdentity
		// newClientEmail
		// newClientPhone
		// newClientAddress
		// newClientBirthDate
		if(isset($_POST['newClientName'])){
			if(!empty($_POST['newClientName']) && 
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚü ]+$/', $_POST['newClientName']))
			{
				$name = $_POST['newClientName'];
				$identity = isset($_POST['newClientIdentity']) ? $_POST['newClientIdentity'] : null;
				$email = isset($_POST['newClientEmail']) ? $_POST['newClientEmail'] : null;
				$phone = isset($_POST['newClientPhone']) ? $_POST['newClientPhone'] : null;
				$address = isset($_POST['newClientAddress']) ? $_POST['newClientAddress'] : null;
				$birth = isset($_POST['newClientBirthDate']) ? $_POST['newClientBirthDate'] : null;

				$data = array(
					"name"=>$name,
					"identity"=>$identity,
					"email"=>$email,
					"phone"=>$phone,
					"address"=>$address,
					"birth"=>$birth
				);

				$response = Client::createClient($data);
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
						title: 'El nombre no puede estar vacío ni contener caracteres especiales',
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


}