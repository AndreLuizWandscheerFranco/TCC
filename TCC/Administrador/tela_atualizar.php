<?php 

session_start();

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);


$id_usuario = $_SESSION['usuario']['id_usuarios'];

$id_produto = $_POST["codigo"];

$stmt = $conn->prepare("SELECT nome, valor, fabricante, descricao, avaliacao, imagem, id_pagamento FROM produto WHERE id = ?");
$stmt->bind_param("i", $id_produto);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$nome = $usuario["nome"];
$valor = $usuario["valor"];
$fabricante = $usuario["fabricante"];
$descricao = $usuario["descricao"];
$avaliacao = $usuario["avaliacao"];
$imagem = $usuario["imagem"];


//print_r($usuario);
//die()


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
            <input type="text" name="nome" value= "<?php echo($nome);?>" placeholder="Nome do produto" required>
            <input type="number" name="valor" value= "<?php echo($valor);?>" placeholder="Valor (R$)" step="0.01" required>
            <input type="text" name="fabricante" value= "<?php echo($fabricante);?>" placeholder="Fabricante" required>
            <input type="text" name="descricao" value= "<?php echo($descricao);?>" placeholder="Descrição" required>
            <input type="file" name="imagem" value= "<?php echo($imagem);?>" accept="image/*" required>
            <input type="number" name="avaliacao" value= "<?php echo($avaliacao);?>" placeholder="Avaliação (1 a 5)" min="1" max="5" required>
            <input type="number" name="id_pagamento" value= "<?php echo($nome);?>" placeholder="ID do pagamento (opcional)">

            <div class="botoes-form">
                <button type="button" class="btn-cancelar"
                    onclick="window.location.href='./index.html'">Cancelar</button>
                <button type="submit" class="btn-enviar">Atualizar</button>
            </div>
        </form>
    </div>
  
</body>
</html>