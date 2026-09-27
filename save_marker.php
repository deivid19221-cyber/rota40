<?php 
session_start();
include 'conexao.php'; 

// Obtém os dados JSON enviados
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados foram recebidos corretamente
if (is_null($data)) {
    echo json_encode(['status' => 'error', 'message' => 'Dados inválidos recebidos.']);
    exit;
}

// Verifica se as chaves estão definidas
if (!isset($data['name'], $data['description'], $data['latitude'], $data['longitude'], $data['image_url'], $data['categoria'])) {
    echo json_encode(['status' => 'error', 'message' => 'Dados incompletos.']);
    exit;
}

// Atribui os valores
$name = $data['name'];
$description = $data['description'];
$latitude = $data['latitude'];
$longitude = $data['longitude'];
$image_url = $data['image_url'];
$categoria = $data['categoria']; 

// Insere os dados no banco de dados
$query = "INSERT INTO marcadores (nome, descriptionn, latitude, longitude, imgurl, user_id, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao preparar a consulta: ' . $conn->error]);
    exit;
}

// Atualiza bind_param para incluir categoria
$stmt->bind_param('ssddsii', $name, $description, $latitude, $longitude, $image_url, $_SESSION['user_id'], $categoria);

// Executa a inserção
if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();


?> 
