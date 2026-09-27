<?php
session_start();
require_once 'conexao.php';

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém a categoria do parâmetro de consulta 
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Monta a consulta SQL base para todos os marcadores ativos
$sql = "
    SELECT m.*, u.user_type 
    FROM marcadores m 
    INNER JOIN usuario u ON m.user_id = u.id_usuario 
    WHERE u.ativo = 1
";

// Adiciona condição de filtro de categoria, se uma categoria específica for solicitada
if ($category && $category != 'all') {
    $sql .= " AND m.category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category);  
} else {
    
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$markers = [];

// Preenche a lista de marcadores
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $markers[] = $row;
    }
}

// Retornar os dados como JSON
header('Content-Type: application/json');
echo json_encode($markers);

$stmt->close();
$conn->close();
?>
