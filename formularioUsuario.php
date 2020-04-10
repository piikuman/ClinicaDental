<?php
	session_start();

	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
		unset($_SESSION['usuario']);
	} else if(!isset($_SESSION['formulario'])) {
		$formulario['correo'] = "";
		$formulario['apellidos'] = "";
	
		$_SESSION['formulario'] = $formulario;
	} else
		$formulario = $_SESSION['formulario'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Formulario de usuario</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	<?php if(!isset($usuario)){ ?>
	<h1>Añadir nuevo usuario</h1>		
	<form id="altausuario" method="post" action="validacionUsuario.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos usuario</legend>
			<div><label for="correo">Correo:<em>*</em></label>
			<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $formulario['correo'];?>" required/><br>
			</div>
			
			<div><label for="password">Password:</label>
			<input id="password" name="password" type="password" size="80"/>
			</div>
			
			<div><label for="conpass">Confirm password:</label>
			<input id="conpass" name="conpass" type="password" size="80"/>
			</div>
		</fieldset>
		
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<?php }else{ ?>
	<h1>Actualizar usuario <?php echo $usuario['OID_USUARIO'];?></h1>	
	<form id="actualizarUsuario" method="post" action="validacionUsuario.php">
		<input id="OID_USUARIO" name="OID_USUARIO" type="hidden" value="<?php echo $usuario['OID_USUARIO']?>" />
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos usuario</legend>
		<div><label for="correo">Correo:<em>*</em></label>
		<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $usuario['correo'];?>" required/><br>
		</div>
				
		<div><label for="password">Password:</label>
		<input id="password" name="password" type="password" size="80"/>
		</div>
			
		<div><label for="conpass">Confirm password:</label>
		<input id="conpass" name="conpass" type="password" size="80"/>
		</div>
		</fieldset>
		
		<div>
			<button id="actualizar" name="actualizar" type="submit"><img src="images/botonEditar.png" width="20" height="20"></button>
		</div>	
	</form>
	<?php } ?>
	<?php
		include_once("pie.php");
	?>
	
	</body>
</html>