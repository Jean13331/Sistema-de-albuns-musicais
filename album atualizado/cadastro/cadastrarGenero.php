<?php
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $genero = $_POST['genero'];

    $query = "INSERT INTO genero (genero) VALUES ('$genero')";

    if (mysqli_query($conn, $query)) {
        echo "Gênero cadastrado com sucesso!";
    } else {
        echo "Ocorreu um erro ao cadastrar o gênero: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Gênero</title>
</head>
<body>
    <h1>Cadastrar Gênero</h1>
    <form method="post">
        <label for="genero">Nome do Gênero:</label>
        <input type="text" id="genero" name="genero" required>
        <br>
        <input type="submit" name="add" value="Cadastrar">
    </form>
</body>
</html>
