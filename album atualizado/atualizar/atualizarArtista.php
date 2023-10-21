<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $nomeAntigo = $_POST['nome_antigo'];
    $novoNome = $_POST['novo_nome'];

    $updateQuery = "UPDATE artista SET `nome artista` = '$novoNome' WHERE `nome artista` = '$nomeAntigo'";

    if (mysqli_query($conn, $updateQuery)) {
        $mensagem = "Artista atualizado com sucesso! O nome foi alterado de '$nomeAntigo' para '$novoNome'";
    } else {
        $mensagem = "Ocorreu um erro ao atualizar o artista: " . mysqli_error($conn);
    }
}
$artistasQuery = "SELECT `nome artista` FROM artista";
$artistasResult = mysqli_query($conn, $artistasQuery);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Artista</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Atualizar Artista</h1>
    <form method="post">
        <label for="nome_antigo">Selecione o Nome do Artista Antigo:</label>
        <select name="nome_antigo" required>

            <?php
            mysqli_data_seek($artistasResult, 0);
            while ($row = mysqli_fetch_assoc($artistasResult)) {
                echo "<option value='{$row['nome artista']}'>{$row['nome artista']}</option>";
            }
            ?>
            
        </select>
        <br>
        <label for="novo_nome">Novo Nome do Artista:</label>
        <input type="text" id="novo_nome" name="novo_nome" required>
        <br>
        <input type="submit" name="update" value="Atualizar">
    </form>
</body>
</html>
