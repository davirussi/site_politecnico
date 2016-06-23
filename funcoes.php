<?php

#####################################################
##/*                   Funções                   */##
#####################################################


/* variaveis globais do sistema */

/* caminho dos arquivos */
$g_caminho_arquivos = '../../arquivos/';

/* caminho das fotos */
$g_caminho_fotos = 'http://localhost/informatica_poli/fotos/';

/* tamanho maximo de arquivo */
$g_tamanho_arquivo = '100000000000';

/* extensoes validas de arquivo */
$g_tipos_ext = array(
    'application/pdf' => 'pdf',
    //'application/octet-stream' => 'exe',
    'application/zip' => 'zip',
    'application/msword' => 'doc',
    'application/vnd.ms-excel' => 'xls',
    'application/vnd.ms-powerpoint' => 'ppt',
    'image/gif' => 'gif',
    'image/png' => 'png',
    'image/jpg' => 'jpg',
);

/* extensoes validas de fotos */
$g_tipos_ext_fotos = array(
    'image/gif' => 'gif',
    'image/png' => 'png',
    'image/jpg' => 'jpg',
    'image/jpeg' => 'jpg',
);



/* conecta no banco */

function conecta() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "informatica_poli";
    $conn = mysql_connect($host, $user, $password);
    if (!$conn) {
        echo('Problemas na conexão');
    }
    $db_selected = mysql_select_db($dbname, $conn);

    return $conn;
}

/* breadcrumbs */

function breadcrumb($divisor = ' -> ') {
    /* conta o numero de níveis */
    $nro_niveis = 0;
    $cont = 1;
    while (isset($_GET['id' . $cont])) {
        $nro_niveis++;
        $cont++;
    }

    $breadcrumbs = '';

    $j = 1;
    while ($j <= $nro_niveis) {
        $linha_menu = mysql_fetch_array(mysql_query("SELECT titulo FROM menu WHERE id_menu = " . $_GET['id' . $j]));
        if ($linha_menu['titulo'] != 'Página Inicial') {
            $breadcrumbs .= $divisor;
        }
        $breadcrumbs .= ' <a href="index.php?s=menu';
        $k = 1;
        while ($k <= $j) {
            $breadcrumbs .= '&id' . $k . '=' . $_GET['id' . $k];
            $k++;
        }
        $breadcrumbs .= '"> ' . $linha_menu['titulo'] . '</a>';

        $j++;
    }

    $breadcrumbs .= '</div>';

    if (isset($_GET['id1'])) {
        $linha_menu = mysql_fetch_array(mysql_query("SELECT titulo FROM menu WHERE id_menu = " . $_GET['id1']));
        if ($linha_menu['titulo'] != 'Página Inicial') {
            $inicio = '<div id="breadcrumbs"><a href="index.php">Página Inicial</a>';
        } else {
            $inicio = '<div id="breadcrumbs">';
        }
    }

    return $inicio . $breadcrumbs;
}

function gera_xml_rss($caminho = 'rss.xml') {
    $conteudo = '<?xml version="1.0" encoding="UTF-8"?>';
    $conteudo .= '<rss version="2.0">
    <channel>
        <title> Politécnico UFSM Informática </title>
        <link>http://localhost/informatica_poli/</link>
        <description>Site de informática do CPUFSM</description>';

    $resultado = mysql_query("SELECT * FROM noticia ORDER BY data desc LIMIT 20");
    while ($linha = mysql_fetch_array($resultado)) {
        $conteudo .= "
                <item>
                    <title>" . $linha['titulo'] . "</title>
                    <link>http://localhost/informatica_poli/index.php?s=noticia&#38;id_noticia=" . $linha['id_noticia'] . "&#38;id1=" . $linha['id_menu'] . "</link>
                    <description>" . $linha['resumo'] . "</description>
                </item>
                ";
    }


    $conteudo .= "
    </channel>
</rss>";

    $file = fopen($caminho, 'w');
    fwrite($file, $conteudo);
    fclose($file);
}

//funcao que formata a data :: parametros data, tipo(date, datetime), modo(salvar, buscar)

function formata_data($pdata, $tipo, $modo) {

    if ($modo == 'buscar') {
        if ($tipo == 'datetime') {

            //recebe o parâmetro e armazena em um array separado por -
            $horadata = explode(' ', $pdata);
            //armazena na variavel data os valores do vetor data e concatena  invertendo os valores para dd mm yyy/
            //ano/mes/dia
            $aux = explode('-', $horadata[0]);
            //hora/minuto/segundo
            $aux2 = explode(':', $horadata[1]);

            $pdata = $aux[2] . '/' . $aux[1] . '/' . $aux[0] . ' - ' . $aux2[0] . ':' . $aux2[1] . ':' . $aux2[2] . '';
            return $pdata;
        }
        if ($tipo == 'date') {
            //ano/mes/dia
            $aux = explode('-', $pdata);
            $pdata = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
            return $pdata;
        }
    }
    if ($modo == 'salvar') {
        if ($tipo == 'datetime') {
            $pdata = explode('/', $pdata);
            $pdata = $pdata[2] . '-' . $pdata[1] . '-' . $pdata[0];
            return $pdata;
        }
        if ($tipo == 'date') {
            $pdata = explode('/', $pdata);
            $pdata = $pdata[2] . '-' . $pdata[1] . '-' . $pdata[0];
            //adiciona o time
            $pdata .= " 00:00:00";
            return $pdata;
        }
    }
}

?>