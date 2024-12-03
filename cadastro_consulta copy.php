<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $veterinario_id = $_POST['veterinario_id'];
    $pet_id = $_POST['pet_id'];
    $consultorio = $_POST['consultorio'];
    $data_de_entrada = $_POST['data_de_entrada'];
    $problema_do_pet = $_POST['problema_do_pet'];


    if ($id) {
        $sql = "UPDATE consulta SET veterinario_id=$veterinario_id, pet_id=$pet_id, consultorio=$consultorio, data_de_entrada=$data_de_entrada, problema_do_pet=$problema_do_pet  WHERE id='$id'";
        $mensagem = "Consulta atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO consulta (veterinario_id, pet_id, consultorio, data_de_entrada, problema_do_pet) VALUES $veterinario_id, $pet_id, $consultorio, $data_de_entrada, $problema_do_pet";
        $mensagem = "Consulta cadastrado com sucesso!";
    }

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM consulta WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "consulta excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir consulta: " . $conn->error;
    }
}

$consultas = $conn->query("SELECT * FROM consulta");

$consulta = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $consulta_edit = $conn->query("SELECT * FROM consulta WHERE id='$edit_id'")->fetch_assoc();
}

$veterinario = $conn->query("SELECT * FROM veterinario");
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
            <input type="hidden" name="id" value="<?php echo $consulta_edit['id'] ?? ''; ?>">
            <label for="veterinario_id">veterinario_id:</label>
            <input type="text" name="veterinario_id" value="<?php echo $consulta_edit['veterinario_id'] ?? ''; ?>" required>
            <label for="id">id:</label>
            <input type="text" name="id" value="<?php echo $consulta_edit['id'] ?? ''; ?>">
            <label for="consultorio">consultorio:</label>
            <input type="text" name="consultorio" value="<?php echo $consulta_edit['consultorio'] ?? ''; ?>">
            <label for="data_de_entrada">data_de_entrada:</label>
            <input type="text" name="data_de_entrada" value="<?php echo $consulta_edit['data_de_entrada'] ?? ''; ?>">
            <label for="problema_do_pet">problema_do_pet do Dono do pet:</label>
            <input type="text" name="problema_do_pet" value="<?php echo $consulta_edit['problema_do_pet'] ?? ''; ?>" required>
            <button type="submit" style="background-color: #4a9db4;"><?php echo $consulta ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='mensagem' " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem dos consultas</h2>
        <table>
            <tr>
                <th style="color:#6AC4DE;">ID</th>
                <th style="color:#6AC4DE;">Veterinario</th>
                <th style="color:#6AC4DE;">Pet ID</th>
                <th style="color:#6AC4DE;">Consultorio</th>
                <th style="color:#6AC4DE;">Data de Entrada</th>
                <th style="color:#6AC4DE;">Problema do Pet</th>
                <th style="color:#6AC4DE;">Ações</th>
            </tr>
            <?php while ($row = $consultas->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['veterinario_id']; ?></td>
                <td><?php echo $row['pet_id']; ?></td>
                <td><?php echo $row['consultorio']; ?></td>
                <td><?php echo $row['data_de_entrada']; ?></td>
                <td><?php echo $row['problema_do_pet']; ?></td>

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
