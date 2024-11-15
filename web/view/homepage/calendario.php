<p>Filtar por: mes/dia/semana (JS)</p>

<form action="/" method="post">
        <label for="vista">Selecciona el tipo de vista:</label>
        <select id="vista" name="vista" onchange="mostrarOpciones()">
            <option value="diaria">Vista Diaria</option>
            <option value="semanal">Vista Semanal</option>
            <option value="mensual" selected>Vista Mensual</option>
        </select>

        <div id="opciones">
			<label for="mes">Selecciona mes:</label>
			<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="2024">
			<input type="number" id="mes" name="mes" min="1" max="12" value="1">
		</div>

		<input type="hidden" id="tipoFiltro" name="tipoFiltro" value="mensual">
		<input type="hidden" name="request">
        <button type="submit">Filtrar</button>
</form>

<script>
	function mostrarOpciones() {
		var vista = document.getElementById("vista").value;
		var filtro = document.getElementById("tipoFiltro");
		var opcionesDiv = document.getElementById("opciones");

		if (vista === "diaria") {
			opcionesDiv.innerHTML = `
				<label for="dia">Selecciona un día:</label>
				<input type="date" id="dia" name="dia">
				<input type="hidden" name="tipoFiltro" value="diario">
			`;
			filtro.value= "diario";
		} else if (vista === "semanal") {
			opcionesDiv.innerHTML = `
				<label for="semana">Selecciona una semana:</label>
				<input type="number" id="semana" name="semana" min="1" max="52" value="1">
				<input type="hidden" name="tipoFiltro" value="semanar">
			`;
			filtro.value= "semanal";
		} else if (vista === "mensual") {
			opcionesDiv.innerHTML = `
				<label for="mes">Selecciona mes:</label>
				<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="2024">
				<input type="number" id="mes" name="mes" min="1" max="12" value="1">
			`;
			filtro.value= "mensual";
		}
	}
</script>

<?php foreach ($trayectos as $trayecto): ?>
	<p>Fecha (O mas cosas): <?php echo $trayecto['dia'].' '.$trayecto['hora'] ?> </p>
	<button>Ver mas (O con JS click encima)</button>
<?php endforeach; ?>
