<?php
  
 function alta_usuario($conexion,$usuario) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($usuario["fechaAlta"]));
	
	try {
		$consulta = 'CALL INSERTAR_PACIENTE(:nombre, :ape, :dni, :fec, :correo, :poblacion, :dir, :fecA, :seguro, :nTutor, :tTutor)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':correo',$usuario["correo"]);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':dir',$usuario["direccion"]);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':seguro',$usuario["seguro"]);
		$stmt->bindParam(':nTutor',$usuario["nombreTutor"]);
		$stmt->bindParam(':tTutor',$usuario["telefonoTutor"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}
?>