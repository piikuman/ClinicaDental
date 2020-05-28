<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuario.php");
	
	if (isset($_POST['submit'])){
		$email= $_POST['email'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$email,$pass);
		cerrarConexionBD($conexion);
		
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $email;
			Header("Location: index.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Login</title>
</head>


<body>
	
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>

<main class="login">
	
	<div class="clinica-intro">
            <div class="logo">
             <img src="images/logo.webp" alt="logo">
         </div>
            <div class="texto-clinica">
                <p>¡Bienvenidos a Clínica Dental Isabel Lledó!</p>
            </div>
    </div>
	
	<div class="logo-intro">
	<div class="login-form">
	<h1>Inicia Sesión</h1>
	<form action="login.php" method="post">
		<div><label for="email">Email </label>
		<input type="text" name="email" id="email" /></div>
		<div><label for="pass">Contraseña </label>
		<input type="password" name="pass" id="pass" /></div>
		<input class="codigo" type="submit" name="submit" value="Entrar" />
	</form>
	</div>
	</div>
</main>

</div>
</body>
</html>

