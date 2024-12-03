<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $veterinario_id = $_POST['veterinario_id'];
    $animal_id = $_POST['animal_id'];
    $consultorio = $_POST['consultorio'];
    $data_de_entrada = $_POST['data_de_entrada'];
    $pre_consulta = $_POST['pre_consulta'];
    

    if ($id) {
        $sql = "UPDATE consulta SET veterinario_id='$veterinario_id', animal_id='$animal_id', consultorio='$consultorio', data_de_entrada='$data_de_entrada', pre_consulta='$pre_consulta' WHERE id='$id'";
        $mensagem = "Consulta atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO consulta (veterinario_id, animal_id, consultorio, data_de_entrada, pre_consulta) VALUES ('$veterinario_id', '$animal_id', '$consultorio', '$data_de_entrada', '$pre_consulta')";
        $mensagem = "Consulta cadastrado com sucesso!";
    }

    if ($conn->query($sql) == TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM consulta WHERE id='$delete_id'";
    if ($conn->query($sql) == TRUE) {
        $mensagem = "consulta excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir consulta: " . $conn->error;
    }
}

$Consultas = $conn->query("SELECT cs.id, cs.consultorio, cs.data_de_entrada, cs.pre_consulta, a.animal as animal_nome, v.nome as veterinario_nome from animal a join consulta cs on a.id = cs.animal_id join Veterinario v on cs.veterinario_id = v.id ");

$Consulta = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $Consulta = $conn->query("SELECT * FROM consulta WHERE id='$edit_id'")->fetch_assoc();
}

$AConsultas = $conn->query("SELECT id, animal from animal");
$VConsultas = $conn->query("SELECT id, nome from Veterinario");
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
        <h2 style="color:#4a9db4">Cadastro da Consulta</h2>
        <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $Consulta['id'] ?? ''; ?>"> 
        <label for="veterinario_id">Nome do Veterinarios</label>
        <select name="veterinario_id" required>
            <?php while ($row = $VConsultas->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($Consulta && $Consulta['veterinario_id'] == $row['id']) echo 'selected'; ?>><?php echo $row['nome']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="animal_id">Nome dos Pets</label>
        <select name="animal_id">
            <?php while ($row = $AConsultas->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($Consulta && $Consulta['animal_id'] == $row['id']) echo 'selected'; ?>><?php echo $row['animal']; ?></option>
            <?php endwhile; ?>
        </select>
            <label for="consultorio">Consultorio</label>
            <input type="text" name="consultorio" value="<?php echo $Consulta['consultorio'] ?? ''; ?>">
            <label for="data_de_entrada">Data da entrada do pet</label>
            <input type="text" name="data_de_entrada" value="<?php echo $Consulta['data_de_entrada'] ?? ''; ?>">
            <label for="pre_consulta">Problema do pet</label>
            <input type="text" name="pre_consulta" value="<?php echo $Consulta['pre_consulta'] ?? ''; ?>">
            <button type="submit" style="background-color: #4a9db4;"><?php echo $Consulta ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='mensagem' " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem das Consultas</h2>
        <table>
            <tr>
                <th style="color:#6AC4DE;">ID</th>
                <th style="color:#6AC4DE;">Nome do Veterinario</th>
                <th style="color:#6AC4DE;">Nome do pet</th>
                <th style="color:#6AC4DE;">Consultorio</th>
                <th style="color:#6AC4DE;">Data de entrada</th>
                <th style="color:#6AC4DE;">Pré consulta</th>
                <th style="color:#6AC4DE;">Ações</th>


            </tr>
            <?php while ($row = $Consultas->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['veterinario_nome']; ?></td>
                <td><?php echo $row['animal_nome']; ?></td>
                <td><?php echo $row['consultorio']; ?></td>
                <td><?php echo $row['data_de_entrada']; ?></td>
                <td><?php echo $row['pre_consulta']; ?></td>


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