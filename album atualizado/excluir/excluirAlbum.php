<?php
include('../conexao.php');
$mensagem = "";

if (isset($_POST['excluir_album'])) {
    $albumIdParaExcluir = $_POST['album_id_para_excluir'];

    $excluirAlbumQuery = "DELETE FROM album WHERE album_id = $albumIdParaExcluir";

    if (mysqli_query($conn, $excluirAlbumQuery)) {
        $mensagem = "Álbum excluído com sucesso!";
    } else {
        $mensagem = "Ocorreu um erro ao excluir o álbum: " . mysqli_error($conn);
    }
}

$listaAlbumsQuery = "SELECT * FROM album";
$listaAlbumsResultado = mysqli_query($conn, $listaAlbumsQuery);

if (!$listaAlbumsResultado) {
    die("Erro na consulta de álbuns: " . mysqli_error($conn));
}

$albums = array();
while ($row = mysqli_fetch_assoc($listaAlbumsResultado)) {
    $albums[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusao de Album</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Exclusao de Album</h1>
    <table border="1">
        <tr>
            <th>Nome do Álbum</th>
            <th>Artista</th>
            <th>Preço</th>
            <th>Gêneros</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($albums as $album) { ?>
            <tr>
                <td><?php echo $album['nome']; ?></td>
                <td><?php echo $album['artista']; ?></td>
                <td><?php echo $album['preco']; ?></td>
                <td><?php echo $album['genero']; ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir este álbum?');">
                        <input type="hidden" name="album_id_para_excluir" value="<?php echo $album['album_id']; ?>">
                        <input type="submit" name="excluir_album" value="Excluir">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
