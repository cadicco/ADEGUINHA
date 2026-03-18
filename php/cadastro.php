<?php
session_start(); // Inicia a sessão para armazenar informações do usuário logado
include 'config.php'; // Inclui as configurações de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username_adeg'];
    $password = $_POST['password_adeg'];

    // Buscar o usuário pelo nome de usuário ou email
    $sql = "SELECT id, username_adeg, password_adeg FROM usuarios WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Pega os dados do usuário

        // Verificar a senha
        if (password_verify($password, $username['password_adeg'])) {
            // Login bem-sucedido!
            $_SESSION['id'] = $user['id'];
            $_SESSION['username_adeg'] = $user['username_adeg'];
            echo "Login bem-sucedido! Bem-vindo, " . $user['username_adeg'] . "! Redirecionando...";
            // Redirecionar para uma página protegida ou dashboard
            // header("Location: dashboard.php"); // Exemplo de redirecionamento
            echo "<meta http-equiv='refresh' content='3;url=../index.html'>"; // Redireciona após 3 segundos para index.html
        } else {
            echo "Senha incorreta. <a href='../login.html'>Tente novamente</a>";
        }
    } else {
        echo "Nome de usuário ou email não encontrado. <a href='../login.html'>Tente novamente</a>";
    }

    $stmt->close();
} else {
    echo "Método não permitido. <a href='../login.html'>Voltar</a>";
}

$conn->close(); // Fecha a conexão com o banco de dados
?>