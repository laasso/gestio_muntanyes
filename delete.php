<?php
session_start();

if (!isset($_SESSION['muntanyes'])) {
    $_SESSION['muntanyes'] = [];
}

$id = $_GET['id'] ?? '';

if ($id && isset($_SESSION['muntanyes'][$id])) {
    unset($_SESSION['muntanyes'][$id]);
}

header('Location: index.php');
exit;
