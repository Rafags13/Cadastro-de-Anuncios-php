<?php

require_once 'conectabd.php';
session_start();



if (empty($_SESSION)) {
    header("Location: index.php?msgErro=Você precisa se autenticar para entrar nesta pagina!");
    die();
}


// echo '<pre>';
// print_r($_SESSION);
// print_r($_GET);
// echo '</pre>';
// die();

if (!empty($_GET['id_anuncio'])) {
    $sql = "SELECT * FROM ANUNCIO WHERE EMAIL_USUARIO = :email and ID = :id";
    try {
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':email' => $_SESSION['email'], ':id' => $_GET['id_anuncio']));
        if ($statement->rowCount() == 1) {
            $anuncios = $statement->fetchAll();
            $anuncios = $anuncios[0];
            // echo '<pre>';
            // print_r($anuncios);
            // echo '</pre>';
            // die();
        } else {
            // die("Não foi encontrado nenhum registro para id_anuncio = " . $_GET['id_anuncio'] . " e E-mail = " . $_SESSION['email']);
            header("Location: index_logado.php?msgErro=Você não possui permissão para acessar essa página");
            die();
        }
    } catch (PDOException $e) {
        header("Location: index_logado.php?msgErro=Falha ao obter registro no banco de dados");
        // die($e->getMessage());
    }
} else {
    header("Location: index_logado.php?msgErro=Você não possui permissão para acessar essa página");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Cadastro Anúncio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Apagar Anúncio</h1>
        <form action="processa_anuncio.php" method="post">
            <input type="hidden" class="form-control" name="id_anuncio" id="id_anuncio" value="<?php echo $anuncios['id']; ?>">
            <div class="col-4">
                <label for="fase">Fase</label>
                <select class="form-select" name="fase" id="fase">
                    <option disabled>Selecione a fase do animal</option>
                    <option value="F" <?php echo $anuncios['fase'] == 'F' ? "selected" : "disabled" ?>>Filhote</option>
                    <option value="A" <?php echo $anuncios['fase'] == 'A' ? "selected" : "disabled" ?>>Adulto</option>
                </select>
            </div>

            <div class="col-4">
                <label for="tipo">Tipo</label>
                <select class="form-select" name="tipo" id="tipo">
                    <option disabled>Selecione o tipo do animal</option>
                    <option value="G" <?php echo $anuncios['tipo'] == 'G' ? "selected" : "disabled" ?>>Gato</option>
                    <option value="C" <?php echo $anuncios['tipo'] == 'F' ? "selected" : "disabled" ?>>Cachorro</option>
                </select>
            </div>

            <div class="col-4">
                <label for="porte">Porte</label>
                <select class="form-select" name="porte" id="porte">
                    <option disabled>Selecione o porte do animal</option>
                    <option value="P" <?php echo $anuncios['porte'] == 'P' ? "selected" : "disabled" ?>>Pequeno</option>
                    <option value="M" <?php echo $anuncios['porte'] == 'M' ? "selected" : "disabled" ?>>Médio</option>
                    <option value="G" <?php echo $anuncios['porte'] == 'G' ? "selected" : "disabled" ?>>Grande</option>
                </select>
            </div>

            <div class="col-4">
                <label for="pelagemCor">Pelagem/Cor</label>
                <input type="text" name="pelagemCor" id="pelagemCor" class="form-control" value="<?php echo $anuncios['pelagem_cor']; ?>" readonly>
            </div>

            <div class="col-4">
                <label for="raca">Raça</label>
                <input type="text" name="raca" id="raca" class="form-control" value="<?php echo $anuncios['raca']; ?>" readonly>
            </div>
            <br>
            <div class="col-4">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sexo" value="M" id="sexoM" <?php echo $anuncios['sexo'] == "M" ? "checked" : "disabled" ?>>
                    <label for="sexoM" class="form-check-label">Macho</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sexo" value="F" id="sexoF" <?php echo $anuncios['sexo'] == "F" ? "checked" : "disabled" ?>>
                    <label for="sexoF" class="form-check-label">Fêmea</label>
                </div>
            </div>

            <div class="col-4">
                <label for="observacao">Observações</label>
                <textarea name="observacao" class="form-control" id="observacao" readonly><?php echo $anuncios['observacao']; ?></textarea>
            </div>
            <br>
            <button type="submit" name="enviarDados" class="btn btn-primary" value="DEL">Apagar</button>
            <a href="index_logado.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</body>

</html>