<?php

if (!isset($_SESSION))
    exit;
?>

<?php

###########################
###/* GET ITEM DEFAULT */##
###########################
if ($_GET['id_noticia']) {

    conecta();

    /* breadcrumbs */
    echo breadcrumb();


    #################################################################
    /*                            MENU                             */
    #################################################################

    $menu_lateral = "";

    $resultado = mysql_query("SELECT * FROM menu WHERE id_menu_pai = " . $_GET['id1'] . " ORDER BY ordem");
    $linha_titulo_menu = mysql_fetch_array(mysql_query("SELECT titulo FROM menu WHERE id_menu = " . $_GET['id1']));

    /* monta o menu */
    while ($filhos = mysql_fetch_array($resultado)) {
        if ($filhos_1['tipo'] == 'link') {
            $menu_lateral .= '<li><a href="' . $filhos['conteudo'] . '" target="_blank">' . $filhos['titulo'] . '</a></li>';
        } else {
            $menu_lateral .= '<li><a href="index.php?s=menu&id1=' . $_GET['id1'] . '&id2=' . $filhos['id_menu'] . '">' . $filhos['titulo'] . '</a></li>';
        }
    }


    #################################################################
    /*                      BUSCA A NOTICIA                        */
    #################################################################
    $linha_noticia = mysql_fetch_array(mysql_query("SELECT * FROM noticia WHERE id_noticia = " . $_GET['id_noticia']));
    
    

    #################################################################
    /*                     MONTA A PÁGINA                          */
    #################################################################

    echo '
        <div id="container">
            <div id="esquerda">
                <div id="menu_lateral">
                    <div id="menu_lateral_titulo">
                        ' . $linha_titulo_menu['titulo'] . '
                    </div>
                    <div id="menu_lateral_corpo">  
                        <ul>
                            ' . $menu_lateral . '
                            <br style="clear: left" />
                        </ul>
                    </div>
                </div>
                <div id="servicos">
                    ';
    /* inclui o arquivo de serviços */
    include_once 'pagina/servicos.php';

    echo '</div>
            </div>
            <div id="direita">
                <div id="template">
                    <div id="template_titulo">
                        ' . $linha_noticia['titulo'] . '
                    </div>
                    <div id="template_corpo">'
                    . $linha_noticia['conteudo'] .
                    '<div style="color: gray; font-size: 12px;">
                        '.formata_data($linha_noticia['data'], 'datetime', 'buscar').'
                     </div>   
                    </div>
                </div>
            </div>
            <br clear="both">
        </div>
';
} else {
    /* se nao foi passado modulo por GET, busca no sistema o primeiro da ordem que nao possui menu_pai e redireciona a pagina */
    conecta();

    /* busca os modulos do sistema */
    if ($linha_menu = mysql_fetch_array(mysql_query("SELECT * FROM menu WHERE id_menu_pai = '' OR id_menu_pai IS NULL ORDER BY ordem LIMIT 1"))) {
        header('location: index.php?s=menu&id1=' . $linha_menu['id_menu']);
    }
}
?>