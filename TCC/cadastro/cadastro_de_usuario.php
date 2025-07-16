<?php
session_start(); 
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$nome_de_usuario = $_POST["nome_de_usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];

$verifica = $conn->prepare("SELECT id_usuarios FROM usuarios WHERE email = ?");
$verifica->bind_param("s", $email);
$verifica->execute();
$resultado = $verifica->get_result();

if ($resultado->num_rows > 0) {
    echo "Este e-mail já está cadastrado.";
    exit(); 
}

$inserir = $conn->prepare("INSERT INTO usuarios (nome_de_usuario, email, senha, cpf) VALUES (?, ?, ?, ?)");
$inserir->bind_param("ssss", $nome_de_usuario, $email, $senha, $cpf);

if ($inserir->execute()) {

    $id_usuario = $conn->insert_id;

    $_SESSION['usuario'] = ['id_usuarios' => $id_usuario];

    header("Location: ../Site/index.html");
    exit();
} else {
    echo "Erro: " . $conn->error;
}

$verifica->close(); 
$inserir->close();
$conn->close();
?>
