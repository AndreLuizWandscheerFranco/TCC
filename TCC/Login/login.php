<?php
// Conexão
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Verifica login
if (isset($_POST['login'])) {
    $email = $_POST['email'];

    // Busca usuário pelo email
    $res = $conn->query("SELECT * FROM usuarios WHERE email='$email'");
    
    if ($res->num_rows > 0) {
        $_SESSION['usuario'] = $res->fetch_assoc();
        header("Location: painel.php");
        exit;
    } else {
        $erro = "Email não encontrado.";
    }
}

$email = $_POST["email"];
$senha = $_POST["senha"];


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login de Usuário</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Seu email" required>
        <button type="submit" name="login">Entrar</button>
    </form>
</body>
</html>