<?php
session_start();
header('Content-Type: application/json');

if(isset($_SESSION['usuario'])) {
    echo json_encode(['logado' => true]);
} else {
    echo json_encode(['logado' => false]);
}
?>
