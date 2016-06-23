<?php
if (isset($_SESSION['id_usuario'])) {
    header('location: index.php?s=inicial');
    exit;
}

if (isset($_POST['enviar'])) {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if (empty($login)) {
        $erro['login'] = 'Login em branco!';
    }
    if (empty($senha)) {
        $erro['senha'] = 'Senha em branco!';
    }

    if (count($erro) == 0) {
        conecta();

        $query = 'SELECT * FROM usuario WHERE login = "' . $login . '"'; //por login ser uma string, aspas duplas
        $resultado = mysql_query($query);
        $row = mysql_num_rows($resultado);

        if ($row == 0) {
            $erro['erro'] = 'Login ou senha incorretos';
        }


        $linha = mysql_fetch_array($resultado); //pega uma linha do resultado

        if ($linha['senha'] != md5($senha)) {
            $erro['erro'] = 'Login ou senha incorretos';
        }
    }
    if (count($erro) == 0) {
        /**
         * iniciar sessão
         */
        //session_start();

        $_SESSION['id_usuario'] = $linha['id_usuario'];
        $_SESSION['login'] = $linha['login'];
        $_SESSION['senha'] = $linha['senha'];
        $_SESSION['nivel'] = $linha['nivel'];


        /*
         * função que redireciona para outra página
         */

        header('location: index.php?s=inicial');
    }
}
?>
<div class="fundo" style="width: 400px; height: 200px; padding: 20px">
    <form action="" method="post">
        <div class="label">Login:</div><div><input type="text" name="login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];}?>"/></div>
        <?php if (isset($erro['login'])) {echo '<span style="color: red;">' . $erro['login'] . '</span>';}?>
        <div class="label">Senha:</div><div><input type="password" name="senha"/></div>
        <?php if (isset($erro['senha'])) {echo '<span style="color: red;">' . $erro['senha'] . '</span>';}?>
        <br/>
        <?php if (isset($erro['erro'])) {echo '<span style="color: red;">' . $erro['erro'] . '</span>';}?>
        <br/>
        <input type="submit" name="enviar" value="Login"/>

    </form>
</div>