<?php

/* tipo */
$tipo = filtro($_POST['tipo']);
if (valida_combobox($tipo, $gtipos_conteudo)) {
    $erro['tipo'] = 'Tipo inválido!';
}

/* URL */
$url = filtro($_POST['url']);
if ($tipo == 'link') {
    if (empty($url)) {
        $erro['url'] = 'A URL não pode ficar em branco!';
    }
}

/* titulo */
$titulo = filtro($_POST['titulo']);
if (empty($titulo)) {
    $erro['titulo'] = 'O título não pode ficar em branco!';
}
if (strlen($titulo) > 45) {
    $erro['titulo'] = 'O título deve ter no máximo 45 caracteres!';
}

/* conteudo */
$conteudo = $_POST['conteudo'];
if (empty($conteudo)) {
    $erro['conteudo'] = 'Conteudo inválido!';
}

/* id */
if (isset($_POST['id_conteudo'])) {
    $id_conteudo = filtro($_POST['id_conteudo']);
}
?>