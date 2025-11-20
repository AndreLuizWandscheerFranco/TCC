<?php
$conn = new mysqli("localhost", "root", "root", "banco_de_dados");
if ($conn->connect_error)
    die("Erro: " . $conn->connect_error);

$nome = $_POST['nome'];
$valor = $_POST['valor'];
$fabricante = $_POST['fabricante'];
$descricao = $_POST['descricao'];
$avaliacao = $_POST['avaliacao'];
$id_pagamento = $_POST['id_pagamento'] ?: NULL;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

    $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $novo_nome = uniqid() . "." . $extensao;
    $caminho = "../imagens_produtos/" . $novo_nome;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {

        $sql = "INSERT INTO produto (nome, valor, fabricante, descricao, avaliacao, imagem, id_pagamento)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdssdsi", $nome, $valor, $fabricante, $descricao, $avaliacao, $caminho, $id_pagamento);
        $stmt->execute();

        header("Location: ./cadastro_de_produtos.html");
        exit();
    } else {
        die("Erro ao enviar a imagem.");
    }

} else {
    die("Nenhuma imagem enviada.");
}
?>