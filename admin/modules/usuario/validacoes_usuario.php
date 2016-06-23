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


/* valida o campo nivel */
/* filtra a string */
$nivel = filtro($_POST['nivel']);

/* parametros: valor, valores_validos */
if (valida_combobox($nivel, array('1', '2'))) {
    $erro['nivel'] = 'Nível inválido!';
}


/* valida o campo login */
/* filtra a string */
$login = filtro($_POST['login']);

if (valida_login($login)) {
    $erro['login'] = 'Login deve possuir mais de 6 caracteres!';
}

if (isset($_POST['id_usuario'])) {
    $id_usuario = filtro($_POST['id_usuario']);
}
?>