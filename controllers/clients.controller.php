<?php

class ClientsController{

	static public function ctrListClients(){
		$clients = Client::findAll();
		return $clients;
	}

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
							window.location = 'clientes';
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
							window.location = 'clientes';
						}
					});
				</script>";
			}
		}
	}

	static public function ctrEditClient(){
		/*POST */
	// editClientId
	// editClientName
    // editClientIdentity
    // editClientEmail
    // editClientPhone
    // editClientAddress

    // editClientBirthDate
	if(isset($_POST['editClientId'])){

		$clientId = $_POST['editClientId'];
		$clientDb= Product::findOne("id",$clientId);
		$editClient = $clientDb;

		//verify if product exists
		if($clientDb){

			// EDIT name
			if(isset($_POST['editClientName']) && 
			  !empty($_POST['editClientName']) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚü ]+$/', $_POST['editClientName']))
			{
				$editClient['name'] = $_POST['editClientName'];
			}

			// EDIT identity
			if(isset($_POST['editClientIdentity']) && !empty($_POST['editClientIdentity']))
			{
				$editClient['identity'] = $_POST['editClientIdentity'];
			}
			
			// EDIT email
			if(isset($_POST['editClientEmail']) && 
			!empty($_POST['editClientEmail']) && 
			filter_var($_POST['editClientEmail'], FILTER_VALIDATE_EMAIL))
			{
				$editClient['email'] = $_POST['editClientEmail'];
			}
			
			// EDIT phone
			if(isset($_POST['editClientPhone']) && !empty($_POST['editClientPhone']))
			{
				$editClient['phone'] = $_POST['editClientPhone'];
			}

			// EDIT address
			if(isset($_POST['editClientAddress']) && !empty($_POST['editClientAddress']))
			{
				$editClient['address'] = $_POST['editClientAddress'];
			}

			// EDIT birth
			if(isset($_POST['editClientBirthDate']) && !empty($_POST['editClientBirthDate']))
			{
				$editClient['address'] = $_POST['editClientBirthDate'];
			}
		
			$response = Client::editClient($editClient);
			$type = $response['type'];
			$msg = $response['msg'];

			echo "<script>
				swal({
					type: '".$type."',
					title: '".$msg."',
					closeOnConfirm: false
				 }).then((res)=>{
					if(res.value){
						window.location = 'clientes';
					}
				});
			</script>";

		}else{
			echo "<script>
				swal({
					type: 'error',
					title: 'Cliente no encontrado, error al editarlo'
				 }).then((res)=>{
					if(res.value){
						window.location = 'clientes';
					}
				});
			</script>";
		}
	}
}


}