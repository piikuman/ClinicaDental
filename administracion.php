<?php
	session_start();
	
	if (!isset($_SESSION['login']))
		Header("Location: login.php");
	else if("admin" != $_SESSION['login']){
		Header("Location: inicio.php");
	}
	
	require_once("gestionBD.php");
	require_once("gestionarUsuario.php");
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
	<table class="pacientes">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Correo</th>
	  </tr>
  	 <?php
			foreach($usuarios as $usuario){
		?>
  	  <tr>
  	  	<form id='formMostrarUsuarios' method='POST' action='mostrarUsuario.php' >
			<input type='hidden' name='OID_USUARIO' value='<?php echo $usuario["OID_USUARIO"]?>'>
	    <th><input type='submit' value='<?php echo $usuario["OID_USUARIO"]; ?>'></th>
		</form>
    	    <td><?php echo $usuario["CORREO"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioUsuario.php">Añadir Usuario</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>