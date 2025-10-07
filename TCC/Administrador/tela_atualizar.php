<?php 

session_start();

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

/*if (!isset($_SESSION['produto']['id_produto'])) {
    header("Location: ../Login/login.html");
    exit;
}*/

$id_usuario = $_SESSION['produto']['id_produto'];

$stmt = $conn->prepare("SELECT nome, valor, fabricante, descricao, avaliacao, imagem, id_pagamento FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id_produto);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar produto</title>
    <link rel="shortcut icon" href="../imagens/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="atualizar.css">
</head>
<body>
<body>


    <div class="form-container">
        <h2>Cadastro de Produto</h2>
        <form action="atualizar_produto.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome do produto" required>
            <input type="number" name="valor" placeholder="Valor (R$)" step="0.01" required>
            <input type="text" name="fabricante" placeholder="Fabricante" required>
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="file" name="imagem" accept="image/*" required>
            <input type="number" name="avaliacao" placeholder="Avaliação (1 a 5)" min="1" max="5" required>
            <input type="number" name="id_pagamento" placeholder="ID do pagamento (opcional)">

            <div class="botoes-form">
                <button type="button" class="btn-cancelar"
                    onclick="window.location.href='./index.html'">Cancelar</button>
                <button type="submit" class="btn-enviar">Atualizar</button>
            </div>
        </form>
    </div>
  
</body>
</html>