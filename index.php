<?php include('valida_sessao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Principal</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2 class="corr" style="color:#4a9db4">Bem-vindo, <?php echo $_SESSION['usuario']; ?></h2>
        <ul>
            <li><a style="color:#4a9db4" href="cadastro_fornecedor.php">Cadastro dos Clientes</a></li>
            <li><a style="color:#4a9db4" href="cadastro_veterinario.php">Cadastro dos Veterinário</a></li>
            <li><a style="color:#4a9db4" href="cadastro_consulta.php">Cadastro da consulta</a></li>
            <li><a style="color:#4a9db4" href="cadastro_produto.php">Cadastro dos Pets</a></li>
            <li><a style="color:#4a9db4" href="listagem_produtos.php">Listagem dos Pets</a></li>
           
            <li><a style="color:#4a9db4" href="logout.php">Sair</a></li>
        </ul>
    </div>
</body>
</html>
