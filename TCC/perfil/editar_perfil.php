<?php
session_start();

$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error)
    die("Erro: " . $conn->connect_error);

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id_usuarios'])) {
    die("Usuário não logado.");
}

$id = $_SESSION['usuario']['id_usuarios'];

$sql = "SELECT * FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['Nome'];
    $nome_usuario = $_POST['Nome_de_usuario'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $update = "UPDATE usuarios 
               SET Nome=?, Nome_de_usuario=?, cpf=?, telefone=?, email=?, senha=? 
               WHERE id_usuarios=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssssssi", $nome, $nome_usuario, $cpf, $telefone, $email, $senha, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location='perfil.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <style>
        :root {
            --azul-marinho: #1e3a8a;
            --azul-escuro: #0f2465;
            --fundo: #f5f7fa;
            --branco: #fff;
            --preto: #111;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background-color: var(--fundo);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 480px;
            background: var(--branco);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .container:hover {
            transform: translateY(-2px);
        }

        h2 {
            text-align: center;
            color: var(--azul-marinho);
            margin-bottom: 1.5rem;
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        label {
            display: block;
            margin-top: 12px;
            color: var(--preto);
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: all 0.2s ease-in-out;
            font-size: 15px;
        }

        input:focus {
            border-color: var(--azul-marinho);
            outline: none;
            box-shadow: 0 0 6px rgba(30, 58, 138, 0.3);
        }

        p {
            margin-top: 12px;
            font-size: 15px;
            color: #333;
        }

        button {
            width: 100%;
            background-color: var(--azul-marinho);
            color: var(--branco);
            border: none;
            padding: 12px;
            margin-top: 18px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background-color: var(--azul-escuro);
            transform: scale(1.02);
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.4rem;
            }

            input,
            button {
                font-size: 14px;
            }
        }
    </style>
</head>


<body>

    <div class="container">
        <h2>Editar Perfil</h2>
        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="Nome" value="<?= htmlspecialchars($usuario['Nome'] ?? 'não informado') ?>"
                required>

            <label>Nome de Usuário:</label>
            <input type="text" name="Nome_de_usuario"
                value="<?= htmlspecialchars($usuario['Nome_de_usuario'] ?? 'não informado') ?>" required>

            <label>CPF:</label>
            <input type="text" name="cpf" value="<?= htmlspecialchars($usuario['cpf'] ?? 'não informado') ?>" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($usuario['telefone'] ?? 'não informado') ?>"
                required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? 'não informado') ?>"
                required>

            <label>Senha:</label>
            <input type="password" name="senha" maxlength="20" placeholder="Digite a nova senha" required>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>

</html>