<?php
include 'config.php'; // Inclui as configurações de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash da senha para segurança
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Verificar se o usuário ou email já existem
    $sql_check = "SELECT id FROM usuarios WHERE username = ? OR email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "Erro: Nome de usuário ou email já cadastrado. <a href='../cadastro.html'>Voltar</a>";
    } else {
        // Preparar a instrução SQL para inserir o usuário
        $sql_insert = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);

        // Vincular parâmetros e executar
        // "sss" indica que todos os parâmetros são strings
        $stmt_insert->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt_insert->execute()) {
            echo "Cadastro realizado com sucesso! <a href='../login.html'>Faça login</a>";
        } else {
            echo "Erro ao cadastrar: " . $stmt_insert->error . " <a href='../cadastro.html'>Voltar</a>";
        }

        $stmt_insert->close();
    }
    $stmt_check->close();
} else {
    echo "Método não permitido. <a href='../cadastro.html'>Voltar</a>";
}

$conn->close(); // Fecha a conexão com o banco de dados
?>