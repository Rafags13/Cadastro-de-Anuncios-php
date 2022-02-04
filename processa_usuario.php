<?php
require_once 'conectabd.php';


// echo '<pre>';
// print_r($_POST);
// echo '<pre>';

if (!empty($_POST)) {
    try {
        $sql = "INSERT INTO USUARIO
                (NOME, DATA_NASCIMENTO, TELEFONE, EMAIL, SENHA)
                VALUES(:nome, :dataNascimento, :telefone, :email, :senha)";
        $statement = $pdo->prepare($sql);

        $dados = array(
            ':nome' => $_POST['nome'],
            ':dataNascimento' => $_POST['dataNascimento'],
            ':telefone' => $_POST['telefone'],
            ':email' => $_POST['email'],
            ':senha' => md5($_POST['senha']),
        );

        if ($statement->execute($dados)) {
            header("Location: index.php?msgSucesso=Cadastro realizado com sucesso!");
        }
    } catch (PDOException $e) {
        // die($e->getMessage());
        header("Location: index.php?msgErro=Falha ao cadastrar");
    }
} else {
    header("location: index.php?msgErro=Erro de acesso.");
}
die();
