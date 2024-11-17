<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <!-- Vincular Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vincular CSS personalizado -->
    <link href="web/public/styles.css" rel="stylesheet"> <!-- Cambia 'ruta/a/' por la ubicación real de tu archivo -->
</head>

<div class="main-container">
        <!-- Header con franja de color azul claro semitransparente -->
        <header class="header-bar d-flex justify-content-between align-items-center">
            <!-- Text aligned to the left -->
            <h2 class="airlines-title">CODECRAFTER AIRLINES</h2> 
            
            <!-- Group buttons together and push them to the right -->
            <div class="ml-auto">
                <a href="/" class="btn btn-primary">Homepage</a>
                <?php if (isset($_SESSION['userSession']) && $request != 'logout') {echo '<a href="/?request=logout" class="btn btn-primary">Desconectarse</a>';} ?>
            </div>
        </header>

</header>
 
