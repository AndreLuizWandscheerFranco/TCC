<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario']['id_usuarios'])) {
    echo json_encode(["erro" => "Usuário não logado"]);
    exit;
}

$id = intval($_SESSION['usuario']['id_usuarios']);
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) {
    echo json_encode(["erro" => "Erro de conexão"]);
    exit;
}

$res = $conn->query("SELECT estado, cidade FROM usuarios WHERE id_usuarios=$id");

if ($res && $res->num_rows > 0) {
    $endereco = $res->fetch_assoc();
    echo json_encode([
        "estado" => $endereco['estado'],
        "cidade" => $endereco['cidade']
    ]);
} else {
    echo json_encode(["erro" => "Endereço não encontrado"]);
}

?>
