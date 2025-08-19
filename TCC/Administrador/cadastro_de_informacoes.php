<?php
session_start(); 

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

if (!isset($_SESSION['usuario']['id_usuarios'])) {
    die("Usuário não está logado.");
}

$id_usuario = $_SESSION['usuario']['id_usuarios'];

$nomecompleto = $_POST["nomecompleto"] ?? '';
$numerofone = $_POST["numerofone"] ?? '';
$cep = $_POST["cep"] ?? '';
$estado_cidade = $_POST["estado_cidade"] ?? '';
$bairro = $_POST["bairro"] ?? '';
$rua = $_POST["rua"] ?? '';
$numero = $_POST["numero"] ?? '';
$complemento = $_POST["complemento"] ?? '';

if (strpos($estado_cidade, ' - ') !== false) {
    list($estado, $cidade) = explode(" - ", $estado_cidade);
} else {
    $estado = '';
    $cidade = '';
}

$atualizar = $conn->prepare("UPDATE usuarios SET nome = ?, telefone = ?, cep = ?, estado = ?, cidade = ?, bairro = ?, rua = ?, numero = ?, complemento = ? WHERE id_usuarios = ?");
$atualizar->bind_param("sssssssssi", $nomecompleto, $numerofone, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento, $id_usuario);

if ($atualizar->execute()) {
    echo "Dados atualizados com sucesso!";
    header("Location: ../Site/index.html");
    exit();
} else {
    echo "Erro ao atualizar: " . $conn->error;
}
?>
