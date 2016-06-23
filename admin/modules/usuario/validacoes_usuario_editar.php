<?php

/* valida o campo nivel */
/* filtra a string */
$nivel = filtro($_POST['nivel']);

/* parametros: valor, valores_validos */
if (valida_combobox($nivel, $gniveis)) {
    $erro['nivel'] = 'Nível inválido!';
}

if (isset($_POST['id_usuario'])) {
    $id_usuario = filtro($_POST['id_usuario']);
}
?>