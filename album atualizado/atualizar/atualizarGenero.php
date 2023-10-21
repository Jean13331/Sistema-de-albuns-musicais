<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $generoAntigo = $_POST['genero_antigo'];
    $novoGenero = $_POST['novo_genero'];

    $updateQuery = "UPDATE genero SET genero = '$novoGenero' WHERE genero = '$generoAntigo'";

    if (mysqli_query($conn, $updateQuery)) {
        $mensagem = "Gênero atualizado com sucesso! O nome foi alterado de '$generoAntigo' para '$novoGenero'";
    } else {
        $mensagem = "Ocorreu um erro ao atualizar o gênero: " . mysqli_error($conn);
    }
}

$generosQuery = "SELECT genero FROM genero";
$generosResult = mysqli_query($conn, $generosQuery);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Gênero</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Atualizar Gênero</h1>
    <form method="post">
        <label for="genero_antigo">Selecione o Gênero Antigo:</label>
        <select name="genero_antigo" required>

            <?php
            mysqli_data_seek($generosResult, 0);
            while ($row = mysqli_fetch_assoc($generosResult)) {
                echo "<option value='{$row['genero']}'>{$row['genero']}</option>";
            }
            ?>

        </select>
        
        <br>
        <label for="novo_genero">Novo Nome do Gênero:</label>
        <input type="text" id="novo_genero" name="novo_genero" required>
        <br>
        <input type="submit" name="update" value="Atualizar">
    </form>
</body>
</html>
