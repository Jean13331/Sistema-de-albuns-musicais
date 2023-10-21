<?php
include('../conexao.php');
$mensagem = "";

$queryGeneros = "SELECT idgenero, genero FROM genero";
$resultadoGeneros = mysqli_query($conn, $queryGeneros);

if (!$resultadoGeneros) {
    die("Erro na consulta de gêneros: " . mysqli_error($conn));
}

$generos = array();
while ($row = mysqli_fetch_assoc($resultadoGeneros)) {
    $generos[] = $row;
}

$queryArtistas = "SELECT `nome artista` FROM artista";
$resultadoArtistas = mysqli_query($conn, $queryArtistas);

if (!$resultadoArtistas) {
    die("Erro na consulta de artistas: " . mysqli_error($conn));
}

$artistas = array();
while ($row = mysqli_fetch_assoc($resultadoArtistas)) {
    $artistas[] = $row['nome artista'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_album'])) {
    $nomeAlbum = $_POST['nome_album'];
    $artistaAlbum = $_POST['artista_album']; 
    $precoAlbum = $_POST['preco_album'];
    $generosSelecionados = isset($_POST['generos_selecionados']) ? $_POST['generos_selecionados'] : array();

    $inserirAlbumQuery = "INSERT INTO album (`nome`, `artista`, `preco`, `genero`) VALUES ('$nomeAlbum', '$artistaAlbum', $precoAlbum, '" . implode(", ", $generosSelecionados) . "')";

    if (mysqli_query($conn, $inserirAlbumQuery)) {
        $mensagem = "Álbum cadastrado com sucesso!";
    } else {
        $mensagem = "Ocorreu um erro ao cadastrar o álbum: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Cadastrar Álbum</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Cadastrar Álbum</h1>
    <form method="post">
        <label for="nome_album">Nome do Álbum:</label>
        <input type="text" id="nome_album" name="nome_album" required>
        <br><br>
        <label for="artista_album">Artista do Álbum:</label>
        <select id="artista_album" name="artista_album" required>
            <option value="0" selected>Selecione o artista</option>
            <?php foreach ($artistas as $artista) { ?>
                <option value="<?php echo $artista; ?>"><?php echo $artista; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <label for="preco_album">Preço do Álbum:</label>
        <input type="text" id="preco_album" name="preco_album" required>
        <br><br>
        <label for="generos_selecionados">Gêneros:</label>
        <br>
        <?php foreach ($generos as $genero) { ?>
            <input type="checkbox" name="generos_selecionados[]" value="<?php echo $genero['genero']; ?>">
            <?php echo $genero['genero']; ?><br>
        <?php } ?>
        <br>
        <input type="submit" name="cadastrar_album" value="Cadastrar Álbum">
    </form>
</body>
</html>
