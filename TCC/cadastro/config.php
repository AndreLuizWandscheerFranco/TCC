<?php
$servidor = "localhost"; // Ou o IP do seu servidor MySQL
$usuario = "root"; // Usuário do banco de dados
$senha = ""; // Senha do banco de dados (mantenha vazia se estiver usando XAMPP)
$banco = "auza_db"; // Nome do banco de dados

// Criar a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>;