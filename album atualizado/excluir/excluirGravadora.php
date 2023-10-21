<?php
include('../conexao.php');
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir_gravadora'])) {
    $nomeGravadoraExcluir = $_POST['nome_gravadora'];

    $excluirGravadoraQuery = "DELETE FROM gravadora WHERE nome = '$nomeGravadoraExcluir'";
    $resultadoExclusao = mysqli_query($conn, $excluirGravadoraQuery);

    if (!$resultadoExclusao) {
        die("Erro na exclusão: " . mysqli_error($conn));
    }

    $mensagem = "Gravadora excluída com sucesso!";
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
    <title>Excluir Gravadora</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>

    <h1>Excluir Gravadora</h1>
    <form method="post">
        <label for="nome_gravadora">Selecione a gravadora para excluir:</label>
        <select id="nome_gravadora" name="nome_gravadora" required>
            <option value="">Selecione uma gravadora</option>
            <?php foreach ($gravadoras as $gravadora) {
                echo "<option value='$gravadora'>$gravadora</option>";
            } ?>
        </select>
        <br>
        <br>
        <input type="submit" name="excluir_gravadora" value="Excluir Gravadora">
    </form>
</body>
</html>
