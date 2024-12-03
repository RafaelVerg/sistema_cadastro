<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $consultorio = $_POST['consultorio'];
    $telefone = $_POST['telefone'];

    if ($id) {
        $sql = "UPDATE Veterinario SET nome='$nome', consultorio='$consultorio', telefone='$telefone' WHERE id='$id'";
        $mensagem = "Veterinario atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO Veterinario (nome, consultorio, telefone) VALUES ('$nome', '$consultorio', '$telefone')";
        $mensagem = "Veterinario cadastrado com sucesso!";
    }

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM Veterinario WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Veterinario excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir Veterinario: " . $conn->error;
    }
}

$fornecedores = $conn->query("SELECT * FROM Veterinario");

$fornecedor = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $fornecedor = $conn->query("SELECT * FROM Veterinario WHERE id='$edit_id'")->fetch_assoc();
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
        <h2 style="color:#4a9db4">Cadastro do Veterinário</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $fornecedor['id'] ?? ''; ?>">
            <label for="nome">Nome do Veterinario:</label>
            <input type="text" name="nome" value="<?php echo $fornecedor['nome'] ?? ''; ?>" required>
            <label for="consultorio">consultorio:</label>
            <input type="text" name="consultorio" value="<?php echo $fornecedor['consultorio'] ?? ''; ?>">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $fornecedor['telefone'] ?? ''; ?>">
            <button type="submit" style="background-color: #4a9db4;"><?php echo $fornecedor ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='mensagem' " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem dos Veterinário</h2>
        <table>
            <tr>
                <th style="color:#6AC4DE;">ID</th>
                <th style="color:#6AC4DE;">Nome</th>
                <th style="color:#6AC4DE;">consultorio</th>
                <th style="color:#6AC4DE;">Telefone</th>
                <th style="color:#6AC4DE;">Ações</th>
            </tr>
            <?php while ($row = $fornecedores->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['consultorio']; ?></td>
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