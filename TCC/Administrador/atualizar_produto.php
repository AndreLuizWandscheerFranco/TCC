<?php
$conn = new mysqli("localhost", "root", "root", "banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Corrigido para $_POST
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$fabricante = $_POST['fabricante'];
$descricao = $_POST['descricao'];
$avaliacao = $_POST['avaliacao'];
$id_pagamento = $_POST['id_pagamento'] ?: NULL;
$id = $_POST['id']; // O id do produto a ser atualizado

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

    $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $novo_nome = uniqid() . "." . $extensao;
    $caminho = "../imagens_produtos/" . $novo_nome;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {

        // Query corrigida
        $sql = "UPDATE produto SET nome = ?, valor = ?, fabricante = ?, descricao = ?, avaliacao = ?, imagem = ?, id_pagamento = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Tipos: s = string, d = double, i = integer
        $stmt->bind_param("sdssdssi", $nome, $valor, $fabricante, $descricao, $avaliacao, $caminho, $id_pagamento, $id);

        $stmt->execute();
        //die("rodou a SQL de atualizar: $id");
        // Redireciona após o update
        header("Location: ./tela_atualizar.html");
        exit();
    } else {
        die("Erro ao enviar a imagem.");
    }
} else {
    die("Nenhuma imagem enviada.");
}
?>
