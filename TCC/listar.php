<?php
// Conexão
$conn = new mysqli("localhost", "root", "root", "exemplo");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Consulta
$resultado = $conn->query("SELECT * FROM usuarios");

echo "<h2>Lista de Usuários</h2>";

if ($resultado->num_rows > 0) {
    echo "<ul>";
    while ($linha = $resultado->fetch_assoc()) {
        echo "<li>{$linha['nome']} ({$linha['email']})</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhum usuário cadastrado.";
}
?>
