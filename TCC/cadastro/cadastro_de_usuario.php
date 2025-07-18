<?php
session_start();

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$nome_de_usuario = $_POST["nome_de_usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$tipo = $_POST["tipo"];

$sql = "INSERT INTO usuarios (Nome_de_usuario, email, senha, tipo) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome_de_usuario, $email, $senha, $tipo);

if ($stmt->execute()) {
    $id_usuarios = $conn->insert_id;

    $_SESSION['usuario'] = [
        'id_usuarios' => $id_usuarios,
        'nome_de_usuario' => $nome_de_usuario,
        'email' => $email,
        'tipo' => $tipo
    ];

    if ($tipo == 'admin') {
        header("Location: ../Administrador/index.html");
    } else {
        header("Location: ../Site/index.html");
    }
    exit;
} else {
    echo "Erro no cadastro: " . $stmt->error;
}
?>

