<?php
  
 function altaDoctora($conexion,$usuario) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($usuario["fechaAlta"]));
	
	try {
		$consulta = 'CALL INSERTAR_PACIENTE(:nombre, :ape, :dni, :dir, :poblacion, :fec, :fecA, :tel, :sueldo)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':tel',$usuario["telefono"]);
		$stmt->bindParam(':sueldo',$usuario["sueldo"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}
?>