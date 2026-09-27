<?php 
session_start(); // Iniciar a sessão

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalizaBraz - Galeria</title>
    <link rel="shortcut icon" href="imagens/mapa.png" type="image/x-icon">
    <link rel="stylesheet" href="css/galeria.css">
   
</head>
<body>
<header>
<div class="logo"> <img src="imagens/logoo.png" alt="logoo" id="logoo" >LocalizaBraz</div>
    <nav>
        <ul>
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
            <p class="bemvindo">Bem - Vindo <?php echo $_SESSION['username'];?></p>
            <a href="logout.php"><button class="sair">Sair</button></a>
        </div>
    <?php else: ?>
        <div class="auto-buttons">
            <a href="login.php"><button class="login">Login</button></a>
            <a href="cadastro.html"><button class="cadastro">Cadastro</button></a>
        </div>
    <?php endif; ?>
</header>

    <div class="gallery-container">
        
        <div class="section">
            <h1>Galeria de Fotos de Brazlândia</h1>
            <h2>Pontos Turísticos</h2>
            <div class="gallery">
                <div class="image-card">
                    <img src="imagens/lago.png" alt="Ponto Turístico 1">
                    <h3>Lago Veredinha</h3>
                    <p>Carinhosamente chamada pelos moradores de Espelho D'água, o Lago Veredinha é um dos locais mais belos da paisagem de Brazlândia.</p>
                </div>
                <div class="image-card">
                    <img src="imagens/igreja.png" alt="Ponto Turístico 2">
                    <h3>Igreja Menino Jesus</h3>
                    <p>O Santuário Arquidiocesano Menino Jesus é um templo da igreja católica, situado em Brazlândia, no Distrito Federal.</p>
                </div>
                <div class="image-card">
                    <img src="imagens/escola.png" alt="Ponto Turístico 3">
                    <h3>Escola Técnica Deputado juarezão</h3>
                    <p>Local focado no ensino profissionalizante/técnico voltado à demanda do mercado.</p>
                </div>
                <div class="image-card">
                    <img src="imagens/rodeador.png" alt="Ponto Turístico 3">
                    <h3>Igreja Nossa Senhora Do Rodeador</h3>
                    <p>Igreja católica próximo à escola Irmã Maria Regina Velanes Régis.</p>
                </div>
                <div class="image-card">
                    <img src="imagens/rodoviaria.png" alt="Ponto Turístico 3">
                    <h3>Rodoviária</h3>
                    <p>Local central da região de Brazlândia com acesso ao transporte público.
                    </p>
                </div>
                <div class="image-card">
                    <img src="imagens/trilha.png" alt="Ponto Turístico 3">
                    <h3>Poço Azul</h3>
                    <p>O Complexo de Cachoeiras do Poço Azul é um belíssimo local que abriga incontáveis quedas e poços para banho. Local bastente utilizado para trilhas.</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Eventos Locais</h2>
            <div class="gallery">
                <div class="image-card">
                    <img src="imagens/morango.png" alt="Evento Local 1">
                    <h3>Festa do Morango</h3>
                    <p>Festival comemorado entre os meses de Agosto e Setembro, são vendidos geléias, tortas, sucos e até chope de morango, tendo apresentações de shows, exposição agropecuária e parque de diversão no dia.</p>
                </div>
                <div class="image-card">
                    <img src="imagens/goiaba.png" alt="Evento Local 2">
                    <h3>Festa da Goiaba</h3>
                    <p>O evento tem como objetivo divulgar a produção de goiaba, e estimular o consumo, além de atrair novos mercados e promover a integração entre os produtores</p>
                </div>
                <div class="image-card">
                    <img src="imagens/aniversario.png" alt="Evento Local 3">
                    <h3>Aniversário de Brazlândia</h3>
                    <p>Tradicional comemoração do aniversário da cidade, sendo feito um desfile cívico do setor tradicional ao setor norte, com apresentações de alunos das escolas da cidade.</p>
                </div>
            </div>
        </div>    
    <footer>
        <p>&copy; 2024 LocalizaBraz - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
