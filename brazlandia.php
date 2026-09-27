<?php  
session_start(); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalizaBraz - Mapa</title>
    <link rel="shortcut icon" href="imagens/mapa.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/mapa.css"> 
</head>
<body>

<header>
    <div class="logo"> 
        <img src="imagens/logoo.png" alt="logoo" id="logoo"> LocalizaBraz
    </div>
    <div class="menu-icon" id="menu-icon">&#9776;</div> <!-- Ícone do menu -->
    <nav>
    <ul id="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="brazlandia.php">Mapa</a></li>
            <li><a href="transporte.php">Transporte</a></li>
            <li><a href="galeriadefotos.php">Galeria</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="tutorial.php">Tutoriais</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'): ?>
                <li><a href="admin.php">Admin</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php if (isset($_SESSION['username'])): ?>
        <div class="logado">
            <p class="bemvindo">Bem - Vindo: <?php echo $_SESSION['username'];?></p>
            <a href="logout.php"><button class="sair">Sair</button></a>
        </div>
    <?php else: ?>
        <div class="auto-buttons">
            <a href="login.php"><button class="login">Login</button></a>
            <a href="cadastro.html"><button class="cadastro">Cadastro</button></a>
        </div>
    <?php endif; ?>
</header>

<div class="search-container">
    <button id="search-icon" onclick="toggleFilterButtons()">
        <img src="imagens/lupa.png" alt="Lupa" class="lupa-icon">
    </button>
    <div id="filter-buttons" class="hidden" style="display: none;">
    <button onclick="filterMarkers(false, 1)">Comes e Bebes</button>
    <button onclick="filterMarkers(false, 2)">Comércio</button>
    <button onclick="filterMarkers(false, 3)">Mercado/Feira</button>
    <button onclick="filterMarkers(false, 4)">Lazer</button>
    <button onclick="filterMarkers(false, 5)">Serviços Públicos</button>
    <button onclick="filterMarkers(false, 6)">Pontos Turísticos</button>
    <button onclick="filterMarkers(false, 'all')">Mostrar Todos</button>
    <button onclick="filterMarkers(true, 'all')">Somente Eventos</button>
</div>

</div>

<?php if (!isset($_SESSION['username'])): ?>
    <p class="login-message">Você precisa estar logado para adicionar um marcador.</p>
<?php else: ?>
<div class="form-containerr" id="markerForm" style="display: none;">
    <h2>Adicionar Marcador</h2>
    <button class="btn-close" onclick="closeForm('markerForm')">X</button>

    <div class="icon-explanation">
        <div class="icon-item">
            <img src="imagens/icone_vermelho.png" alt="Ícone Vermelho">
            <p>Referência</p>
        </div>
        <div class="icon-item">
            <img src="imagens/icone_amarelo.png" alt="Ícone Amarelo">
            <p>Seu Marcador <br>Quando estiver logado</p>
        </div>
        <div class="icon-item">
            <img src="imagens/icone_azul.png" alt="Ícone Azul">
            <p>Outros <br>Usuários</p>
        </div>
        <div class="icon-item">
            <img src="imagens/estrela.png" alt="Ícone Estrela">
            <p>Evento</p>
        </div>
    </div>

    <form id="addMarkerForm">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="image">URL da Imagem (Opcional):</label>
        <input type="text" id="image" name="image">

        <label for="category">Categoria:</label>
<select id="category" name="category" required>
    <option value="1">Comes e Bebes</option>
    <option value="2">Comércio</option>
    <option value="3">Mercado/Feira</option>
    <option value="4">Lazer</option>
    <option value="5">Serviços Públicos</option>
    <option value="6">Ponto Turístico</option>
</select>

        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'): ?>
            <label for="evento">É um Evento?</label>
            <input type="checkbox" id="evento" name="evento" value="1">
        <?php endif; ?>

        <button type="submit">Adicionar Marcador</button>
    </form>
</div>
<?php endif; ?>


<div class="form-container" id="editMarkerForm" style="display: none;">
    <h2>Editar Marcador</h2>
    <button class="btn-close" onclick="closeForm('editMarkerForm')">X</button>
    <form id="editForm">
        <label for="editName">Nome:</label>
        <input type="text" id="editName" name="editName" required>

        <label for="editDescription">Descrição:</label>
        <textarea id="editDescription" name="editDescription" required></textarea>

        <label for="editImage">URL da Imagem:</label>
        <input type="text" id="editImage" name="editImage">

        <button type="submit">Salvar Edição</button>
    </form>
</div>



<div id="map" style="width: 100vw; height: 100vh;"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> 
<script>
    var loggedInUserId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
</script>
<script>// script.js
const menuIcon = document.getElementById('menu-icon');
const navLinks = document.getElementById('nav-links');

menuIcon.addEventListener('click', () => {
    navLinks.classList.toggle('show'); // Alterna a classe "show" para exibir ou ocultar o menu
});
</script>
<script src="mapa.js"></script>
</body>
</html>  
