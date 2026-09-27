<?php
session_start();
require_once 'conexao.php';
// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário e limpar
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validar entrada
    if (empty($username) || empty($password)) {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    } else {
        // Consultar o usuário no banco de dados, incluindo verificação de conta ativa
        $sql = "SELECT * FROM usuario WHERE nome = ? AND ativo = 1"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verificar a senha
            if (password_verify($password, $user['senha'])) {
                // Iniciar a sessão e redirecionar
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['username'] = $user['nome']; 

                // Redireciona para a página do mapa
                header("Location: brazlandia.php");
                exit();
            } else {
                
                echo "<script>alert('Senha incorreta.');</script>";
            }
        } else {
            echo "<script>alert('Usuário não encontrado ou conta inativa.');</script>";
        }
        
    }
}

$conn->close();
?>
