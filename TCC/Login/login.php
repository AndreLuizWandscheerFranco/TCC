<?php
// Conexão
$conn = new mysqli("localhost", "root", "root", "exemplo");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$email = $_POST["email"];
$senha = $_POST["senha"];

//Monta uma string com inserção 
$sql = "INSERT INTO usuarios ( email, senha) VALUES ( '$email' , '$senha')";

// Consulta
$resultado = $conn->query("SELECT * FROM usuarios");

?>