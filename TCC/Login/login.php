<?php
// Conexão
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Verifica login
$email = $_POST['email'];
$senha = $_POST['senha'];

// Busca usuário pelo email
$res = $conn->query("SELECT * FROM usuarios WHERE email='$email' and senha = '$senha'");

if ($res->num_rows > 0) {
        $_SESSION['usuario'] = $res->fetch_assoc();
        header("Location: ../Site/index.html");
        exit;
    } else {
        $erro = "Email ou senha estão errados.";
        die($erro);
    }




?>

