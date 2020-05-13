function validateForm(){
  		var existErrors = false;
  		var formulario = document.forms["altaPaciente"];
  		var xc = formulario["nombre"];
  		var xs = document.getElementById("spanNombre");
  		xc.className="";
  		xs.innerHTML="";
  		if(xc.value == null || xc.value == ""){
  			xs.innerHTML = "El nombre es obligatorio";
  			xc.className="error";
  			existErrors = true;
  		}
  		return (!existErrors);
}