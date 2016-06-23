<?php
 
/* URL */
$url = filtro($_POST['url']);
if (empty ($url)) {
    $erro['url'] = 'A URL não pode ficar em branco!';
}

/* nome */
$nome = filtro($_POST['nome']);
if (empty ($nome)) {
    $erro['nome'] = 'O nome não pode ficar em branco!';
}

/* nro_itens */
$nro_itens = $_POST['nro_itens'];
if (empty($nro_itens) || !is_numeric($nro_itens)) {
    $erro['nro_itens'] = 'Número de Itens inválido!';
}

/* mostrar */
$mostrar = filtro($_POST['mostrar']);
if (valida_combobox($mostrar, $gmostrar)) {
    $erro['mostrar'] = 'Campo Mostrar inválido!';
}

/* id */
if (isset($_POST['id_rss'])) {
    $id_rss = filtro($_POST['id_rss']);
}
 
?>