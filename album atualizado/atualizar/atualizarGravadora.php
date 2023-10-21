<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_gravadora'])) {
    $nomeGravadoraAntigo = $_POST['nome_gravadora_antigo'];
    $nomeGravadoraNovo = $_POST['nome_gravadora_novo'];


    $atualizarGravadoraQuery = "UPDATE gravadora SET nome = '$nomeGravadoraNovo' WHERE nome = '$nomeGravadoraAntigo'";
    $resultadoAtualizacao = mysqli_query($conn, $atualizarGravadoraQuery);

    if ($resultadoAtualizacao) {
        $mensagem = "Gravadora atualizada com sucesso!";
    } else {
        $mensagem = "Ocorreu um erro ao atualizar a gravadora: " . mysqli_error($conn);
    }
}


$queryGravadoras = "SELECT nome FROM gravadora";
$resultadoGravadoras = mysqli_query($conn, $queryGravadoras);

if (!$resultadoGravadoras) {
    die("Erro na consulta de gravadoras: " . mysqli_error($conn));
}

$gravadoras = array();
while ($row = mysqli_fetch_assoc($resultadoGravadoras)) {
    $gravadoras[] = $row['nome'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Gravadora</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Atualizar Gravadora</h1>
    <form method="post">
        <label for="nome_gravadora_antigo">Selecione a gravadora a ser atualizada:</label>
        <select id="nome_gravadora_antigo" name="nome_gravadora_antigo" required>
            <option value="">Selecione uma gravadora</option>

            <?php foreach ($gravadoras as $gravadora) {
                echo "<option value='$gravadora'>$gravadora</option>";
            } ?>

        </select>
        
        <br>
        <br>
        <label for="nome_gravadora_novo">Novo nome da gravadora:</label>
        <input type="text" id="nome_gravadora_novo" name="nome_gravadora_novo" required>
        <br>
        <br>
        <input type="submit" name="atualizar_gravadora" value="Atualizar Gravadora">
    </form>
</body>
</html>
