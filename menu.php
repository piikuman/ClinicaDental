<?php
$admin = $_SESSION['login'];
?>
	<nav class="menu">
	<div class="links">
			<a href="inicio.php">Inicio</a>
			<a href="listaPaciente.php">Pacientes</a>
			<a href="listaCitas.php">Citas</a>
			<a href="listaDoctora.php">Doctoras</a>
			<a href="listaTratamientos.php">Tratamientos</a>
			<a href="listaEspecialidad.php">Especialidades</a>
			<?php if("admin"==$admin){?>
				<a href="administracion.php">Administración</a>
			<?php }?>
		  	<a href="about.php">Sobre nosotros</a>
	</div>
	<div class="botonMenu" onclick="showMenuResponsive()">
                   <svg x="0px" y="0px"
                                viewBox="0 0 512 512" style="width: 40px; height: 40px; margin-right: 1em;">
                        
                                    <path d="M492,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,236,492,236z"/>
                                    <path d="M492,76H20C8.954,76,0,84.954,0,96s8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,76,492,76z"/>
                                    <path d="M492,396H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20
                                        C512,404.954,503.046,396,492,396z"/>
                    </svg>
                </div>	  	
                </nav>
                
                
	<div id="rLinks" style="display: none;">
			<a href="inicio.php">Inicio</a>
			<a href="listaPaciente.php">Pacientes</a>
			<a href="listaCitas.php">Citas</a>
			<a href="listaDoctora.php">Doctoras</a>
			<a href="listaTratamientos.php">Tratamientos</a>
			<a href="listaEspecialidad.php">Especialidades</a>
			<?php if("admin"==$admin){?>
				<a href="administracion.php">Administración</a>
			<?php }?>
		  	<a href="about.php">Sobre nosotros</a>
	</div>
<script>

function showMenuResponsive() {
    var x = document.getElementById("rLinks");    
    if (x.style.display === "none") {
        x.style.display = "flex";
    } else {
        x.style.display = "none";
    }
}
</script>
