<?php

if (!isset($_SESSION))
    exit;
?>

<?php

###########################
###/* GET ITEM DEFAULT */##
###########################
if (isset($_GET['id1'])) {

    conecta();

    /* breadcrumbs */
    echo breadcrumb();

    /* conta o numero de níveis */
    $i = 0;
    $cont = 1;
    while (isset($_GET['id' . $cont])) {
        $i++;
        $cont++;
    }
    
    #################################################################
    /*                            MENU                             */
    #################################################################

    
    
    $rows = mysql_num_rows(mysql_query("SELECT * FROM menu WHERE id_menu_pai = " . $_GET['id' . $i] . " ORDER BY ordem"));
    
    if ($rows > 0) {
        $nivel = $i;
    } elseif ($i > 1) {
        $nivel = $i - 1;
    } else {
        $nivel = $i;
    }
    
    /* busca o titulo do menu lateral */
    $linha_titulo = mysql_fetch_array(mysql_query("SELECT titulo as titulo_menu FROM menu WHERE id_menu = " . $_GET['id' . $nivel]));
    
    $resultado = mysql_query("SELECT m.titulo as titulo_menu, c.conteudo, c.titulo as titulo_conteudo, c.url, c.tipo, m.id_menu FROM menu m INNER JOIN conteudo c ON c.id_conteudo = m.id_conteudo WHERE m.id_menu_pai = " . $_GET['id' . $nivel] . " ORDER BY m.ordem");

    
    $menu_lateral = '';
    /* monta o menu lateral*/
    while ($linha = mysql_fetch_array($resultado)) {
            $menu_lateral .= '<li><a href="index.php?s=menu';
            $j = 1;
            while ($j <= $nivel) {
                $menu_lateral .= '&id' . $j . '=' . $_GET['id' . $j];
                $j++;
            }
            $menu_lateral .= '&id' . $j . '=' . $linha['id_menu'];
            $menu_lateral .= '">' . $linha['titulo_menu'] . '</a></li>';
    }
    
    
    
    #################################################################
    /*                   CONTEUDO OU NOTICIAS                      */
    #################################################################
    
    if ($i == 1) {
        $linha = mysql_fetch_array(mysql_query("SELECT c.titulo as titulo_conteudo, m.titulo as titulo_menu, c.tipo, c.id_conteudo FROM menu m INNER JOIN conteudo c ON c.id_conteudo = m.id_conteudo WHERE m.id_menu = " . $_GET['id1']));
        
        /* se possui alguma noticia então mostra as noticias, senao mostra o conteudo do menu */
        if ($linha['titulo_menu'] == 'Página Inicial') {
            $rows = mysql_num_rows(mysql_query("SELECT * FROM noticia"));
        } else {
            $rows = mysql_num_rows(mysql_query("SELECT * FROM noticia WHERE id_menu = " . $_GET['id1']));
        }
        if ($rows > 0) {
            $linha['titulo_conteudo'] = 'Notícias';
        } else {
            $linha = mysql_fetch_array(mysql_query("SELECT c.titulo as titulo_conteudo, c.conteudo, c.url, c.tipo, c.id_conteudo FROM menu m INNER JOIN conteudo c ON c.id_conteudo = m.id_conteudo WHERE m.id_menu = " . $_GET['id1']));
        }
    } else {
        $linha = mysql_fetch_array(mysql_query("SELECT c.titulo as titulo_conteudo, c.conteudo, c.url, c.tipo, c.id_conteudo FROM menu m INNER JOIN conteudo c ON c.id_conteudo = m.id_conteudo WHERE m.id_menu = " . $_GET['id'.$i]));
    }

    #################################################################
    /*                     MONTA A PÁGINA                          */
    #################################################################

    echo '
        <div id="container">
            <div id="esquerda">
                <div id="menu_lateral">
                    <div id="menu_lateral_titulo">
                        ' . $linha_titulo['titulo_menu'] . '
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
                        ' . $linha['titulo_conteudo'] . '
                    </div>
                    <div id="template_corpo">';
    if (isset($linha['conteudo'])) {
        echo $linha['conteudo'];
        if ($linha['tipo'] == 'link') {
            echo '<br/><a target="_blank" href="index.php?s=link&id_conteudo='.$linha['id_conteudo'].'">Clique aqui!</a>';
        }
    } else {
        include 'modules/noticia/noticias.php';
    }
    echo '</div>
                </div>
            </div>
            <br clear="both">
        </div>
';
} else {
    /* se nao foi passado modulo por GET, busca no sistema o primeiro da ordem que nao possui menu_pai e redireciona a pagina */
    conecta();

    /* busca os modulos do sistema */
    if ($linha = mysql_fetch_array(mysql_query("SELECT * FROM menu WHERE id_menu_pai = '' OR id_menu_pai IS NULL ORDER BY ordem LIMIT 1"))) {
        header('location: index.php?s=menu&id1=' . $linha['id_menu']);
    }
}
?>