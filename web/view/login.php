<?php
require_once __DIR__ . '/../view/head.php';
require_once __DIR__ . '/../view/header.php';

?>
<body>

<div class="containerfromwelcome">
<div class="airlines-welcome">
    <div class="welcome-text">
        <h1>Bienvenido a Codecrafters Airlines, 
            ¿listo para una nueva aventura?</h1>
    </div>
</div>

<?php
require_once __DIR__ . "/../view/forms/login.php"
?>

</div>
</div>
</div>
</body>
</html>

<?php if (isset($loginError)){echo $loginError;}; ?>
<?php if (isset($loginMessage)){echo $loginMessage;}; ?>