<?php
require_once 'conectabd.php';

session_start();
if (empty($_SESSION)) {
    header("Location: index.php?msgErro=Você precisa se autenticar para entrar nesta pagina!");
    die();
}

// echo '<pre>';
// print_r($_POST);
// echo '<pre>';
// die();

if (!empty($_POST)) {
    if ($_POST['enviarDados'] == 'CAD') {
        try {
            $sql = "INSERT INTO ANUNCIO
                    (FASE, TIPO, PORTE, SEXO, PELAGEM_COR, RACA, OBSERVACAO, EMAIL_USUARIO)
                    VALUES(:fase, :tipo, :porte, :sexo, :pelagem_cor, :raca, :observacao, :email_usuario)";
            $statement = $pdo->prepare($sql);

            $dados = array(
                ':fase' => $_POST['fase'],
                ':tipo' => $_POST['tipo'],
                ':porte' => $_POST['porte'],
                ':sexo' => $_POST['sexo'],
                ':pelagem_cor' => $_POST['pelagemCor'],
                ':raca' => $_POST['raca'],
                ':observacao' => $_POST['observacao'],
                ':email_usuario' => $_SESSION['email'],
            );

            if ($statement->execute($dados)) {
                header("Location: index_logado.php?msgSucesso=Anúncio cadastrado com sucesso!");
            }
        } catch (PDOException $e) {
            // die($e->getMessage());
            header("Location: index_logado.php?msgErro=Falha ao cadastrar anúncio");
        }
    } else if ($_POST['enviarDados'] == 'ALT') {
        try {
            $sql = "UPDATE ANUNCIO SET FASE = :fase, 
            TIPO = :tipo, 
            PORTE = :porte, 
            SEXO = :sexo, 
            PELAGEM_COR = :pelagem_cor, 
            RACA = :raca, 
            OBSERVACAO = :observacao 
            WHERE ID = :id_anuncio AND EMAIL_USUARIO = :email";

            $dados = array(
                ':id_anuncio' => $_POST['id_anuncio'],
                ':fase' => $_POST['fase'],
                ':tipo' => $_POST['tipo'],
                ':porte' => $_POST['porte'],
                ':sexo' => $_POST['sexo'],
                ':pelagem_cor' => $_POST['pelagemCor'],
                ':raca' => $_POST['raca'],
                ':observacao' => $_POST['observacao'],
                ':email' => $_SESSION['email'],
            );

            $statement = $pdo->prepare($sql);

            if ($statement->execute($dados)) {
                header("Location: index_logado.php?msgSucesso=Anúncio alterado com sucesso!");
            } else {
                header("Location: index_logado.php?msgErro=Falha ao Alterar o anúncio!");
            }
        } catch (PDOException $e) {
            // die($e->getMessage());
            header("Location: index_logado.php?msgErro=Falha ao Alterar o anúncio!");
        }
    } else if ($_POST['enviarDados'] == 'DEL') {
        try {
            $sql = "DELETE FROM ANUNCIO WHERE ID = :id_anuncio AND EMAIL_USUARIO = :email";
            $statement = $pdo->prepare($sql);

            if ($statement->execute(
                array(
                    ':id_anuncio' => $_POST['id_anuncio'],
                    ':email' => $_SESSION['email']
                )
            )) {
                header("Location: index_logado.php?msgSucesso=Anúncio excluído com sucesso!");
            } else {
                header("Location: index_logado.php?msgErro=Falha ao excluir o anúncio!");
            }
        } catch (PDOException $e) {
            // die($e->getMessage());
            header("Location: index_logado.php?msgErro=Falha ao excluir o anúncio!");
        }
    } else {
        header("Location: index_logado.php?msgErro=Erro ao realizar esta operação, tente novamente");
    }
} else {
    header("location: index.php?msgErro=Erro de acesso.");
}
die();
