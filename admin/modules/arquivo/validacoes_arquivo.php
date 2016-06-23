<?php

/* arquivo */
$name = 'arquivo';
$tamanho = $g_tamanho_arquivo;

/* se existe algum erro */
if ($_FILES[$name]["error"] > 0) {
    $erro[$name] = 'Erro no envio do arquivo';
}
/* valida o tamanho do arquivo */
if ($_FILES[$name]["size"] > $tamanho) {
    $kb = $tamanho / 1024;
    $erro[$name] = "O tamanho máximo do arquivo é $kb Kb!";
}
/* valida os tipos de arquivos possíveis */
$valida = 0;
foreach ($g_tipos_ext as $tipo => $ext) {
    if ($_FILES[$name]["type"] == $tipo) {
        $valida = 1;
    }
}
if ($valida == 0) {
    $erro[$name] = "Tipo de arquivo inválido!";
}


$file_name = $_FILES[$name]['name'];
$file_type = $_FILES[$name]['type'];
$file_size = $_FILES[$name]['size'];
$file_tmp_name = $_FILES[$name]['tmp_name'];


conecta();
$rows = mysql_num_rows(mysql_query("SELECT * FROM arquivo WHERE nome = '" . $file_name . "'"));
if ($rows > 0) {
    $erro[$name] = 'Este nome de arquivo já existe no servidor!';
}


?>