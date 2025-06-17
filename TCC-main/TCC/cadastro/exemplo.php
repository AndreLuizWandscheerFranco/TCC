<?php
// Conexão
$conn = new mysqli("localhost", "root", "root", "exemplo");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Inserção
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!<br><a href='listar.php'>Ver lista</a>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<h2>Cadastro de Usuário</h2>
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Email: <input type="email" name="email" required><br>
    <button type="submit">Cadastrar</button>
</form>