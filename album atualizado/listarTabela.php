<?php
include('conexao.php');

$queryTabelas = "SHOW TABLES";
$resultadoTabelas = mysqli_query($conn, $queryTabelas);

echo "<html lang='pt-br'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Listagem de Tabelas</title>";
echo "</head>";
echo "<body>";

echo "<table border='3'>";
echo "<tr><th>Tabela</th><th>Colunas</th><th>Valores</th></tr>";

while ($rowTabela = mysqli_fetch_row($resultadoTabelas)) {
    $nomeTabela = $rowTabela[0];

    // Exclua a tabela "album_genero" da listagem
    if ($nomeTabela === "album_genero") {
        continue;
    }

    echo "<tr><th>$nomeTabela</th><th>";

    $queryColunas = "SHOW COLUMNS FROM $nomeTabela";
    $resultadoColunas = mysqli_query($conn, $queryColunas);

    while ($rowColuna = mysqli_fetch_assoc($resultadoColunas)) {
        echo $rowColuna['Field'] . "<br>";
    }

    echo "</th><th>";

    $queryValores = "SELECT * FROM $nomeTabela";
    $resultadoValores = mysqli_query($conn, $queryValores);

    while ($rowValor = mysqli_fetch_assoc($resultadoValores)) {
        foreach ($rowValor as $coluna => $valor) {
            echo "$coluna: $valor<br>";
        }
        echo "<br>";
    }

    echo "</th></tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";
?>
