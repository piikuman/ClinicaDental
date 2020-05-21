<header id="cabecera">
	<img src="images/logo.webp" alt="Clinica Dental Isabel LLedó" width="80" height="80">
	<img src="images/nombre_clinica.webp" alt="Clinica Dental Isabel LLedó" width="800" height="80">
	<?php if (isset($_SESSION['login'])) {	?>		
			<a href="logout.php" id="disconect"><img src="images/botonEditar.png" width="60" height="60"> </a><br/>
			<a id="disconect"><?php echo $_SESSION['login']; ?></a>
	<?php } ?>
</header>