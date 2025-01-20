<?php
session_start();

if (!isset($_SESSION['muntanyes'])) {
    $_SESSION['muntanyes'] = [];
}

$id = $_POST['id'] ?? '';
if (!$id || !isset($_SESSION['muntanyes'][$id])) {
    header('Location: index.php');
    exit;
}

$nom_muntanya = $_POST['nom_muntanya'] ?? '';
$altura = $_POST['altura'] ?? '';
$data_ascens = $_POST['data_ascens'] ?? '';
$dificultat = $_POST['dificultat'] ?? '';
$activitats = isset($_POST['activitats']) ? implode(", ", $_POST['activitats']) : '';
$imatge_url = $_POST['imatge_url'] ?? '';

if ($nom_muntanya && $altura && $dificultat) {
    $_SESSION['muntanyes'][$id] = [
        'nom_muntanya' => $nom_muntanya,
        'altura' => $altura,
        'data_ascens' => $data_ascens,
        'dificultat' => $dificultat,
        'activitats' => $activitats,
        'imatge_url' => $imatge_url
    ];
}

header('Location: index.php');
exit;
