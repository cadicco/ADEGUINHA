<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username_or_email = $_POST['username_adeg'];
    $password = $_POST['password_adeg'];

    // Query segura
    $sql = "SELECT id, username_adeg, password_adeg FROM usuarios WHERE username_adeg = ? OR email_adeg = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Verifica a senha criptografada
        if (password_verify($password, $user['password_adeg'])) {

            // Cria sessão
            $_SESSION['id'] = $user['id'];
            $_SESSION['username_adeg'] = $user['username_adeg'];

            // Redireciona (SEM echo antes!)
            header("Location: dashboard.php");
            exit;

        } else {
            echo "Senha incorreta!";
        }

    } else {
        echo "Usuário não encontrado!";
    }

    $stmt->close();
    $conn->close();
}
?>