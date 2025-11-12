<?php
$conn = new mysqli("localhost", "root", "root", "Banco_de_dados");
if ($conn->connect_error)
    die("Erro: " . $conn->connect_error);
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id_usuarios'])) {
    die("Usuário não logado.");
}

$id = $_SESSION['usuario']['id_usuarios'];

$sql = "SELECT cep, rua, bairro, complemento, numero, cidade, estado FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$endereco = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $update = "UPDATE usuarios 
               SET cep=?, rua=?, bairro=?, complemento=?, numero=?, cidade=?, estado=?
               WHERE id_usuarios=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("sssssssi", $cep, $rua, $bairro, $complemento, $numero, $cidade, $estado, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Endereço atualizado com sucesso!'); window.location='perfil.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar endereço.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Endereço</title>
    <style>
        :root {
            --azul-marinho: #1e3a8a;
            --azul-escuro: #0f2465;
            --fundo: #f5f7fa;
            --branco: #fff;
            --preto: #111;
            --cinza: #6c757d;
            --cinza-escuro: #5a6268;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background-image: linear-gradient(45deg, var(--azul-escuro), var(--azul-marinho));
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

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 20px;
        }

        .cancel-button,
        .save-button {
            flex: 1;
            text-align: center;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .cancel-button {
            background-color: var(--cinza);
            color: var(--branco);
            text-decoration: none;
        }

        .cancel-button:hover {
            background-color: var(--cinza-escuro);
            transform: scale(1.03);
        }

        .save-button {
            background-color: var(--azul-marinho);
            color: var(--branco);
        }

        .save-button:hover {
            background-color: var(--azul-escuro);
            transform: scale(1.03);
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

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Editar Endereço</h2>
        <form method="POST">
            <label>CEP:</label>
            <input type="text" name="cep" value="<?= htmlspecialchars($endereco['cep'] ?? 'não informado') ?>" required>

            <label>Rua:</label>
            <input type="text" name="rua" value="<?= htmlspecialchars($endereco['rua'] ?? 'não informado') ?>" required>

            <label>Bairro:</label>
            <input type="text" name="bairro" value="<?= htmlspecialchars($endereco['bairro'] ?? 'não informado') ?>"
                required>

            <label>Complemento:</label>
            <input type="text" name="complemento"
                value="<?= htmlspecialchars($endereco['complemento'] ?? 'não informado') ?>">

            <label>Número:</label>
            <input type="text" name="numero" value="<?= htmlspecialchars($endereco['numero'] ?? 'não informado') ?>"
                required>

            <label>Cidade:</label>
            <input type="text" name="cidade" value="<?= htmlspecialchars($endereco['cidade'] ?? 'não informado') ?>"
                required>

            <label>Estado:</label>
            <input type="text" name="estado" value="<?= htmlspecialchars($endereco['estado'] ?? 'não informado') ?>"
                required>

            <div class="button-group">
                <a href="../Site/index.html" class="cancel-button">Cancelar</a>
                <button type="submit" class="save-button">Salvar Alterações</button>
            </div>
        </form>
    </div>
</body>

</html>