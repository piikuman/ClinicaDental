<?php
  
 function altaDoctora($conexion,$usuario,$especialidad) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($usuario["fechaAlta"]));
	
	try {
		$consulta = 'CALL INSERTAR_DOCTORA(:nombre, :ape, :dni, :fec, :poblacion, :dir, :fecA, :tel, :sueldo, :codigoDoctora, :oid_especialidad)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':dir',$usuario["direccion"]);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':tel',$usuario["telefono"]);
		$stmt->bindParam(':sueldo',$usuario["sueldo"]);
		$stmt->bindParam(':codigoDoctora', $usuario["codigoDoctora"]);
		$stmt->bindParam(':oid_especialidad', $especialidad);
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
 
 function getInfoDoctora($conexion, $CODIGODOCTORA) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE, APELLIDOS, DNI, DIRECCION, POBLACION, FECHA_NACIMIENTO, TELEFONO, FECHAALTA, SUELDO FROM DOCTORA WHERE CODIGODOCTORA = :CODIGODOCTORA');
		$stmt -> bindParam(":CODIGODOCTORA", $CODIGODOCTORA);
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
		$consulta = 'CALL ACTUALIZAR_DOCTORA(:nombre, :ape, :dni, :fec, :poblacion, :dir, :fecA, :tel, :sueldo, :codigoDoctora)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$doctora["nombre"]);
		$stmt->bindParam(':ape',$doctora["apellidos"]);
		$stmt->bindParam(':dni',$doctora["dni"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':poblacion',$doctora["poblacion"]);
		$stmt->bindParam(':dir',$doctora["direccion"]);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':tel',$doctora["telefono"]);
		$stmt->bindParam(':sueldo',$doctora["sueldo"]);
		$stmt->bindParam(':codigoDoctora', $doctora["codigoDoctora"]);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
 
 function eliminarDoctora($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_DOCTORA(:codigoDoctora)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':codigoDoctora',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
?>