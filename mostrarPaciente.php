<?php
session_start();

if (!isset($_SESSION['login']))
			Header("Location: login.php");

require_once ('gestionarPaciente.php');
require_once ('gestionBD.php');
require_once("gestionarCitas.php");
require_once("paginacionConsulta.php");

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
		
	if (isset($_SESSION["paginacion"])){
		$paginacion = $_SESSION["paginacion"];
	}
	
	$paginaSeleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pagTam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 3);
	$oid = isset($_GET["OID_PACIENTE"]) ? (int)$_GET["OID_PACIENTE"] : (isset($oid) ? (int)$oid["OID_PACIENTE"] : null);

	if ($paginaSeleccionada < 1){
		$paginaSeleccionada = 1;
	}	
	if ($pagTam < 1){
		$pagTam = 3;
	}
	
	unset($_SESSION["paginacion"]);
	
	$conexion = crearConexionBD();
	if(($oid["OID_PACIENTE"])==null){
		$codigo = $_REQUEST['OID_PACIENTE'];
	}else{
		$codigo = $oid["OID_PACIENTE"];
	}
	$datos = getInfoPaciente($conexion, $codigo);
	$query = "SELECT * FROM CITA WHERE OID_PACIENTE = $codigo ORDER BY FECHACITA, HORACITA";
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
}

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
		<title>Perfil de paciente</title>
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<div class="informacion">
				<div class="col-4 col-tab-4">
					<h1><?php echo $datos["APELLIDOS"]; ?>, <?php echo $datos["NOMBRE"];?></h1>
					<form id='actualizarPaciente' method='POST' action='controladorPaciente.php'>
					<input id="OID_PACIENTE" name="OID_PACIENTE" type="hidden" value="<?php echo $codigo?>">
							<h2><b>Datos personales</b></h2>
							<p><b>DNI:</b> <?php echo $datos["DNI"]; ?> </p>
							<input id="dni" name="dni" type="hidden" value="<?php echo $datos["DNI"]; ?>"/>
							<p><b>Nombre:</b> <?php echo $datos["NOMBRE"]; ?></p>
							<input id="nombre" name="nombre" type="hidden" value="<?php echo $datos["NOMBRE"]; ?>"/>
							<p><b>Apellidos:</b> <?php echo $datos["APELLIDOS"]; ?></p>
							<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $datos["APELLIDOS"]; ?>"/>
							<p><b>Poblacion:</b> <?php echo $datos["POBLACION"]; ?></p>
							<input id="poblacion" name="poblacion" type="hidden" value="<?php echo $datos["POBLACION"]; ?>"/>
							<p><b>Direccion:</b> <?php echo $datos["DIRECCION"]; ?></p>
							<input id="direccion" name="direccion" type="hidden" value="<?php echo $datos["DIRECCION"]; ?>"/>
							<p><b>Fecha de Nacimiento:</b> <?php echo $datos["FECHA_NACIMIENTO"]; ?></p>
							<input id="fechaNacimiento" name="fechaNacimiento" type="hidden" value="<?php echo $datos["FECHA_NACIMIENTO"]; ?>"/>
							<p><b>Correo:</b> <?php echo $datos["CORREO"]; ?></p>
							<input id="correo" name="correo" type="hidden" value="<?php echo $datos["CORREO"]; ?>"/>
							
							<br/>
							<h2><b>Datos clínicos</b></h2>
							<p><b>Fecha de alta:</b> <?php echo $datos["FECHAALTA"]; ?></p>
							<input id="fechaAlta" name="fechaAlta" type="hidden" value="<?php echo $datos["FECHAALTA"]; ?>"/>
							<?php if(!($datos["SEGURO"]=="" || $datos["SEGURO"]==null)){ ?>
							<p><b>Seguro:</b> <?php echo $datos["SEGURO"]; ?></p>
							<input id="seguro" name="seguro" type="hidden" value="<?php echo $datos["SEGURO"]; ?>"/>
							<?php } ?>
							
							<br/>
							<?php if(!(($datos["NOMBRE_TUTOR"]=="" || $datos["NOMBRE_TUTOR"]==null) && ($datos["TELEFONO_TUTOR"]=="" && $datos["TELEFONO_TUTOR"]==null))){ ?>
							<h2><b>Datos de contacto</b></h2>
							<hr></hr>								
							<?php } ?>
							<?php if(($datos["NOMBRE_TUTOR"]!="" || $datos["NOMBRE_TUTOR"]!=null)){ ?>
								<p><b>Nombre tutor:</b> <?php echo $datos["NOMBRE_TUTOR"]; ?></p>
								<input id="nombreTutor" name="nombreTutor" type="hidden" value="<?php echo $datos["NOMBRE_TUTOR"]; ?>"/>
							<?php } ?>
							<?php if(($datos["TELEFONO_TUTOR"]!="" || $datos["TELEFONO_TUTOR"]!=null)){ ?>
								<p><b>Telefono tutor:</b> <?php echo $datos["TELEFONO_TUTOR"]; ?></p>
								<input id="telefonoTutor" name="telefonoTutor" type="hidden" value="<?php echo $datos["TELEFONO_TUTOR"]; ?>"/>
							<?php } ?>
				<button id="actualizar" name="actualizar" type="submit" size="4"><img src="images/botonEditar.png" width="20" height="20"></button>
				<button id="eliminar" name="eliminar" type="submit" size="4"><img src="images/botonEliminar.png" width="20" height="20"></button>
				<button id="cancelar" name="cancelar" type="submit" size="4"><img src="images/returnButton.png" width="20" height="20"></button>
				</form>
			</div>
			<div class="col-6 col-tab-6">
				<h1>Citas de <?php echo $datos["NOMBRE"];?></h1>
				<nav>
					<div class="paginas">
						<?php
							for($pagina = 1;$pagina <= $totalPaginas; $pagina++ )
								if ( $pagina == $paginaSeleccionada) { 	?>
									<a class="paginaSeleccionada"><?php echo $pagina; ?></a>
						<?php }	else { ?>
									<a class="paginas" href="mostrarPaciente.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pagTam;?>&OID_PACIENTE=<?php echo $codigo;?>"><?php echo $pagina; ?></a>
						<?php } ?>
							<br/>	
						<form method="get" class="paginas" action="mostrarPaciente.php">
							Mostrando
							<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $paginaSeleccionada?>"/>
							<input type='hidden' name='OID_PACIENTE' value='<?php echo $codigo?>'>
							<input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo $totalCitas; ?>" value="<?php echo $pagTam?>"/>			
							de <?php echo $totalCitas?>
							<input class="paginacion" type="submit" value="Cambiar">
						</form>
					</div>
				</nav>
				<table class="citas">
	 				<tr>
	    				<th>Código</th>
	    				<th>Fecha cita</th>
	    				<th>Hora cita</th>
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
	  				</tr>
	  					<?php } ?>
				</table>
	  			</div>	
			</div>
			</div>	
				<?php include_once ('pie.php'); ?>	
		</main>
	</body>
</html>