<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarTratamientos.php");
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
	$query = "SELECT * FROM TRATAMIENTO ORDER BY NOMBRE";
	$totalTratamientos = totalConsulta($conexion, $query);
	$totalPaginas = (int)($totalTratamientos / $pagTam);

	if ($totalTratamientos % $pagTam > 0){
		$totalPaginas++;
	}	

	if ($paginaSeleccionada > $totalPaginas){
		$paginaSeleccionada = $totalPaginas;
	}	

	$paginacion["PAG_NUM"] = $paginaSeleccionada;
	$paginacion["PAG_TAM"] = $pagTam;
	$_SESSION["paginacion"] = $paginacion;

	$tratamientos = consultaPaginada($conexion, $query, $paginaSeleccionada, $pagTam);
	cerrarConexionBD($conexion);
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de tratamientos: Lista de tratamientos</title>
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
						<a class="paginas" href="listaTratamientos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		<br/>
		<form method="get" class="paginas" action="listaTratamientos.php">
			Mostrando
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
			<input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo $totalTratamientos; ?>" value="<?php echo $pagTam?>"/>			
				de <?php echo $totalTratamientos?>
			<input class="paginacion" type="submit" value="Cambiar">
		</form>
		</div>
	</nav>
	<a href="formularioTratamientos.php" class="add">Añadir Tratamiento</a>
	<table>
	  <tr>
	    <th>Código</th>
    	<th>Nombre</th>
	    <th>Coste</th>
	  </tr>
  	 <?php
			foreach($tratamientos as $tratamiento){
		?>
  	  <tr>
  	  	<form id='formMostrarTratamiento' method='POST' action='mostrarTratamientos.php' >
			<input type='hidden' name='OID_TRATAMIENTO' value='<?php echo $tratamiento["OID_TRATAMIENTO"]?>'>
	    <th><input class="codigo" type='submit' value='<?php echo $tratamiento["OID_TRATAMIENTO"]; ?>'></th>
		</form>
    	    <td><?php echo $tratamiento["NOMBRE"]; ?></td>
	    	<td><?php echo $tratamiento["COSTE"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>