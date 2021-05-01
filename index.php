<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>php-devops</title>
</head>

<body>
<form action="process.php" method="POST" name="formulario">
	Hora (24hs):
	<input type="time" name="hora" min="00:00" max="23:59" required>
	<br>
	<span>Region </span> <select id="selector" name="zone">
	</select>
		
	<br/>
    <input type="checkbox" name='reg[]' value="America/Argentina/Buenos_Aires"> AR <br/>
    <input type="checkbox" name='reg[]' value="America/Santo_Domingo"> CL <br/>
    <input type="checkbox" name='reg[]' value="America/Caracas"> VE <br/>
    <input type="checkbox" name='reg[]' value="America/Bogota"> CO <br/>

	<button type="submit">Calcular</button>

	<div id="hours"></div>
</form>

<script type="text/javascript">

  fetch('regions.php')
    .then(respuesta => {
        if(respuesta.ok) {
            respuesta.json().then(timezones => {
				var sel = document.getElementById('selector');
				var optGroup = document.createElement("optGroup");
				sel.appendChild(optGroup);
				for (let i=0; i< timezones.length; i++){
					var op = document.createElement("option");
					op.innerHTML = timezones[i].replace('America/','');
					op.value = timezones[i];
					optGroup.appendChild(op);
				}
            });
        }
	});
	
	document.formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    console.log("entro: ","Si");
    var fd = new FormData(document.formulario);
    fetch(document.formulario.action, {
        method: 'POST',
        body: fd
    })
    .then(respuesta => {
        if(respuesta.ok) {
            respuesta.json().then(hours => {

				var divHours = document.getElementById('hours');
				divHours.innerHTML='';
				for(let i=0; i<hours.length; i++){
					var message = document.createElement("p");
					message.innerHTML = hours[i];
					divHours.appendChild(message);
				}
            });
        };
    });
});

</script>

<br>

</body>
</html>