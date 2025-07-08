<?php
    
    $conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
     if ($conn->connect_error) die("Erro: " . $conn->connect_error);
    
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    echo("$nome");
    echo("$email");
    echo("$senha");
 
    $verifica = $conn->prepare("SELECT id_usuarios FROM usuarios WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows > 0) {
        echo "Este e-mail já está cadastrado.";
        exit(); 
    }

    $inserir = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $inserir->bind_param("sss", $nome, $email, $senha);

    if ($inserir->execute()) {
        header("Location: ../Site/index.html");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }

    $verifica->close(); 
    $inserir->close();
    $conn->close();
?>