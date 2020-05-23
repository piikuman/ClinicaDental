<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	else if("admin" != $_SESSION['login']){
		Header("Location: inicio.php");
	}
	
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
  <script type="text/javascript">
  	function validateForm(){
  		var existErrors = false;
  		var formulario = document.forms["altaUsuario"];
  		var xc = formulario["correo"];
  		var xs = document.getElementById("spanCorreo");
  		var co = /^(\w|[\.-])+(@\b((gmail.)|(hotmail.))?((com)|(es)))$/i;
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El correo es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}else if((!co.test(xc.value))){
  			xs.innerHTML = "El formato del correo no es correcto, debe ser hotmail o gmail";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xc = formulario["password"];
  		var xs = document.getElementById("spanPassword");
  		var co = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9]{7,}$/;
  		xc.className="";
  		xs.innerHTML="";
  		if (xc.value == "" || xc.value == null) {
  			xs.innerHTML = "La contraseña es obligatoria.";
  			xc.className="error";
  			existErrors = true;
  		}else if((!co.test(xc.value))){
  			xs.innerHTML = "Debe contener mayusculas, minusculas, números y ser mínima de longitud 7.";
  			xc.className="error";
  			existErrors = true;
  		}
  		var xcon = formulario["conpass"];
  		var xs = document.getElementById("spanConpass");
  		xcon.className="";
  		xs.innerHTML="";
  		if (xcon.value == "" || xcon.value == null) {
  			xs.innerHTML = "La contraseña es obligatoria.";
  			xcon.className="error";
  			existErrors = true;
  		}else if(xc.value != xcon.value){
  			xs.innerHTML = "Las contraseñas no coinciden.";
  			xcon.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
	}
  </script>
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
	<form id="altaUsuario" method="post" onsubmit="return validateForm()" action="validacionUsuario.php">
		<p><i>Los campos obligatorios de rellenar están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos usuario</legend>
			<div><label for="correo">Correo:<em>*</em></label>
			<input id="correo" name="correo"  type="correo" placeholder="usuario@dominio.extension" value="<?php echo $formulario['correo'];?>"/><span id="spanCorreo"></span>
			</div>
			
			<div><label for="password">Password:</label>
			<input id="password" name="password" type="password" size="80"/><span id="spanPassword"></span>
			</div>
			
			<div><label for="conpass">Confirm password:</label>
			<input id="conpass" name="conpass" type="password" size="80"/><span id="spanConpass"></span>
			</div>
		</fieldset>
		
		<div>
			<button id="añadir" name="añadir" type="submit"><img src="images/botonOkey.png" width="20" height="20"></button>
		</div>
	</form>
	<form id="altaUsuario" method="post" action="validacionUsuario.php">
		<button id="cancelarAñadir" name="cancelarAñadir" type="submit"><img src="images/returnButton.png" width="20" height="20"></button>
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