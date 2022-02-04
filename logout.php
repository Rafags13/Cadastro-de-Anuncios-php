<?php
session_start();

print_r($_SESSION);
if (empty($_SESSION)) {
    header("Location: index.php?msgErro=Você não pode deslogar de um sistema, antes de logar!");
    die();
} else {
    session_destroy();
    header("Location: index.php?msgSucesso=Deslogado com sucesso!");
}
die();
