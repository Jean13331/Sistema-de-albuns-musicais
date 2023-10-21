<?php
include('../conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastros</title>
</head>
<body>
<h2>Escolha uma opçao</h2>
        <div class="opçoes">
            <a class="cadastrarArtista" href="../cadastro/cadastrarArtista.php">Cadastrar Artista</a><br><br>
            <a class="cadastrarGenero" href="../cadastro/cadastrarGenero.php">Cadastrar Genero</a><br><br>
            <a class="cadastrarGravadora" href="../cadastro/cadastrarGravadora.php">Cadastrar Gravadora</a><br><br>
            <a class="cadastrarAlbum" href="../cadastro/cadastrarAlbum.php">Cadastrar Album</a>
            
        </div>
</body>
</html>