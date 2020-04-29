<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPaciente.php");
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
	$query = "SELECT * FROM PACIENTE ORDER BY APELLIDOS, NOMBRE";
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

	$pacientes = consultaPaginada($conexion, $query, $paginaSeleccionada, $pagTam);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de pacientes: Lista de pacientes</title>
  <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<nav>
		<div id="enlaces">
			<?php
				for($pagina = 1;$pagina <= $totalPaginas; $pagina++ )
					if ( $pagina == $paginaSeleccionada) { 	?>
						<span class="current"><?php echo $pagina; ?></span>
			<?php }	else { ?>
						<a href="listaPaciente.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		</div>
		
		<form method="get" action="listaPaciente.php">
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
			Mostrando
			<input id="PAG_TAM" name="PAG_TAM" type="number"
				min="1" max="<?php echo $totalPacientes; ?>" value="<?php echo $pagTam?>" autofocus="autofocus" />			
				pacientes de <?php echo $totalPacientes?>
			<input type="submit" value="Cambiar">
		</form>
	</nav>
	
	<table class="pacientes">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Apellidos</th>
	    <th>Nombre</th>
    	<th>DNI</th>
	  </tr>
  	 <?php
			foreach($pacientes as $paciente){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarPaciente.php' >
			<input type='hidden' name='OID_PACIENTE' value='<?php echo $paciente["OID_PACIENTE"]?>'>
	    <th><input type='submit' value='<?php echo $paciente["OID_PACIENTE"]; ?>'></th>
		</form>
    	    <td><?php echo $paciente["APELLIDOS"]; ?></td>
	    	<td><?php echo $paciente["NOMBRE"]; ?></td>
	    	<td><?php echo $paciente["DNI"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioPaciente.php">Añadir Paciente</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>