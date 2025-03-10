<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Poppins:wght@900&display=swap" rel="stylesheet">

    <title>Afegir Muntanya</title>
</head>
<body>
<h1>Afegir una nova muntanya</h1>

<div class="form-container">
    <form action="processa_muntanyes.php" method="post">
    <label for="nom_muntanya">Nom de la muntanya:</label>
    <input type="text" id="nom_muntanya" name="nom_muntanya" required>

    <label for="altura">Altura en metres:</label>
    <input type="number" id="altura" name="altura" min="1" required>

    <label for="data_ascens">Data de l'últim ascens:</label>
    <input type="date" id="data_ascens" name="data_ascens">

    <label for="dificultat">Nivell de dificultat:</label>
    <select id="dificultat" name="dificultat">
        <option value="facil">Fàcil</option>
        <option value="moderat">Moderat</option>
        <option value="dificil">Difícil</option>
    </select>

    <label>Activitats disponibles:</label>
    <label for="senderisme">Senderisme</label>
    <input type="checkbox" id="senderisme" name="activitats[]" value="senderisme">
    <label for="escalada">Escalada</label>
    <input type="checkbox" id="escalada" name="activitats[]" value="escalada">
    <label for="fotografia">Fotografia</label>
    <input type="checkbox" id="fotografia" name="activitats[]" value="fotografia"

    <label for="foto_muntanya">URL de la foto de la muntanya:</label>
    <input type="url" id="foto_muntanya" name="foto_muntanya" placeholder="https://ejemplo.com/foto.jpg">

    <button type="submit">Afegir muntanya</button>

    <a href="index.php">Tornar a la llista</>

    </form>

</div>


</body>
</html>
