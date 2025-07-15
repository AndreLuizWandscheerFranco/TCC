<?php
session_start(); 

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$email = $_POST['email'];
$senha = $_POST['senha'];

$res = $conn->query("SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'");

if ($res->num_rows > 0) {
    $_SESSION['usuario'] = $res->fetch_assoc(); 
    header("Location: ../Site/index.html");
    exit;
} else {
    die("Email ou senha estão errados.");
}

?>

