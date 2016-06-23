<?php

/* valida o campo senha */
/* filtra a string */
$senha = filtro($_POST['senha']);
$senha2 = filtro($_POST['senha2']);

if (valida_senha($senha)) {
    $erro['senha'] = 'Senha deve possuir mais de 6 caracteres!';
}

/* verifica se as senhas são iguais */
if ($senha != $senha2) {
    $erro['senha'] = 'As senhas  são diferentes!';
}

if (isset($_POST['id_usuario'])) {
    $id_usuario = filtro($_POST['id_usuario']);
}

/* verifica a senha atual somente se não for administrador */
if ($_SESSION['nivel'] != 1) {
    /* verifica se a senha atual esta correta */
    conecta();
    $query = "SELECT senha FROM usuario WHERE id_usuario = " . $id_usuario;
    $resultado = mysql_query($query);
    $linha = mysql_fetch_array($resultado);

    if ($linha['senha'] != md5($_POST['senha_atual'])) {
        $erro['senha_atual'] = 'Senha atual incorreta!';
    }
}
?>