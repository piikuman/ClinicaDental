<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarUsuario.php");
	require_once("paginacionConsulta.php");
	
	$conexion = crearConexionBD();
	$usuarios = consultarTodosUsuarios($conexion);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de usuarios: Lista de usuarioss</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<table class="pacientes">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Correo</th>
	  </tr>
  	 <?php
			foreach($usuarios as $usuario){
		?>
  	  <tr>
  	  	<form id='formMostrarUsuarios' method='POST' action='mostrarUsuario.php' >
			<input type='hidden' name='OID_USUARIO' value='<?php echo $usuario["OID_USUARIO"]?>'>
	    <th><input type='submit' value='<?php echo $usuario["OID_USUARIO"]; ?>'></th>
		</form>
    	    <td><?php echo $usuario["CORREO"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioUsuario.php">Añadir Usuario</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>