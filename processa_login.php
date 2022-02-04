<?php
require_once 'conectabd.php';

// echo '<pre>';
// print_r($_POST);
// echo '<pre>';
// die();

if (!empty($_POST)) {
    session_start();
    try {
        $sql = "SELECT NOME, EMAIL, TELEFONE, DATA_NASCIMENTO FROM USUARIO WHERE EMAIL = :email AND SENHA = :senha";

        $statement = $pdo->prepare($sql);

        // $dados = array(
        //     ':email' => $_POST['email'],
        //     ':senha' => $_POST['senha']
        // );

        // $statement->execute($dados);
        $statement->execute(array(
            ':email' => $_POST['email'],
            ':senha' => md5($_POST['senha'])
        ));

        $result = $statement->fetchAll();
        if ($statement->rowCount() == 1) {
            $result = $result[0];
            $_SESSION['nome'] = $result['nome']; // Sempre ter todas as letras minúsculas
            $_SESSION['email'] = $result['email']; // Sempre ter todas as letras minúsculas
            $_SESSION['dataNascimento'] = $result['data_nascimento']; // Sempre ter todas as letras minúsculas
            $_SESSION['telefone'] = $result['telefone']; // Sempre ter todas as letras minúsculas

            header("Location: index_logado.php");
        } else {
            session_destroy();
            header("Location: index.php?msgErro=E-mail e/ou Senha inválido(s).");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    header("Location: index.php?msgErro=você não tem permissão para acessar essa página!!!");
}
die();
