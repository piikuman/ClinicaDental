<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarDocotra.php");
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
	$query = "SELECT * FROM DOCTORA ORDER BY APELLIDOS, NOMBRE";
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
  <meta charset="utf-8">
  <title>Gestión de doctoras: Lista de doctoras</title>
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
						<a href="listaDoctora.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		</div>
		
		<form method="get" action="listaDoctora.php">
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
			Mostrando
			<input id="PAG_TAM" name="PAG_TAM" type="number"
				min="1" max="<?php echo $totalDoctoras; ?>" value="<?php echo $pagTam?>" autofocus="autofocus" />			
				doctoras de <?php echo $totalDoctoras?>
			<input type="submit" value="Cambiar">
		</form>
	</nav>
	
	<table class="doctoras">
	  <tr>
	    <th scope="row">Código</th>
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
	    <th><input type='submit' value='<?php echo $doctora["OID_DOCTORA"]; ?>'></th>
		</form>
    	    <td><?php echo $doctora["APELLIDOS"]; ?></td>
	    	<td><?php echo $doctora["NOMBRE"]; ?></td>
	    	<td><?php echo $doctora["DNI"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioDoctora.php">Añadir Doctora</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>