<form action="/" method="post">
        <label for="vista">Selecciona el tipo de vista:</label>
        <select id="vista" name="vista" onchange="mostrarOpciones()">
            <option value="diaria" <?= $filtroData['tipo'] == 'diaria' ? 'selected' : '' ?>>Vista Diaria</option>
            <option value="semanal" <?= $filtroData['tipo'] == 'semanal' ? 'selected' : '' ?>>Vista Semanal</option>
            <option value="mensual" <?= $filtroData['tipo'] == 'mensual' ? 'selected' : '' ?>>Vista Mensual</option>
        </select>

        <div id="opciones">
			<?php if ($filtroData['tipo'] == 'diaria'): ?>
			<label for="dia">Selecciona un día:</label>
			<input type="date" id="dia" name="dia" value="<?= $filtroData['dia'] ?>">
		
			<?php elseif ($filtroData['tipo'] == 'semanal'): ?>
			<label for="semana">Selecciona una semana:</label>
			<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="<?= $filtroData['anyo'] ?>">
			<input type="number" id="semana" name="semana" min="1" max="52" value="<?= $filtroData['semana'] ?>">

			<?php elseif ($filtroData['tipo'] == 'mensual'): ?>
			<label for="mes">Selecciona mes:</label>
			<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="<?= $filtroData['anyo'] ?>">
			<input type="number" id="mes" name="mes" min="1" max="12" value="<?= $filtroData['mes'] ?>">

			<?php endif; ?>
		</div>

		<input type="hidden" name="request" value="filtroTrayectos">
        <button type="submit">Filtrar</button>
</form>

<script>
	function mostrarOpciones() {
		var vista = document.getElementById("vista").value;
		var opcionesDiv = document.getElementById("opciones");

		if (vista === "diaria") {
			opcionesDiv.innerHTML = `
				<label for="dia">Selecciona un día:</label>
				<input type="date" id="dia" name="dia" value="2024-01-01">
			`;
		} else if (vista === "semanal") {
			opcionesDiv.innerHTML = `
				<label for="semana">Selecciona una semana:</label>
				<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="2024">
				<input type="number" id="semana" name="semana" min="1" max="52" value="1">
			`;
		} else if (vista === "mensual") {
			opcionesDiv.innerHTML = `
				<label for="mes">Selecciona mes:</label>
				<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="2024">
				<input type="number" id="mes" name="mes" min="1" max="12" value="1">
			`;
		}
	}
</script>

<?php foreach ($trayectos as $trayecto): ?>
	<p>Fecha (O mas cosas): <?php echo $trayecto['dia'].' '.$trayecto['hora'] ?> </p>
	<button>Ver mas (O con JS click encima)</button>
<?php endforeach; ?>
