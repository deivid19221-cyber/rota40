<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalizaBraz - Login</title>
    <link rel="shortcut icon" href="imagens/mapa.png" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <script>
        function alertEsqueciSenha() {
            alert('Implementação futura.');
        }
    </script>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <img src="imagens/logoo.png" class="img" alt="imagen">
        </div>
        <div class="hight-login">
            <div class="card-login">
                <h1>Login</h1>
                <form id="text-login" action="login_usuario.php" method="POST">
                    <label for="usuario">Usuário</label>
                    <input type="text" id="username" name="username" placeholder="Usuário" required>
                    <br>
                    <label for="senha">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                    <button type="submit" name="entrar" class="btnentrar">Entrar</button>
                </form>
                <?php if (isset($erro)): ?>
                    <p style="color: red;"><?php echo $erro; ?></p>
                <?php endif; ?>
                <header>
                    <nav>
                        <ul>
                        <li><a href="#" onclick="alertEsqueciSenha(); return false;">Esqueci a Senha</a></li>
                            <li><a href="cadastro.html">Cadastre-se</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
    </div>
</body>
</html>
