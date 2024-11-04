<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if ($id) {
        $sql = "UPDATE cliente SET nome='$nome', email='$email', telefone='$telefone' WHERE id='$id'";
        $mensagem = "Cliente atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO cliente (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
        $mensagem = "Cliente cadastrado com sucesso!";
    }

    if ($conn->query($sql) !== TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM cliente WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Cliente excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir Cliente: " . $conn->error;
    }
}

$fornecedores = $conn->query("SELECT * FROM cliente");

$fornecedor = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $fornecedor = $conn->query("SELECT * FROM cliente WHERE id='$edit_id'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro dos Pets</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2 style="color:#4a9db4">Cadastro do Cliente</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $fornecedor['id'] ?? ''; ?>">
            <label for="nome">Nome do Dono do pet:</label>
            <input type="text" name="nome" value="<?php echo $fornecedor['nome'] ?? ''; ?>" required>
            <label for="email">email:</label>
            <input type="email" name="email" value="<?php echo $fornecedor['email'] ?? ''; ?>">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $fornecedor['telefone'] ?? ''; ?>">
            <button type="submit" style="background-color: #4a9db4;"><?php echo $fornecedor ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='messagem' " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem dos Clientes</h2>
        <table>
            <tr>
                <th style="color:#6AC4DE;">ID</th>
                <th style="color:#6AC4DE;">Nome</th>
                <th style="color:#6AC4DE;">email</th>
                <th style="color:#6AC4DE;">Telefone</th>
                <th style="color:#6AC4DE;">Ações</th>
            </tr>
            <?php while ($row = $fornecedores->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['telefone']; ?></td>
                <td>
                    <a href="?edit_id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
