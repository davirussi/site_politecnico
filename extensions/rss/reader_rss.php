<?php

include_once '../../funcoes.php';

conecta();
$resultado = mysql_query("SELECT * FROM rss WHERE mostrar = 1");

while ($linha = mysql_fetch_array($resultado)) {
    $rss = simplexml_load_file($linha['url']);
    
    echo sprintf('<table id="rss"><tr><th>%s</th></tr>', $rss->channel->title);
    $cont = 0;
    foreach ($rss->channel->item as $item) {
        if ($cont >= $linha['nro_itens']) {
            break;
        }
        echo sprintf('<tr><td><a href="%s" target="_blank">%s<a/></td></tr>', $item->link, $item->title);
        $cont++;
    }
    echo '</table>';
}
?>