<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM animal WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Pet excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir produto: " . $conn->error;
    }
}

$produtos = $conn->query("SELECT a.id, c.nome, a.descricao, a.tipo, a.preco, a.nome AS cliente FROM cliente c JOIN animal a ON c.id = a.cliente_id");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem dos Pets</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Listagem dos pets</h2>
        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>
        <table>
            <tr>
                <th style="color:#6AC4DE;">ID</th>
                <th style="color:#6AC4DE;">Nome</th>
                <th style="color:#6AC4DE;">Descrição</th>
                <th style="color:#6AC4DE;">Tipo</th>
                <th style="color:#6AC4DE;">Preço</th>
                <th style="color:#6AC4DE;">Dono do Pet</th>
                <th style="color:#6AC4DE;">Ações</th>

            </tr>
            <?php while ($row = $produtos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['cliente']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['preco']; ?></td>                
                <td><?php echo $row['nome']; ?></td>
                <td>
                    <a href="cadastro_produto.php?edit_id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')" style="color:#4a9db4;">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
