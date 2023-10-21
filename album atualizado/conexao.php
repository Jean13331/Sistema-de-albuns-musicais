<?php
$hostname = 'localhost';
$username = 'root';
$password = '1234';
$database = 'sakila';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}