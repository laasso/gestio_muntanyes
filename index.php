<?php
session_start();

// Verificar si existe una variable de sesión para las montañas
if (!isset($_SESSION['muntanyes'])) {
    $_SESSION['muntanyes'] = [];
}

// Aplicar filtro si se envía el formulario
$filtroAltura = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['altura_minima'])) {
    $filtroAltura = (int)$_POST['altura_minima'];
    $montanasFiltradas = array_filter($_SESSION['muntanyes'], function ($muntanya) use ($filtroAltura) {
        return $muntanya['altura'] >= $filtroAltura;
    });
} else {
    $montanasFiltradas = $_SESSION['muntanyes'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Montañas</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Poppins:wght@900&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Gestión de Montañas</h1>
    <a href="add_muntanyes.php" class="add-button">Añadir nueva montaña</a>

    <!-- Formulario para el filtro -->
    <form method="POST">
        <label for="altura_minima">Filtrar por altura mínima (metros):</label>
        <input type="number" name="altura_minima" id="altura_minima" value="<?= htmlspecialchars($filtroAltura) ?>" min="0" placeholder="Ejemplo: 2000">
        <button type="submit">Aplicar filtro</button>
    </form>

    <ul>
        <?php if (!empty($montanasFiltradas)): ?>
            <?php foreach ($montanasFiltradas as $id => $muntanya): ?>
                <li>
                    <strong>Nombre:</strong> <?= htmlspecialchars($muntanya['nom_muntanya']) ?><br>
                    <strong>Altura:</strong> <?= htmlspecialchars($muntanya['altura']) ?> metros<br>
                    <strong>Fecha de ascenso:</strong> <?= htmlspecialchars($muntanya['data_ascens']) ?><br>
                    <strong>Dificultad:</strong> <?= htmlspecialchars($muntanya['dificultat']) ?><br>
                    <strong>Actividades:</strong> <?= htmlspecialchars($muntanya['activitats']) ?><br>
                    <br>
                    <?php if (!empty($muntanya['foto_muntanya'])): ?>
                        <img src="<?= htmlspecialchars($muntanya['foto_muntanya']) ?>" alt="Foto de <?= htmlspecialchars($muntanya['nom_muntanya']) ?>">
                    <?php endif; ?>
                    <a href="delete.php?id=<?= urlencode($id) ?>">Eliminar</a>
                    <a href="edit_muntanyes.php?id=<?= urlencode($id) ?>">Editar</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay montañas registradas que cumplan con el filtro. <a href="add_muntanyes.php">Añade una aquí</a>.</p>
        <?php endif; ?>
    </ul>
</body>
</html>
