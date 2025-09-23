<?php
$conn = new mysqli("localhost", "root", "root", "banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

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

        $sql = " UPDATE produto (nome, valor, fabricante, descricao, avaliacao, imagem, id_pagamento)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdssdsi", $nome, $valor, $fabricante, $descricao, $avaliacao, $caminho, $id_pagamento);
        $stmt->execute();
        
        header("Location: ./tela_atualiar.html");
        exit();
    } else {
        die("Erro ao enviar a imagem.");
    }
} else {
    die("Nenhuma imagem enviada.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>




<H1>iqrfboirgfiyg3</H1>



  <style>@import url("https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600;700&display=swap");

:root {
    --blue: #021130;
    --medlightblue: #1c4588;
    --lightblue: #3c81c6;
    --white: #ffff;
    --light-gray: #ececec;
    --deep-gray: #343434;
    --medium-gray: #a7a7a7;
    --whitesmoke: whitesmoke;
    --black: #000000;
    --gray: #c4c4c4;
}

body {
    background: linear-gradient(135deg, var(--blue), var(--medlightblue));
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: "Lexend Deca", sans-serif;
}

.form-container {
    background-color: var(--white);
    padding: 30px 50px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(2, 17, 48, 0.5);
    width: 100%;
    max-width: 600px;
    text-align: center;
}

h2 {
    color: var(--blue);
    font-weight: 600;
    margin-bottom: 25px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 10px 18px;
    border: 1.8px solid var(--gray);
    border-radius: 6px;
    font-size: 17px;
    font-weight: 600;
    color: var(--deep-gray);
    background-color: var(--light-gray);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    outline: none;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="file"]:focus {
    border-color: var(--lightblue);
    background-color: var(--whitesmoke);
    box-shadow: 0 0 8px var(--lightblue);
}

button {
    border-radius: 6px;
    padding: 12px 0;
    background-color: var(--lightblue);
    color: var(--white);
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    font-size: 17px;
}

button:hover {
    background-color: var(--medlightblue);
    box-shadow: 0 0 12px var(--medlightblue);
}

.botoes-form {
    display: flex;
    gap: 40px;
    justify-content: center;
    margin-top: 20px;
}

.btn-enviar,
.btn-cancelar {
    border-radius: 6px;
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
    width: 200px;
}

.btn-enviar {
    background-color: var(--lightblue);
    color: var(--white);
    box-shadow: 0 0 12px var(--gray);
}

.btn-enviar:hover {
    background-color: var(--medlightblue);
}

.btn-cancelar {
    background-color: var(--gray);
    color: var(--white);
}

.btn-cancelar:hover {
    background-color: var(--medium-gray);
}</style>  
</body>
</html>