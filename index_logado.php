<?php
session_start();

require_once 'conectabd.php';

if (empty($_SESSION)) {
    header("Location: index.php?msgErro=Você precisa se autenticar para entrar nesta pagina!");
    die();
}
/*
 * echo '<pre>';
 * print_r($_SESSION);
 * echo '</pre>';
 * die();
 */
$anuncios = array();

if (!empty($_GET['meus_anuncios']) && $_GET['meus_anuncios'] == 1) {

    $sql  = "SELECT an.*,u.nome, u.telefone FROM ANUNCIO an JOIN usuario u ON an.email_usuario = u.email WHERE an.email_usuario = :email";
    $email = array(':email' => $_SESSION['email']);

    try {
        $statement = $pdo->prepare($sql);

        if ($statement->execute($email)) {
            $anuncios = $statement->fetchAll();
        } else {
            die("Falha ao executar a SQL.. #1");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    $sql = "SELECT an.*, u.nome, u.telefone FROM ANUNCIO an join usuario u on an.email_usuario = u.email ORDER BY id asc";
    $statement = $pdo->prepare($sql);
    if ($statement->execute()) {
        $anuncios = $statement->fetchAll();
        // echo '<pre>';
        // print_r($anuncios);
        // echo '</pre>';
        // die();
    } else {
        die("Falha ao executar a SQL.. #0");
    }

    try {
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - Ambiente Logado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php if (!empty($_GET['msgErro'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_GET['msgErro']; ?>
            </div>
        <?php } ?>

        <?php if (!empty($_GET['msgSucesso'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_GET['msgSucesso']; ?>
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <div class="col-md-11">
            <h2 class="title">Olá, <?php echo $_SESSION['nome']; ?>!</h2>
        </div>
    </div>
    <div class="container">
        <a href="cad_anuncio.php" class="btn btn-primary">Novo anúncio</a>
        <a href="index_logado.php?meus_anuncios=1" class="btn btn-success">Meus anúncios</a>
        <a href="index_logado.php?meus_anuncios=0" class="btn btn-info">Todos</a>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>

    <?php if (!empty($anuncios)) { ?>
        <?php

        foreach ($anuncios as $a) {
        }
        ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <?php
                        $url = $_SERVER['REQUEST_URI'];
                        ?>
                        <?php if (!str_contains($url, 'meus_anuncios=1') && str_contains($url, 'index_logado.php')) { ?>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                        <?php } ?>
                        <th scope="col">Fase</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Pelagem/Cor</th>
                        <th scope="col">Raça</th>
                        <th scope="col">Porte</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anuncios as $a) { ?>
                        <tr>
                            <th scope="row"><?php echo $a['id']; ?></th>
                            <?php if (!str_contains($url, 'meus_anuncios=1') && str_contains($url, 'index_logado.php')) { ?>
                                <td><?php echo $a['email_usuario'] == $_SESSION['email'] ? $a['nome'] . ' (eu)' : $a['nome'] ?></td>
                                <td><?php echo $a['telefone'] ?></td>
                            <?php } ?>
                            <td><?php echo $a['fase'] == "F" ? "Filhote" : "Adulto" ?></td>
                            <td><?php echo $a['tipo'] == "G" ? "Gato" : "Cachorro" ?></td>
                            <td><?php echo $a['pelagem_cor']; ?></td>
                            <td><?php echo $a['raca'] == "SRD" ? "Sem raça definida" : $a['raca'] ?></td>
                            <td><?php echo ($a['porte'] == "G" ? "Grande" : $a['porte'] == "M") ? "Médio" : "Pequeno" ?></td>
                            <td><?php echo $a['sexo'] == "M" ? "Macho" : "Fêmea" ?></td>
                            <td>
                                <?php if ($a['email_usuario'] == $_SESSION['email']) { ?>
                                    <a href="alt_anuncio.php?id_anuncio=<?php echo $a['id']; ?>" class="btn btn-warning">Alterar</a>
                                    <a href="del_anuncio.php?id_anuncio=<?php echo $a['id']; ?>" class="btn btn-danger">Excluir</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>

</html>