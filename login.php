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
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/biblio.css" />
  <title>Gestión de biblioteca: Login</title>
</head>


<body>
	<div class="login">
<?php
	include_once("cabecera.php");
?>

<main>
	
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	
	<form action="login.php" method="post">
		<div><label for="email">Email: </label>
		<input type="text" name="email" id="email" /></div>
		<div><label for="pass">Contraseña: </label>
		<input type="password" name="pass" id="pass" /></div>
		<input class="codigo" type="submit" name="submit" value="entrar" />
	</form>
</main>

<?php
	include_once("pie.php");
?>

</div>
</body>
</html>

