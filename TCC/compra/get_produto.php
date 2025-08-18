<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die(json_encode(["erro" => "Erro de conexão"]));

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT * FROM produto WHERE id=$id");

    if ($res->num_rows > 0) {
        $produto = $res->fetch_assoc();
        echo json_encode($produto);
    } else {
        echo json_encode(["erro" => "Produto não encontrado"]);
    }
} else {
    echo json_encode(["erro" => "ID não fornecido"]);
}
?>
