<?php

function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE USER=:user AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':user',$user);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

?>