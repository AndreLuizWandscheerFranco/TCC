<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) {
    echo json_encode(["erro" => "Falha na conexão: " . $conn->connect_error]);
    exit;
}

$result = $conn->query("SELECT id, nome, valor, descricao, imagem, avaliacao FROM produto");

if (!$result) {
    echo json_encode(["erro" => "Erro na query: " . $conn->error]);
    exit;
}

$produtos = [];
while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

echo json_encode($produtos);
?>