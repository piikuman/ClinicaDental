<?php
	session_start();
	
	$poblaciones=array('CD' => 'Cádiz', 'SV' => 'Sevilla', 'MA'=>'Málaga', 'HU' => 'Huelva', 'CO'=>'Córdoba', 
					'JA'=>'Jaén', 'AL'=>'Almería', 'GR'=>'Granada', 'OT'=>'Otro');


	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	} else 
		Header("Location: formularioPaciente.php");	

	// Obtener el nombre completo de la población mediante un array
	function getPoblacion($abreviatura){
		global $poblaciones;
		if(isset($poblaciones[$abreviatura])){
			return $poblaciones[$abreviatura];
		}else{
			return "No existe la población". $abreviatura;
	}}

	// Función para formatear una fecha al formato de Oracle
	function getFechaFormateada($fecha){
		$fechaNacimiento = date('d/m/Y', strtotime($fecha));
		return $fechaNacimiento;
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de biblioteca: Alta de Usuario</title>
</head>

<body>
<?php
		include_once("cabecera.php");
	?>
	<main>
		<h1>Datos de  <?php echo $nuevoUsuario["nombre"]; ?></h1>
			<div id="div_volver">	
			   Pulsa <a href="formularioPaciente.php">aquí</a> para volver al formulario de altas de usuarios.
			</div>
			
			<h2>El paciente <?php echo $nuevoUsuario["nombre"]; ?> ha sido dado de alta con éxito con los siguientes datos:</h2>
			<ul>
				<li><?php echo "NIF: " . $nuevoUsuario["nif"]; ?></li>
				<li><?php echo "Nombre: " . $nuevoUsuario["nombre"]; ?></li>
				<li><?php echo "Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
				<li><?php echo "Correo: " . $nuevoUsuario["correo"]; ?></li>
				<li><?php echo "Fecha de Nacimiento: " . getFechaFormateada($nuevoUsuario["fechaNacimiento"]); ?></li>
				<li><?php echo "Fecha de Alta: " . getFechaFormateada($nuevoUsuario["fechaAlta"]); ?></li>
				<li><?php echo "Direccion: " . $nuevoUsuario["direccion"]; ?></li>
				<li><?php echo "Poblacion: " . getPoblacion($nuevoUsuario["poblacion"]);?></li>
				<li><?php echo "Seguro: " . $nuevoUsuario["seguro"]; ?></li>
				<li><?php
				if($nuevoUsuario["nombreTutor"]!=""){	
					echo "Nombre tutor: " . $nuevoUsuario["nombreTutor"];
				}
				;?></li>
				<li><?php
				if($nuevoUsuario["telefonoTutor"]!=""){	
					echo "Telefono tutor: " . $nuevoUsuario["telefonoTutor"];
				}
				?></li>
			</ul>

</main>
<?php
		include_once("pie.php");
	?>
</body>
</html>