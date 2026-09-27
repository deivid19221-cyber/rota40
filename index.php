<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalizaBraz</title>
    <link rel="shortcut icon" href="imagens/mapa.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
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
            <p class="bemvindo">Bem-vindo <?php echo $_SESSION['username']; ?></p>
            <a href="logout.php"><button class="sair">Sair</button></a>
        </div>
    <?php else: ?>
        <div class="auto-buttons">
            <a href="login.php"><button class="login">Login</button></a>
            <a href="cadastro.html"><button class="cadastro">Cadastro</button></a>
        </div>
    <?php endif; ?>
</header>

<section class="hero">
    <video autoplay muted loop playsinline id="videoBmg">
        <source src="imagens/demo.mp4" type="video/mp4">
        Seu navegador não suporta a reprodução de vídeo.
    </video>
    <div class="overlay">
        <h1>Explore Brazlândia com LocalizaBraz</h1>
        <p>Compartilhe sua experiência em Brazlândia</p>
    </div>
</section>
<script>// script.js
const menuIcon = document.getElementById('menu-icon');
const navLinks = document.getElementById('nav-links');

menuIcon.addEventListener('click', () => {
    navLinks.classList.toggle('show'); // Alterna a classe "show" para exibir ou ocultar o menu
});
</script>
</body>
</html>
