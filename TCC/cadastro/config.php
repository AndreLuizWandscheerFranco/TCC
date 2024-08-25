<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'usuarios';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    if($conexao->connect_errno)
    {
        echo "erro";
    }
    else
    {
        echo "sucesso";
    }

    if(isset($_POST['submit']))
    {
        
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,email,senha) VALUES('$nome','$email','$senha')");

        if ($result) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
        }

    }
?>;