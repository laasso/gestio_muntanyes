<?php
session_start();

if (!isset($_SESSION['muntanyes'])) {
    $_SESSION['muntanyes'] = [];
}

$nom_muntanya = $_POST['nom_muntanya'] ?? '';
$altura = $_POST['altura'] ?? '';
$data_ascens = $_POST['data_ascens'] ?? '';
$dificultat = $_POST['dificultat'] ?? '';
$activitats = isset($_POST['activitats']) ? implode(", ", $_POST['activitats']) : '';
$foto_muntanya = $_POST['foto_muntanya'] ?? ''; 

if ($nom_muntanya && $altura && $data_ascens && $dificultat) {
    $id = uniqid();
    $_SESSION['muntanyes'][$id] = [
        'nom_muntanya' => $nom_muntanya,
        'altura' => $altura,
        'data_ascens' => $data_ascens,
        'dificultat' => $dificultat,
        'activitats' => $activitats,
        'foto_muntanya' => $foto_muntanya 
    ];
}

header('Location: index.php');
exit;
