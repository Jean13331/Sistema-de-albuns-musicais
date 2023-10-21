<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nome = $_POST['nome'];

    $query = "INSERT INTO artista (`nome artista`) VALUES ('$nome')";

    if (mysqli_query($conn, $query)) {
        $mensagem = "Artista cadastrado com sucesso!";
    } else {
        $mensagem = "Ocorreu um erro ao cadastrar o artista: " . mysqli_error($conn);
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
    <title>Cadastrar Artista</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Cadastrar Artista</h1>
    <form method="post">
        <label for="nome">Nome do Artista:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <input type="submit" name="add" value="Cadastrar">
    </form>
</body>
</html>
