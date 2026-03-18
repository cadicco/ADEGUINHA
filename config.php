<?php
$servername = "localhost";
$username_db = "root"; // Usuário padrão do XAMPP
$password_db = "";     // Senha padrão do XAMPP
$dbname = "adega_db";

// Criar conexão
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
// echo "Conectado com sucesso!"; // Descomente para testar a conexão
?>