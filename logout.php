<?php
session_start(); 

// Limpar todas as variáveis de sessão
session_unset(); 

// Destruir a sessão
session_destroy(); 

// Redirecionar para a página inicial ou login
header('Location: index.php');
exit();
?>
