<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $nomeExcluir = $_POST['nome_excluir'];

    $deleteQuery = "DELETE FROM artista WHERE `nome artista` = '$nomeExcluir'";

    if (mysqli_query($conn, $deleteQuery)) {
        $mensagem = "Artista excluído com sucesso!";
    } else {
        $mensagem = "Ocorreu um erro ao excluir o artista: " . mysqli_error($conn);
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
    <title>Excluir Artista</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Excluir Artista</h1>
    <form method="post">
        <label for="nome_excluir">Nome do Artista a Excluir:</label>
        <select name="nome_excluir">
            <?php
            while ($row = mysqli_fetch_assoc($artistasResult)) {
                echo "<option value='{$row['nome artista']}'>{$row['nome artista']}</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" name="delete" value="Excluir">
    </form>
</body>
</html>
