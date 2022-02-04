<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Cadastrar novo usuário</h1>
        <form action="processa_usuario.php" method="post">
            <div class="col-4">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" id="nome" class="form-control">
            </div>

            <div class="col-4">
                <label for="dataNascimento">Data de Nascimento</label>
                <input type="date" name="dataNascimento" id="dataNascimento" class="form-control" value="1980-01-01">
            </div>

            <div class="col-4">
                <label for="telefone">Telefone para contato</label>
                <input type="tel" name="telefone" id="telefone" class="form-control">
            </div>

            <div class="col-4">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="col-4">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control">
            </div><br />
            <button type="submit" name="enviarDados" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</body>

</html>