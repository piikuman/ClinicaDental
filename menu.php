<aside>
	<nav>
		<ul class="topnav" id="myTopnav">
			<li><a href="inicio.php">Inicio</a></li>
			<li><a href="listaPaciente.php">Pacientes</a></li>
			<li><a href="administracion.php">Administración</a></li>
		  	<li><a href="about.php">Sobre nosotros</a></li>
			<?php if (isset($_SESSION['login'])) {	?>
				<a href="logout.php"><img src="images/botonEditar.png" width="20" height="20"> </a>
			<?php } ?> </img>
		</ul>
	</nav>
</aside>
