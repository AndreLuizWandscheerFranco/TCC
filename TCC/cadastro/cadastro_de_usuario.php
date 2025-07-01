<?php
    
    // Conexão
    $conn = new mysqli("localhost", "root", "root", "exemplo");
     if ($conn->connect_error) die("Erro: " . $conn->connect_error);
    
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    

    
    echo("$nome");
    echo("$email");
    echo("$senha");
 
    //Monta uma string com inserção 
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email' , '$senha')";
    
    
    
    //Executa no banco de dados
    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!<br><a href='listar.php'>Ver lista</a>";
    } else {
        echo "Erro: " . $conn->error;
    }
?>