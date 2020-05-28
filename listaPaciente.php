<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if (isset($_SESSION['paciente']))
			unset($_SESSION['paciente']);
	
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Lista Pacientes</title>
</head>
<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<nav>
		<div class="paginas">
			<?php
				for($pagina = 1;$pagina <= $totalPaginas; $pagina++ )
					if ( $pagina == $paginaSeleccionada) { 	?>
						<a class="paginaSeleccionada"><?php echo $pagina; ?></a>
			<?php }	else { ?>
						<a class="paginas" href="listaPaciente.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		
		<br/>	
		
		<form method="get" class="paginas" action="listaPaciente.php">
			Mostrando
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
			<input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo $totalPacientes; ?>" value="<?php echo $pagTam?>"/>			
				de <?php echo $totalPacientes?>
			<input class="paginacion" type="submit" value="Cambiar">
		</form>
		</div>
	</nav>
	<a href="formularioPaciente.php" class="add">Añadir Paciente</a>
	<table>
	  <tr>
	    <th>Código</th>
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
	    <th><input class="codigo" type='submit' value='<?php echo $paciente["OID_PACIENTE"]; ?>'></th>
		</form>
    	    <td><?php echo $paciente["APELLIDOS"]; ?></td>
	    	<td><?php echo $paciente["NOMBRE"]; ?></td>
	    	<td><?php echo $paciente["DNI"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
</main>
<?php
	include_once("pie.php");
?>
</body>
</html>