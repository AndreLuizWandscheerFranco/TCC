<?php
session_start();
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die(json_encode(['nome' => null, 'tipo' => null]));

if (!isset($_SESSION['usuario']['id_usuarios'])) {
    echo json_encode(['nome' => null, 'tipo' => null]);
    exit;
}

$id = $_SESSION['usuario']['id_usuarios'];
$res = $conn->query("SELECT Nome_de_usuario, tipo FROM usuarios WHERE id_usuarios = $id");

if ($res && $res->num_rows > 0) {
    $dados = $res->fetch_assoc();
    echo json_encode([
        'nome' => $dados['Nome_de_usuario'],
        'tipo' => $dados['tipo']
    ]);
} else {
    echo json_encode(['nome' => null, 'tipo' => null]);
}
?>
