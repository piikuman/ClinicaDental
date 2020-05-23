<header id="cabecera">
	<div class="logo">
	<img src="images/logo.webp" alt="Clinica Dental Isabel LLedó" width="70" height="70">
	<img src="images/nombre_clinica.webp" alt="Clinica Dental Isabel LLedó" width="700" height="70">
	</div>
	<div class="diconect">
	<?php if (isset($_SESSION['login'])) {	?>		
			<a href="logout.php" class="disconect"><img src="images/off.png" width="40" height="40"></a><br/>
			<p><?php echo $_SESSION['login']; ?></p>		
	<?php } ?>
	</div>
	
</header>