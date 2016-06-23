<?php

unset($erro);
 
/* URL */
$html_entre_as_duas_tabelas = ($_POST['html_entre_as_duas_tabelas']);
if (empty ($html_entre_as_duas_tabelas)) {
    $erro['html_entre_as_duas_tabelas'] = 'A URL nÃ£o pode ficar em branco!';
}

/* html_antes_do_caradapio_do_dia */
$html_antes_horario = ($_POST['html_antes_horario']);
if (empty ($html_antes_horario)) {
    $erro['html_antes_horario'] = 'Campo obrigatório!';
}

/* html_antes_do_prato */
$html_depois_horario = ($_POST['html_depois_horario']);
if (empty ($html_depois_horario)) {
    $erro['html_depois_horario'] = 'Campo obrigatório!';
}

/* html_depois_do_prato */
$html_antes_da_linha = ($_POST['html_antes_da_linha']);
if (empty ($html_antes_da_linha)) {
    $erro['html_antes_da_linha'] = 'Campo obrigatório!';
}

/* html_antes_da_data */
$html_depois_da_linha = ($_POST['html_depois_da_linha']);
if (empty ($html_depois_da_linha)) {
    $erro['html_depois_da_linha'] = 'Campo obrigatório!';
}

/* proxy */
$usa_proxy = $_POST['usa_proxy'];
if (!is_numeric($usa_proxy) || $usa_proxy>1 || $usa_proxy<0) {
    $erro['usa_proxy'] = 'Use o numero 0 para desativado e 1 para ativado';
} 

?>