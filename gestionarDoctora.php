<?php
  
 function altaDoctora($conexion,$usuario) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($usuario["fechaAlta"]));
	
	try {
		$consulta = 'CALL INSERTAR_DOCTORA(:nombre, :ape, :dni, :dir, :poblacion, :fec, :fecA, :tel, :sueldo,:codigoDoctora)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':tel',$usuario["telefono"]);
		$stmt->bindParam(':sueldo',$usuario["sueldo"]);
		$stmt->bindParam(':codigoDoctora', $usuario["codigoDoctora"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}
 
 function consultarTodasDoctoras($conexion) {
	$consulta = "SELECT * FROM DOCTORA"
		. " ORDER BY APELLIDOS, NOMBRE";
    return $conexion->query($consulta);
}
 
 function getInfoDoctora($conexion, $OID_DOCTORA) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE, APELLIDO, DNI, DIRECCION, POBLACION, FECHA_NACIMIENTO,FECHAALTA, TELEFONO, SUELDO, CODIGODOCTORA FROM DOCTORA WHERE OID_DOCTORA = :OID_DOCTORA');
		$stmt -> bindParam(":OID_DOCTORA", $OID_DOCTORA);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
 }
 
 function actualizarDoctora($conexion,$doctora) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($doctora["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($doctora["fechaAlta"]));
	
	try {
		$consulta = 'CALL ACTUALIZAR_DOCTORA(:Oiddoctora,:nombre, :ape, :dni, :dir, :poblacion, :fec, :fecA, :tel, :sueldo,:codigoDoctora)';
		$stmt=$conexion->prepare($doctora);
		$stmt->bindParam(':Oiddoctora',$doctora["OID_DOCTORA"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':tel',$usuario["telefono"]);
		$stmt->bindParam(':sueldo',$usuario["sueldo"]);
		$stmt->bindParam(':codigoDoctora', $usuario["codigoDoctora"]);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
 
 function eliminarDoctora($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_DOCTORA(:Oiddoctora)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oiddoctora',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
?>