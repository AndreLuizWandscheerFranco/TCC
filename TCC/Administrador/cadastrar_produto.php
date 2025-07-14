<?php
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$nome = $_POST['nome'];
$valor = $_POST['valor'];
$fabricante = $_POST['fabricante'];
$descricao = $_POST['descricao'];
$avaliacao = $_POST['avaliacao'];
$id_pagamento = $_POST['id_pagamento'] ?: NULL; 

$imagem = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));

$sql = "INSERT INTO produto (nome, valor, fabricante, descricao, avaliacao, imagem, id_pagamento)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdssdsi", $nome, $valor, $fabricante, $descricao, $avaliacao, $imagem, $id_pagamento);
$stmt->execute();

header("Location: ./cadastro_de_produtos.html");
    exit();
?>
