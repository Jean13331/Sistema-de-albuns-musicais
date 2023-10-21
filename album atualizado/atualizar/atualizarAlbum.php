<?php
include('../conexao.php');

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_album'])) {
    $albumId = $_POST['album_id'];
    $novoNomeAlbum = $_POST['novo_nome_album'];
    $novoArtista = $_POST['novo_artista'];
    $novoGenero = $_POST['novo_genero'];
    $novoPrecoAlbum = $_POST['novo_preco_album'];

    $consultaAlbumAtual = "SELECT nome, artista, genero, preco FROM album WHERE album_id = $albumId";
    $resultadoAlbumAtual = mysqli_query($conn, $consultaAlbumAtual);
    $dadosAlbumAtual = mysqli_fetch_assoc($resultadoAlbumAtual);

    $nomeAlbumAtual = $dadosAlbumAtual['nome'];
    $artistaAtual = $dadosAlbumAtual['artista'];
    $generoAtual = $dadosAlbumAtual['genero'];
    $precoAlbumAtual = $dadosAlbumAtual['preco'];

    $atualizarAlbumQuery = "UPDATE album SET nome = '$novoNomeAlbum', artista = '$novoArtista', genero = '$novoGenero', preco = $novoPrecoAlbum WHERE album_id = $albumId";

    if (mysqli_query($conn, $atualizarAlbumQuery)) {
        $mensagem = "Álbum atualizado com sucesso!<br>";
        $mensagem .= "Nome do Álbum Atual: $nomeAlbumAtual<br>";
        $mensagem .= "Artista Atual: $artistaAtual<br>";
        $mensagem .= "Gênero Atual: $generoAtual<br>";
        $mensagem .= "Preço Atual: $precoAlbumAtual<br>";
        $mensagem .= "Nome do Álbum Novo: $novoNomeAlbum<br>";
        $mensagem .= "Novo Artista: $novoArtista<br>";
        $mensagem .= "Novo Gênero: $novoGenero<br>";
        $mensagem .= "Novo Preço: $novoPrecoAlbum";
    } else {
        $mensagem = "Ocorreu um erro ao atualizar o álbum: " . mysqli_error($conn);
    }
}


$queryAlbums = "SELECT album_id, nome FROM album";
$resultadoAlbums = mysqli_query($conn, $queryAlbums);

if (!$resultadoAlbums) {
    die("Erro na consulta de álbuns: " . mysqli_error($conn));
}

$albums = array();
while ($row = mysqli_fetch_assoc($resultadoAlbums)) {
    $albums[] = $row;
}

$queryGeneros = "SELECT DISTINCT genero FROM album";
$resultadoGeneros = mysqli_query($conn, $queryGeneros);

if (!$resultadoGeneros) {
    die("Erro na consulta de gêneros: " . mysqli_error($conn));
}

$generos = array();
while ($row = mysqli_fetch_assoc($resultadoGeneros)) {
    $generos[] = $row['genero'];
}

$queryArtistas = "SELECT DISTINCT artista FROM album";
$resultadoArtistas = mysqli_query($conn, $queryArtistas);

if (!$resultadoArtistas) {
    die("Erro na consulta de artistas: " . mysqli_error($conn));
}

$artistas = array();
while ($row = mysqli_fetch_assoc($resultadoArtistas)) {
    $artistas[] = $row['artista'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Atualizar Álbum</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Atualizar Álbum</h1>
    <form method="post">
        <label for="album_id">Selecione o Álbum a ser Atualizado:</label>
        <select id="album_id" name="album_id" required>
            <option value="" selected>Selecione o álbum</option>
            <?php foreach ($albums as $album) { ?>
                <option value="<?php echo $album['album_id']; ?>"><?php echo $album['nome']; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <label for="novo_nome_album">Novo Nome do Álbum:</label>
        <input type="text" id="novo_nome_album" name="novo_nome_album" required>
        <br><br>
        <label for="novo_artista">Novo Artista do Álbum:</label>
        <select id="novo_artista" name="novo_artista" required>
            <option value="" selected>Selecione o artista</option>
            <?php foreach ($artistas as $artista) { ?>
                <option value="<?php echo $artista; ?>"><?php echo $artista; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <label for="novo_genero">Novo Gênero do Álbum:</label>
        <select id="novo_genero" name="novo_genero" required>
            <option value="" selected>Selecione o gênero</option>
            <?php foreach ($generos as $genero) { ?>
                <option value="<?php echo $genero; ?>"><?php echo $genero; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <label for="novo_preco_album">Novo Preço do Álbum:</label>
        <input type="text" id="novo_preco_album" name="novo_preco_album" required>
        <br><br>
        <input type="submit" name="atualizar_album" value="Atualizar Álbum">
    </form>
</body>
</html>
