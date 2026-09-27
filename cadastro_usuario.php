<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root'; 
$password = ''; 
$database = 'mark'; 
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se as chaves existem no array $_POST
    if (isset($_POST['usuario'], $_POST['email'], $_POST['nascimento'], $_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $nascimento = $_POST['nascimento'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
        $user_type = 'user';

        // Inserir os dados do usuário no banco de dados
        $stmt = $conn->prepare("INSERT INTO usuario (nome, email, data_nascimento, senha, user_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $usuario, $email, $nascimento, $senha, $user_type);

        if ($stmt->execute()) {
            // Redirecionar para a página de login após o cadastro
            header('Location: login.php');
            exit();
        } else {
            echo "Erro ao cadastrar o usuário.";
        }

        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}

$conn->close();
?>
