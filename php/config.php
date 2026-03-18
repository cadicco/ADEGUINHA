<?php
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = "abcd";     // Senha padrão do XAMPP
$dbname = "adeguinha";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
// echo "Conectado com sucesso!"; // Descomente para testar a conexão
?>