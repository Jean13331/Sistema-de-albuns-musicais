<?php
include('../conexao.php');

$generosQuery = "SELECT genero FROM genero";
$generosResult = mysqli_query($conn, $generosQuery);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $generoExcluir = $_POST['genero_excluir'];

    $deleteQuery = "DELETE FROM genero WHERE genero = '$generoExcluir'";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "Gênero excluído com sucesso!";
    } else {
        echo "Ocorreu um erro ao excluir o gênero: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Gênero</title>
</head>
<body>
    <h1>Excluir Gênero</h1>
    <form method="post">
        <label for="genero_excluir">Selecione o Gênero a Excluir:</label>
        <select name="genero_excluir" required>
            <?php
            while ($row = mysqli_fetch_assoc($generosResult)) {
                echo "<option value='{$row['genero']}'>{$row['genero']}</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" name="delete" value="Excluir">
    </form>
</body>
</html>
