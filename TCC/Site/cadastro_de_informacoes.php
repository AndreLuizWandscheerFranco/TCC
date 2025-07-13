<?php
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

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

$verifica = $conn->prepare("SELECT id_usuarios FROM usuarios WHERE nome = ? AND telefone = ? AND cep = ? AND estado = ? AND cidade = ? AND bairro = ? AND rua = ? AND numero = ? AND complemento = ?");
$verifica->bind_param('sssssssss', $nomecompleto, $numerofone, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento);
$verifica->execute();
$resultado = $verifica->get_result();

if ($resultado && $resultado->num_rows > 0) {
    echo "Endereço já cadastrado!";
    exit();
}

$inserir = $conn->prepare("INSERT INTO usuarios (nome, telefone, cep, estado, cidade, bairro, rua, numero, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$inserir->bind_param("sssssssss", $nomecompleto, $numerofone, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento);

if ($inserir->execute()) {
    header("Location: ../compra/index.html");
    exit();
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>
