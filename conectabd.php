<?php
$endereco = 'localhost';
$banco = ''; // Nome do seu banco de dados
$usuario = ''; // nome do usuario master
$senha = ''; // senha para acesso ao banco

try {
    $pdo = new Pdo("pgsql:host=$endereco;port=5432;dbname=$banco", $usuario, $senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo "falha ao conectar ao banco!";
    die($e->getMessage());
}
