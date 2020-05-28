<link rel="stylesheet" type="text/css" href="css/estilo.css" />

<div class="cabecera">
	<div class="img-cabecera">
		<img src="images/logo.webp" id="logo" alt="Clinica Dental Isabel LLedó" width="70" height="70">
		<img src="images/nombre_clinica.webp" id="img" alt="Clinica Dental Isabel LLedó" width="700" height="70">
	</div>
	<div class="disconect">
		<?php if (isset($_SESSION['login'])) {	?>		
				<a href="logout.php"><img src="images/off.png" width="50" height="50"></a><br/>
				<p><?php echo $_SESSION['login']; ?></p>		
		<?php } ?>
	</div>
</div>