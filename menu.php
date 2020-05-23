<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<?php
$admin = $_SESSION['login'];
?>

<div class="menu">
		<ul>
			<a href="inicio.php" class="menu">Inicio</a>
			<a href="listaPaciente.php" class="menu">Pacientes</a>
			<a href="listaCitas.php" class="menu">Citas</a>
			<a href="listaDoctora.php" class="menu">Doctoras</a>
			<a href="listaTratamientos.php" class="menu">Tratamientos</a>
			<a href="listaEspecialidad.php" class="menu">Especialidades</a>
			<?php if("admin"==$admin){?>
				<a href="administracion.php" class="menu">Administración</a>
			<?php } ?>
		  	<a href="about.php" class="menu">Sobre nosotros</a>
		</ul>
</div>
<br />
