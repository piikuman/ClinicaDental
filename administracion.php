<?php
	session_start();
	
	if (!isset($_SESSION['login']))
		Header("Location: login.php");
	else if("admin" != $_SESSION['login']){
		Header("Location: inicio.php");
	}
	
	require_once("gestionBD.php");
	require_once("gestionarUsuario.php");
	require_once("gestionarCitas.php");
	require_once("gestionarPaciente.php");
	require_once("gestionarTratamientos.php");
	require_once("gestionarDoctora.php");
	require_once("gestionarEspecialidad.php");
	require_once("paginacionConsulta.php");
	
	if (isset($_SESSION["paginacion"])){
		$paginacion = $_SESSION["paginacion"];
	}
	
	$paginaSeleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pagTam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 3);

	if ($paginaSeleccionada < 1){
		$paginaSeleccionada = 1;
	}	
	if ($pagTam < 1){
		$pagTam = 3;
	}
	
	unset($_SESSION["paginacion"]);
	
	$conexion = crearConexionBD();
	$query = "SELECT * FROM USUARIO ORDER BY OID_USUARIO, CORREO";
	$totalPacientes = totalConsulta($conexion, $query);
	$totalPaginas = (int)($totalPacientes / $pagTam);

	if ($totalPacientes % $pagTam > 0){
		$totalPaginas++;
	}	

	if ($paginaSeleccionada > $totalPaginas){
		$paginaSeleccionada = $totalPaginas;
	}	

	$paginacion["PAG_NUM"] = $paginaSeleccionada;
	$paginacion["PAG_TAM"] = $pagTam;
	$_SESSION["paginacion"] = $paginacion;

	$usuarios = consultaPaginada($conexion, $query, $paginaSeleccionada, $pagTam);
	$tratamientos= consultarTotalT($conexion);
	$pacientes= consultarTotalP($conexion);
	$citas= consultarTotalC($conexion);
	$especialidad= consultarTotalE($conexion);
	$doctoras= consultarTotalD($conexion);
	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Administracion</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<div class="informacion">
	<a class="add" href="formularioUsuario.php">Añadir Usuario</a>
	<br/>
	<div class="col-5 col-tab-5">
	<table>
	  <tr>
	    <th>Código</th>
    	<th>Correo</th>
	  </tr>
  	 <?php
			foreach($usuarios as $usuario){
		?>
  	  <tr>
  	  	<form id='formMostrarUsuarios' method='POST' action='mostrarUsuario.php' >
			<input type='hidden' name='OID_USUARIO' value='<?php echo $usuario["OID_USUARIO"]?>'>
	    <th><input class="codigo" type='submit' value='<?php echo $usuario["OID_USUARIO"]; ?>'></th>
		</form>
    	    <td><?php echo $usuario["CORREO"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	</div>
	<div class="col-5 col-tab-5">
		<table>
			<tr>
	    		<th>Información</th>
    			<th>Datos</th>
	  		</tr>
	  		<tr>
	  			<th>Número de pacientes</th>
	  			<td><?php echo $pacientes; ?></td>
			</tr>
	  		<tr>
	  			<th>Número de doctoras</th>
	  			<td><?php echo $doctoras; ?></td>
			</tr>
	  		<tr>
	  			<th>Número de tratamientos</th>
	  			<td><?php echo $tratamientos; ?></td>
			</tr>
	  		<tr>
	  			<th>Número de citas</th>
				<td><?php echo $citas; ?></td>
			</tr>
	  		<tr>
	  			<th>Número de especialidades</th>
				<td><?php echo $especialidad; ?></td>
			</tr>
		</table>
	</div>
	</div>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>