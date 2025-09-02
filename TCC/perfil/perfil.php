<?php
session_start();

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

if (!isset($_SESSION['usuario']['id_usuarios'])) {
    header("Location: ../Login/login.html");
    exit;
}

$id_usuario = $_SESSION['usuario']['id_usuarios'];

$stmt = $conn->prepare("SELECT Nome_de_usuario, email, nome, telefone, cep, estado, cidade, bairro, rua, numero, complemento FROM usuarios WHERE id_usuarios = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil do Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .perfil-box {
      background-color: #1e1e2f;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
      max-width: 500px;
      width: 100%;
    }

    .perfil-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #00d4ff;
    }

    .perfil-box p {
      margin: 10px 0;
      font-size: 15px;
    }

    .perfil-box .label {
      font-weight: bold;
      color: #00d4ff;
    }

    .logout-button {
      margin: 30px auto 0;
      padding: 10px 20px;
      background-color: #ff4d4d;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
       width:100px;
      height:40px;
      text-align:center;
      margin-right:100px;
    }

     .cancelar {
      width:100px;
      height:40px;
      margin: 30px auto 0;
      padding: 10px 20px;
      background-color: #eeee;
      color: gray;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
      transition: color 0.3s ease;
      text-align:center;
      margin-left:100px;
    }

    .buttons_div{
      width:100%;
      height:120px;
      display:flex;
      flex-direction: row;
      justify-content:center;
      align-items:center;
      justify-content:space-between;
    }

    .logout-button:hover {
      background-color: #e60000;
    }

    .cancelar:hover {
      background-color: lightgrey;
      color:white;
    }

  </style>
</head>
<body>

<div class="perfil-box">
  <h2><i class="bi bi-person-circle"></i> Perfil do Usuário</h2>

  <p><span class="label">Nome de Usuário:</span> <?= htmlspecialchars($usuario['Nome_de_usuario'] ?? 'Não informado') ?></p>
  <p><span class="label">Email:</span> <?= htmlspecialchars($usuario['email'] ?? 'Não informado') ?></p>
  <p><span class="label">Nome completo:</span> <?= htmlspecialchars($usuario['nome'] ?? 'Não informado') ?></p>
  <p><span class="label">Telefone:</span> <?= htmlspecialchars($usuario['telefone'] ?? 'Não informado') ?></p>
  <p><span class="label">CEP:</span> <?= htmlspecialchars($usuario['cep'] ?? 'Não informado') ?></p>
  <p><span class="label">Estado:</span> <?= htmlspecialchars($usuario['estado'] ?? 'Não informado') ?></p>
  <p><span class="label">Cidade:</span> <?= htmlspecialchars($usuario['cidade'] ?? 'Não informado') ?></p>
  <p><span class="label">Bairro:</span> <?= htmlspecialchars($usuario['bairro'] ?? 'Não informado') ?></p>
  <p><span class="label">Rua:</span> <?= htmlspecialchars($usuario['rua'] ?? 'Não informado') ?></p>
  <p><span class="label">Número:</span> <?= htmlspecialchars($usuario['numero'] ?? 'Não informado') ?></p>
  <p><span class="label">Complemento:</span> <?= htmlspecialchars($usuario['complemento'] ?? 'Não informado') ?></p>
  <p><span class="label">Senha:</span> ********</p>

  <form method="post" action="../Login/logout.php">
    <div class="buttons_div">
      <button type = "button" onclick="cancelar()" class= "cancelar">Cancelar</button>
      <button type="submit" class="logout-button">Sair</button>
    </div>
  </form>
</div>

<script>
    function cancelar() {
        window.location.href = "../Site/index.html";
    }
</script>

</body>
</html>
