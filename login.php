<?php
    require_once 'system\config.php';
    require_once 'system\database.php';
/**
 * Created by PhpStorm.
 * User: Murilo
 * Date: 09/07/2015
 * Time: 12:32
 */

    if(isset($_POST['entrar'])){
        session_start();
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $dbCheck = DBRead('admin', "WHERE login = '{$login}' AND senha = '{$senha}'");
        if(!$dbCheck){
            echo "Login ou Senha não reconhecidos";
        } else {
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            header('Location: painel\index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Postagens</title>
</head>

<body>
    <form action="" method="post">
        <p>
            <label>Login</label><br>
            <input type="text" name="login">
        </p>

        <p>
            <label>Senha</label><br>
            <input type="password" name="senha">
        </p>
        <p>
            <input type="submit" name="entrar" value="Entrar">
        </p>
    </form>
</body>
</html>