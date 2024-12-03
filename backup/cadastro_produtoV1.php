<?php include('valida_sessao.php'); ?>
<?php include('conexao.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $animal = $_POST['animal'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'];
   
    
    

    if ($id) {
        $sql = "UPDATE animal SET cliente_id='$cliente_id', animal='$animal', descricao='$descricao', tipo='$tipo', preco='$preco' WHERE id='$id'";
        $mensagem = "Pet atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO animal (cliente_id, animal, descricao, tipo, preco) VALUES ('$cliente_id', '$animal', '$descricao', '$tipo', '$preco')";
        $mensagem = "Pet cadastrado com sucesso!";
    }

    if ($conn->query($sql) !== TRUE) {
        $mensagem = "Erro: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM animal WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Pet excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir produto: " . $conn->error;
    }
}

$clientes = $conn->query("SELECT id, nome FROM cliente");
$animais = $conn->query("SELECT a.id, a.cliente_id, c.nome, a.descricao, a.tipo, a.preco, a.animal AS Dono FROM cliente c JOIN animal a ON c.id = a.cliente_id");


$produto = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $produto = $conn->query("SELECT id, cliente_id, animal, descricao, tipo, preco FROM animal WHERE id='$edit_id'")->fetch_assoc();
}

$clientes = $conn->query("SELECT id, nome FROM cliente");
$animais = $conn->query("SELECT a.animal, a.id, a.preco, a.descricao, a.tipo, c.nome FROM animal a INNER JOIN cliente c ON c.id = a.cliente_id");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro do Pets</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2 style="color:#4a9db4">Cadastro do Pets</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $produto['id'] ?? ''; ?>">
            <label for="nome">Dono do Pet:</label>
            <select name="nome" required>
                <?php while ($row = $clientes->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php if ($produto && $produto['id'] == $row['id']) echo 'selected'; ?>><?php echo $row['nome']; ?></option>
                <?php endwhile; ?>
            </select>
            <label for="animal">Nome:</label>
            <input type="text" name="animal" value="<?php echo $produto['animal'] ?? ''; ?>" required>
            <label for="descricao">Descrição do Problema do Pet:</label>
            <textarea name="descricao"><?php echo $produto['descricao'] ?? ''; ?></textarea>
            <label for="tipo">tipo</label>
            <textarea name="tipo"><?php echo $produto['tipo'] ?? ''; ?></textarea>
            <label for="preco">Preço:</label>
            <input type="text" name="preco" value="<?php echo $produto['preco'] ?? ''; ?>" required>
                     
            <button type="submit"   ><?php echo $produto ? 'Atualizar' : 'Cadastrar'; ?></button>
        </form>
        <?php if (isset($mensagem)) echo "<p class='message " . ($conn->error ? "error" : "success") . "'>$mensagem</p>"; ?>

        <h2>Listagem dos pets</h2>
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
            <?php while ($row = $animais->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['animal']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['preco']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                            
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
