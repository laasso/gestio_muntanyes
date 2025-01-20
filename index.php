<?php
session_start();

if (!isset($_SESSION['muntanyes'])) {
    $_SESSION['muntanyes'] = [];
}

$accion = $_POST['accion'] ?? '';
$montanasFiltradas = $_SESSION['muntanyes'];

if ($accion === 'ordenar_altura') {
    usort($montanasFiltradas, function ($a, $b) {
        return $b['altura'] <=> $a['altura'];
    });
} elseif ($accion === 'ordenar_nombre') {
    usort($montanasFiltradas, function ($a, $b) {
        return strcasecmp($a['nom_muntanya'], $b['nom_muntanya']);
    });
} elseif ($accion === 'filtrar') {
    $activitatsSeleccionades = $_POST['activitats'] ?? [];
    if (!empty($activitatsSeleccionades)) {
        $montanasFiltradas = array_filter($montanasFiltradas, function ($muntanya) use ($activitatsSeleccionades) {
            foreach ($activitatsSeleccionades as $activitat) {
                if (strpos($muntanya['activitats'], $activitat) !== false) {
                    return true;
                }
            }
            return false;
        });
    }

    if (!empty($_POST['dificultat'])) {
        $dificultatSeleccionada = $_POST['dificultat'];
        $montanasFiltradas = array_filter($montanasFiltradas, function ($muntanya) use ($dificultatSeleccionada) {
            return $muntanya['dificultat'] === $dificultatSeleccionada;
        });
    }
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
            <p>No hay montañas registradas o no cumplen con los filtros. <a href="add_muntanyes.php">Añade una aquí</a>.</p>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <button type="submit" name="accion" value="ordenar_altura">Ordenar por Altura</button>
        <button type="submit" name="accion" value="ordenar_nombre">Ordenar por Nombre</button>

        <h3>Filtrar por Actividades</h3>
        <label for="senderisme">Senderisme</label>
        <input type="checkbox" id="senderisme" name="activitats[]" value="senderisme">
        <label for="escalada">Escalada</label>
        <input type="checkbox" id="escalada" name="activitats[]" value="escalada">
        <label for="fotografia">Fotografia</label>
        <input type="checkbox" id="fotografia" name="activitats[]" value="fotografia">

        <h3>Filtrar por Dificultad</h3>
        <label for="dificultat">Nivell de dificultat:</label>
        <select id="dificultat" name="dificultat">
            <option value="">--Seleccione una opción--</option>
            <option value="facil">Fàcil</option>
            <option value="moderat">Moderat</option>
            <option value="dificil">Difícil</option>
        </select>

        <button type="submit" name="accion" value="filtrar">Aplicar Filtros</button>
    </form>

</body>
</html>
