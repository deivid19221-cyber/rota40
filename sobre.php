
<?php 
session_start(); // Iniciar a sessão

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalizaBraz - Sobre</title>
    <link rel="shortcut icon" href="imagens/mapa.png" type="image/x-icon">
    <link rel="stylesheet" href="css/sobre.css">
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

    <main>
        <section class="sobre-nos">
            <div class="container">
                <h1>Sobre o grupo Alelix</h1>
                <p>O <strong>Grupo Alelix</strong> é uma empresa inovadora, focada em fornecer soluções tecnológicas e interatividade para a comunidade de Brazlândia e seus visitantes. Nosso principal objetivo é facilitar a navegação pela cidade, oferecendo um mapa interativo, atualizado com os pontos de interesse, transporte público, e muito mais.</p>

                <h2>Missão</h2>
                <p>Nossa missão é conectar as pessoas com a cidade de Brazlândia, oferecendo uma experiência digital única para que os cidadãos e visitantes possam explorar tudo o que a região tem a oferecer, de maneira fácil e intuitiva.</p>

                <h2>Visão</h2>
                <p>Acreditamos que a tecnologia pode transformar a forma como as pessoas interagem com o espaço urbano. Nossa visão é nos tornar a principal plataforma digital para navegação e informações sobre Brazlândia, promovendo acessibilidade e conectividade para todos.</p>

                <h2>O que Fazemos?</h2>
                <p>O Grupo Alelix oferece uma plataforma que chamamos de LocalizaBraz, que possui funcionalidades inovadoras onde promove o compartilhamento social de lugares de interesse da região de Brazlândia, onde é voltada para simplificar para simplificar a vida dos moradores e turistas de Brazlândia. Dentre as nossas atividades destacam-se:</p>
                <ul>
                    <li><strong>Mapa Interativo:</strong> Um mapa completo que permite visualizar os principais pontos turísticos, comércios e serviços de Brazlândia. O usuário também pode adicionar marcadores com informações de novos locais.</li>
                    <li><strong>Informações de Transporte:</strong> Horários de ônibus e rotas de transporte público, com detalhes para facilitar o planejamento de viagens, especialmente para quem não tem veículo próprio.</li>
                    <li><strong>Galeria de Fotos:</strong> Um espaço onde a comunidade pode compartilhar suas fotos da cidade, promovendo o turismo local e mostrando as belezas de Brazlândia.</li>
                    <li><strong>Funcionalidades para Usuários:</strong> Usuários cadastrados podem personalizar suas interações, salvando seus pontos favoritos e deixando comentários e avaliações sobre os locais visitados.</li>
                </ul>

                <h2>Nosso Compromisso com a Comunidade</h2>
                <p>Estamos profundamente comprometidos em oferecer uma plataforma segura e de fácil acesso para todos. Trabalhamos em estreita colaboração com moradores e empreendedores locais para garantir que todas as informações no nosso mapa estejam atualizadas e reflitam a realidade da cidade.</p>

                <h2>Nossa História</h2>
                <p>O Grupo Alelix nasceu da paixão por tecnologia e da necessidade de uma ferramenta moderna que ajudasse a comunidade de Brazlândia a se conectar com a cidade de forma mais eficiente. Fundada em 2023, nossa empresa rapidamente se estabeleceu como uma referência local, trazendo soluções inovadoras para a cidade e expandindo suas funcionalidades conforme a demanda dos usuários.</p>

                <h2>Equipe</h2>
                <p>Nosso time é composto por profissionais dedicados e apaixonados pela cidade de Brazlândia. Desde desenvolvedores até designers, todos compartilham o mesmo objetivo: facilitar a vida dos cidadãos por meio da tecnologia. Cada membro da nossa equipe traz um conjunto único de habilidades que contribuem para a constante evolução da nossa plataforma.</p>

                <h2>Fale Conosco</h2>
                <p>Tem alguma dúvida, sugestão ou comentário? Entre em contato conosco, ficaremos felizes em ouvir sua opinião!</p>
                <p>Email: <a href="mailto:contato@grupoalelix.com.br">contato@grupoalelix.com.br</a></p>
                <p>Telefone: (61) 3333-4444</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 LocalizaBraz - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
