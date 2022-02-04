<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php?msgErro=Você precisa se autenticar para entrar nesta pagina!");
    die();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Novo Anúncio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Cadastrar Novo Anúncio de Animal para adoção</h1>
        <form action="processa_anuncio.php" method="post">
            <div class="col-4">
                <label for="fase">Fase</label>
                <select class="form-select" name="fase" id="fase">
                    <option selected>Selecione a fase do animal</option>
                    <option value="F">Filhote</option>
                    <option value="A">Adulto</option>
                </select>
            </div>

            <div class="col-4">
                <label for="tipo">Tipo</label>
                <select class="form-select" name="tipo" id="tipo">
                    <option selected>Selecione o tipo do animal</option>
                    <option value="G">Gato</option>
                    <option value="C">Cachorro</option>
                </select>
            </div>

            <div class="col-4">
                <label for="porte">Porte</label>
                <select class="form-select" name="porte" id="porte">
                    <option selected>Selecione o porte do animal</option>
                    <option value="P">Pequeno</option>
                    <option value="M">Médio</option>
                    <option value="G">Grande</option>
                </select>
            </div>

            <div class="col-4">
                <label for="pelagemCor">Pelagem/Cor</label>
                <input type="text" name="pelagemCor" id="pelagemCor" class="form-control">
            </div>

            <div class="col-4">
                <label for="raca">Raça</label>
                <input type="text" name="raca" id="raca" class="form-control">
            </div>
            <br>
            <div class="col-4">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sexo" value="M" id="sexoM">
                    <label for="sexoM" class="form-check-label">Macho</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sexo" value="F" id="sexoF">
                    <label for="sexoF" class="form-check-label">Fêmea</label>
                </div>
            </div>

            <div class="col-4">
                <label for="observacao">Observações</label>
                <textarea name="observacao" class="form-control" id="observacao"></textarea>
            </div>
            <br>
            <button type="submit" name="enviarDados" class="btn btn-primary" value="CAD">Cadastrar</button>
            <a href="index_logado.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</body>

</html>