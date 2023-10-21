<?php
include('../conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir</title>
</head>
<body>
<h2>Escolha uma opçao</h2>
        <div class="opçoes">
            <a class="excluirArtista" href="../excluir/excluirArtista.php">Excluir Artista</a><br><br>
            <a class="excluirGenero" href="../excluir/excluirGenero.php">Excluir Genero</a><br><br>
            <a class="excluirGravadora" href="../excluir/excluirGravadora.php">Excluir Gravadora</a><br><br>
            <a class="excluirAlbum" href="../excluir/excluirAlbum.php">Excluir Album</a>
            
        </div>
</body>
</html>