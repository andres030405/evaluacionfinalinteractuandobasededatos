<?php
	require('conector.php');
	$con = new conectorBD();

	$response['conexion'] = $con->initConexion($con->database);
	if ($response['conexion'] == 'OK'){
		$conexion = $con->getConexion();
		$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha_nacimiento) VALUES (?,?,?,?)');
		$insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

		$d_password = "123facilito";
		$email = "andres.nextu@gmail.com";
		$nombre = "andres";
		$password = password_hash($d_password, PASSWORD_DEFAULT);
		$fecha_nacimiento = "1997-08-07";

		$insert->execute();

		$email = 'prueba3@gmail.com';
		$nombre = 'prueba3';
		$password = password_hash($d_password, PASSWORD_DEFAULT);
		$fecha_nacimiento = '1997-12-03';

		$insert->execute();

		$email = 'prueba4@mail.com';
		$nombre = 'prueba4';
		$password = password_hash($d_password, PASSWORD_DEFAULT);
		$fecha_nacimiento = '1999-01-04';

		$insert->execute();
		$response['resultado'] = "1";
		$response['msg']= 'Informacio de inicio:';
		$getUsers = $con->consultar(['usuarios'],['*'],$condicion = "");
		while ($fila= $getUsers->fetch_assoc()) {
			$response['msg'].=$fila['email'];
		}
		$response['msg'].= 'contraenia: '.$d_password;
		}else{
			$response['resultado'] == "0";
			$response['msg'] = 'No se pudo conectar a la base de datos';
		}

		echo json_encode($response);

 ?>
