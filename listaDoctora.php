<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	if (isset($_SESSION['doctora']))
			unset($_SESSION['doctora']);
	
	require_once("gestionBD.php");
	require_once("gestionarDoctora.php");
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
	$query = "SELECT * FROM DOCTORA ORDER BY DNI, NOMBRE";
	$totalDoctoras = totalConsulta($conexion, $query);
	$totalPaginas = (int)($totalDoctoras / $pagTam);

	if ($totalDoctoras % $pagTam > 0){
		$totalPaginas++;
	}	

	if ($paginaSeleccionada > $totalPaginas){
		$paginaSeleccionada = $totalPaginas;
	}	

	$paginacion["PAG_NUM"] = $paginaSeleccionada;
	$paginacion["PAG_TAM"] = $pagTam;
	$_SESSION["paginacion"] = $paginacion;

	$doctoras = consultaPaginada($conexion, $query, $paginaSeleccionada, $pagTam);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Lista Doctoras</title>
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
						<a class="paginas" href="listaDoctora.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		
		<br/>	
		
		<form method="get" class="paginas" action="listaDoctora.php">
			Mostrando
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
			<input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo $totalDoctoras; ?>" value="<?php echo $pagTam?>"/>			
				de <?php echo $totalDoctoras?>
			<input class="paginacion" type="submit" value="Cambiar">
		</form>
		</div>
	</nav>
	<a href="formularioDoctora.php" class="add">A??adir Doctora</a>
	<table class="doctoras">
	  <tr>
	    <th scope="row">C??digo</th>
    	<th>Apellidos</th>
	    <th>Nombre</th>
    	<th>DNI</th>
	  </tr>
  	 <?php
			foreach($doctoras as $doctora){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarDoctora.php' > 
			<input type='hidden' name='OID_DOCTORA' value='<?php echo $doctora["OID_DOCTORA"]?>'>
	    <th><input class="codigo" type='submit' value='<?php echo $doctora["CODIGODOCTORA"]; ?>'></th>
		</form>
    	    <td><?php echo $doctora["APELLIDOS"]; ?></td>
	    	<td><?php echo $doctora["NOMBRE"]; ?></td>
	    	<td><?php echo $doctora["DNI"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>