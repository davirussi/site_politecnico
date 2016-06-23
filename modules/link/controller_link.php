<?php

if (!isset($_SESSION))
    exit;
?>

<?php

###########################
###/* GET ITEM DEFAULT */##
###########################
if (isset($_GET['id_conteudo'])) {
    
    
    $linha = mysql_fetch_array(mysql_query("SELECT url FROM conteudo WHERE id_conteudo = " . $_GET['id_conteudo']));

    if (substr($linha['url'], 0, 7) == 'http://') {
        header('location: ' . $linha['url']);
    } else {
        $arquivo = $g_caminho_arquivos . $linha['url'];
        if (isset($arquivo) && file_exists($arquivo)) { // faz o teste se a variavel não esta vazia e se o arquivo realmente existe            
            foreach ($g_tipos_ext as $tipo_ => $ext) {
                if (strtolower(substr(strrchr(basename($arquivo), "."), 1)) == $ext) {
                    $tipo = $tipo_;
                }
            }
            
            header('location: baixar.php?tipo='. $tipo . '&arquivo=' . $arquivo);

        }
    }
}
?>