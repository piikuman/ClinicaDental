<?php

function altaUsuario($conexion,$usuario) {
		
	try {
		$consulta = 'CALL INSERTAR_USUARIO(:correo, :pass)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':correo',$usuario["correo"]);
		$stmt->bindParam(':pass',$usuario["password"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}

function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIO WHERE CORREO=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
	
}

function validacionCorreoUsuario($conexion,$correo,$oid) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM USUARIO WHERE CORREO = :CORREO AND OID_USUARIO != :OID_USUARIO)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':CORREO',$correo);
		$stmt->bindParam(':OID_USUARIO',$oid);
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
}

function consultarTodosUsuarios($conexion) {
	$consulta = "SELECT * FROM USUARIO"
		. " ORDER BY OID_USUARIO";
    return $conexion->query($consulta);
}

function getInfoUsuario($conexion, $OID_USUARIO) {
	try {
		$stmt = $conexion -> prepare('SELECT CORREO FROM USUARIO WHERE OID_USUARIO = :OID_USUARIO');
		$stmt -> bindParam(":OID_USUARIO", $OID_USUARIO);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function actualizarUsuario($conexion,$usuario) {
		
	try {
		$consulta = 'CALL ACTUALIZAR_USUARIO(:Oidusuario,:correo, :pass)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidusuario',$usuario["OID_USUARIO"]);
		$stmt->bindParam(':correo',$usuario["correo"]);
		$stmt->bindParam(':pass',$usuario["password"]);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function eliminarUsuario($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_USUARIO(:Oidusuario)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidusuario',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}