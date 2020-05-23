<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("gestionarDoctora.php");
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
	$query = "SELECT * FROM CITA ORDER BY FECHACITA, HORACITA";
	$totalCitas = totalConsulta($conexion, $query);
	$totalPaginas = (int)($totalCitas / $pagTam);

	if ($totalCitas % $pagTam > 0){
		$totalPaginas++;
	}	

	if ($paginaSeleccionada > $totalPaginas){
		$paginaSeleccionada = $totalPaginas;
	}	

	$paginacion["PAG_NUM"] = $paginaSeleccionada;
	$paginacion["PAG_TAM"] = $pagTam;
	$_SESSION["paginacion"] = $paginacion;

	$todasCitas = consultaPaginada($conexion, $query, $paginaSeleccionada, $pagTam);
	
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de citas: Lista de citas</title>
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
						<a class="paginas" href="listaCitas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		
		<br/>	
		
		<form method="get" class="paginas" action="listaCitas.php">
			Mostrando
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
			<input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo $totalCitas; ?>" value="<?php echo $pagTam?>"/>			
				de <?php echo $totalCitas?>
			<input class="paginacion" type="submit" value="Cambiar">
		</form>
		</div>
	</nav>
	<a href="formularioCitas.php" class="add">Añadir Cita</a>
	<table>
	  <tr>
	    <th>Código</th>
    	<th>Fecha cita</th>
	    <th>Hora cita</th>
    	<th>Consulta</th>
    	<th>Doctora</th>
    	<th>Paciente</th>
	  </tr>
  	 <?php
			foreach($todasCitas as $citas){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarCitas.php' >
			<input type='hidden' name='OID_CITA' value='<?php echo $citas["OID_CITA"]?>'>
	    <th><input class="codigo" type='submit' value='<?php echo $citas["OID_CITA"]; ?>'></th>
		</form>
    	    <td><?php echo $citas["FECHACITA"]; ?></td>
	    	<td><?php echo $citas["HORACITA"]; ?></td>
	    	<td><?php echo $citas["CONSULTA"]; ?></td>
	    	<?php $doctora = getInfoDoctora($conexion, $citas["OID_DOCTORA"]);?>
	    	<td><?php echo $doctora["CODIGODOCTORA"];?></td>
	    	<?php $paciente = getInfoPaciente($conexion, $citas["OID_PACIENTE"]);?>
	    	<td><?php echo $paciente["APELLIDOS"];?>, <?php echo $paciente["NOMBRE"];?></td>
	  </tr>
	  <?php } ?>	
	</table>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>