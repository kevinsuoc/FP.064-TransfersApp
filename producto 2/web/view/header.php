
<div class="main-container">
        <!-- Header con franja de color azul claro semitransparente -->
        <header class="header-bar d-flex justify-content-between align-items-center">
            <!-- Text aligned to the left -->
            <h2 class="airlines-title">CODECRAFTER AIRLINES</h2> 
            
            <!-- Group buttons together and push them to the right -->
            <div class="ml-auto">
                <a href="/" class="btn btn-primary">Homepage</a>
                <?php if (isset($_SESSION['userSession']) && $request != 'logout') {echo '<a href="/?request=logout" class="btn btn-warning">Desconectarse</a>';} ?>
            </div>
        </header>

</header>
 
