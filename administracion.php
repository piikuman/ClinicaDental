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
  <meta charset="utf-8">
  <title>Gestión de usuarios: Lista de usuarioss</title>
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
	<div class="usuarios">
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
	<div class="numeros">
		<ul>
			<li><h4>Número de pacientes: <?php echo $pacientes; ?></h4></li>
			<li><h4>Número de doctoras: <?php echo $doctoras; ?></h4></li>
			<li><h4>Número de tratamientos: <?php echo $tratamientos; ?></h4></li>
			<li><h4>Número de citas: <?php echo $citas; ?></h4></li>
			<li><h4>Número de especialidades: <?php echo $especialidad; ?></h4></li>
		</ul>
	</div>
	</div>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>