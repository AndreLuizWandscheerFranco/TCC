<?php
    $conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
     if ($conn->connect_error) die("Erro: " . $conn->connect_error);

$nomecompleto = $_POST["nomecompleto"];
$numerofone = $_POST["numerofone"];
$cep = $_POST["cep"];
$estado_cidade = $_POST["estado_cidade"];
$bairro = $_POST["bairro"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$complemento = $_POST["complemento"];

list($cidade, $estado) = explode(" - ", $estado_cidade);

$verifica = $conn->prepare("SELECT id_usuarios FROM usuarios WHERE nome = ? AND telefone = ? AND cep = ? AND estado = ? AND cidade = ? AND bairro = ? AND numero = ? AND complemento = ?");
$verifica->bind_param("ssssssss", $nomecompleto, $numerofone, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows > 0) {
        echo "endereço já cadastrado!";
        exit(); 
    }

     $inserir = $conn->prepare("INSERT INTO usuarios (nome, telefone, cep, cidade, estado, bairro, rua, numero,complemento, ) VALUES (?, ?, ?)");
     $inserir->bind_param("sssssssss", $nomecompleto, $numerofone, $cep, $cidade, $estado, $bairro, $rua, $numero, $complemento);

       if ($inserir->execute()) {
        header("Location: ../compra/index.html");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
?>