<?php

/* valida o campo título e ano */
/* filtra a string */
$titulo = filtro($_POST['titulo']);
if (empty($titulo)) {
    $erro['titulo'] = 'O título não pode ficar em branco!';
}
if (strlen($titulo) > 45) {
    $erro['titulo'] = 'O título deve ter no máximo 45 caracteres!';
}

/* ordem */
$ordem = filtro($_POST['ordem']);
if (empty($ordem) || (!is_numeric($ordem))) {
    $erro['ordem'] = 'A ordem não pode ficar em branco e deve ser numérico!';
}

/* id_menu_pai */
if (isset($_POST['id_menu_pai'])) {
    $id_menu_pai = filtro($_POST['id_menu_pai']);
    if ($id_menu_pai == '') {
        $id_menu_pai = 'NULL';
    }
}

/* id */
if (isset($_POST['id_menu'])) {
    $id_menu = filtro($_POST['id_menu']);
}


$id_conteudo = filtro($_POST['id_conteudo']);

/* se é filho de algum outro menu */
$id_menu_pai = filtro($_POST['id_menu_pai']);

##################################
if ($id_conteudo == '') {
    /* valida o conteudo novo */
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

    /* titulo_conteudo */
    $titulo_conteudo = filtro($_POST['titulo_conteudo']);
    if (empty($titulo_conteudo)) {
        $erro['titulo_conteudo'] = 'O título não pode ficar em branco!';
    }
    if (strlen($titulo_conteudo) > 45) {
        $erro['titulo_conteudo'] = 'O título deve ter no máximo 45 caracteres!';
    }

    /* conteudo */
    $conteudo = $_POST['conteudo'];
    if (empty($conteudo)) {
        $erro['conteudo'] = 'Conteudo inválido!';
    }
}
?>