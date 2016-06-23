<?php

unset($erro);
 
/* URL */
$url = ($_POST['url']);
if (empty ($url)) {
    $erro['url'] = 'A URL nÃ£o pode ficar em branco!';
}

/* html_antes_do_caradapio_do_dia */
$html_antes_do_cardapio_do_dia = ($_POST['html_antes_do_cardapio_do_dia']);
if (empty ($html_antes_do_cardapio_do_dia)) {
    $erro['html_antes_do_cardapio_do_dia'] = 'Campo obrigatório!';
}

/* html_antes_do_prato */
$html_antes_do_prato = ($_POST['html_antes_do_prato']);
if (empty ($html_antes_do_prato)) {
    $erro['html_antes_do_prato'] = 'Campo obrigatório!';
}

/* html_depois_do_prato */
$html_depois_do_prato = ($_POST['html_depois_do_prato']);
if (empty ($html_depois_do_prato)) {
    $erro['html_depois_do_prato'] = 'Campo obrigatório!';
}

/* html_antes_da_data */
$html_antes_data = ($_POST['html_antes_data']);
if (empty ($html_antes_data)) {
    $erro['html_antes_data'] = 'Campo obrigatório!';
}

/* html_depois_da_data */
$html_depois_data = ($_POST['html_depois_data']);
if (empty ($html_depois_data)) {
    $erro['html_depois_data'] = 'Campo obrigatório!';
}

/* separador_de_data */
$separador_explode_data = ($_POST['separador_explode_data']);
if (empty ($separador_explode_data)) {
    $erro['separador_explode_data'] = 'Digite o caracter de separacao';
}

/* proxy */
$usa_proxy = $_POST['usa_proxy'];
if (!is_numeric($usa_proxy) || $usa_proxy>1 || $usa_proxy<0) {
    $erro['usa_proxy'] = 'Use o numero 0 para desativado e 1 para ativado';
} 

?>