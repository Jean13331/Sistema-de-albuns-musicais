<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_gravadora'])) {
    $nomeGravadora = $_POST['nome_gravadora'];

    $inserirGravadoraQuery = "INSERT INTO gravadora (nome) VALUES ('$nomeGravadora')";
    if (mysqli_query($conn, $inserirGravadoraQuery)) {
        $mensagem = "Gravadora cadastrada com sucesso!";
    } else {
        $mensagem = "Ocorreu um erro ao cadastrar a gravadora: " . mysqli_error($conn);
    }
}

$queryGeneros = "SELECT genero FROM genero";
$resultadoGeneros = mysqli_query($conn, $queryGeneros);

$generos = array();
while ($row = mysqli_fetch_assoc($resultadoGeneros)) {
    $generos[] = $row['genero'];
}

$queryArtistas = "SELECT `nome artista` FROM artista";
$resultadoArtistas = mysqli_query($conn, $queryArtistas);

$artistas = array();
while ($row = mysqli_fetch_assoc($resultadoArtistas)) {
    $artistas[] = $row['nome artista'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Gravadora</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Cadastrar Gravadora</h1>
    <form method="post">
        <label for="nome_gravadora">Nome da Gravadora:</label>
        <input type="text" id="nome_gravadora" name="nome_gravadora" required>

        <br>
        <br>

        <label for="artista_selecionado">Artista:</label>
        <select id="artista_selecionado" name="artista_selecionado" required>
            <option value="">Selecione um artista</option>

            <?php foreach ($artistas as $artista) {
                echo "<option value='$artista'>$artista</option>";
            } ?>

        </select>

        <br>
        <br>

        <label for="genero_selecionado">Gênero:</label>
        <select id="genero_selecionado" name="genero_selecionado" required>
            <option value="">Selecione um gênero</option>

            <?php foreach ($generos as $genero) {
                echo "<option value='$genero'>$genero</option>";
            } ?>
            
        </select>
        
        <br>
        <br>
        <input type="submit" name="add_gravadora" value="Cadastrar Gravadora">
    </form>
</body>
</html>
