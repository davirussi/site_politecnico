<?php

if (!isset($_SESSION))
    exit;
valida_logado(1);
?>

<?php

##############################################################
#####/* se a ação selecionada for LISTAR  (action default)*/##
##############################################################
if (!isset($_GET['action']) || $_GET['action'] == 'listar') {

    /* breadcrumbs */
    echo breadcrumbs(array('Notícias' => ''));

    /* titulo principal */
    echo '<h1>Notícias</h1>';

    /* botao inserir novo */
    echo '<span class="right"><h3><a href="index.php?s=noticia&action=inserir" title="Novo">+ Novo</a></h3></span>';

    $display = 'none';
    /* se foi pressionado o botão buscar da pesquisa */
    if ($_POST['buscar']) {
        /* mostra o formulario de pesquisa */
        $display = '';

        $where = ' WHERE 1=1 ';

        /* recebe as variaveis de busca e monta o WHERE */
        if ($_POST['titulo']) {
            $titulo = $_POST['titulo']; /* inicializa a variavel para mostrar no form */
            $where .= ' AND n.titulo LIKE "%' . $titulo . '%"';
        }
    }

    /* botao pesquisa :: onclick (mostra ou esconde o formulario de pesquisa) */
    echo botao_pesquisa();

    /* formulario de busca */
    echo '<div class="form_pesquisa" style="display:' . $display . ';">
            <form action="index.php?s=noticia&action=listar" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td class="label">Título:</td>
                        <td>
                            <input type="text" name="titulo" value="' . $titulo . '" style="width:400px;"/>
                        </td>
                        <td>
                            <input type="submit" name="buscar" value="Buscar"/>
                        </td>
                    </tr>
                </table>
            </form>
          </div>';

    conecta();

    $query = "SELECT    n.*, 
                        m.titulo as classificacao,
                        u.login
                        FROM noticia n 
                        INNER JOIN menu m ON m.id_menu = n.id_menu 
                        INNER JOIN usuario u ON u.id_usuario = n.id_usuario 
                        " . $where . " ORDER BY n.data DESC";

    $resultado = mysql_query($query);

    /* mostra o pager da paginação - display com o numero de paginas - parametro: path imagens */
    echo display_pager();

    /* se nao retornou nenhum resultado */
    if (mysql_num_rows($resultado) == 0) {
        echo '<span class="erro">Nenhum resultado encontrado!</span><br>';
    } else {

        /* botoes para exportar */
        include 'php/botoes_exportar.php';

        /* monta a tabela que irá listar os dados */
        echo '
        <table class="tableorder tablepager tablelistar">
            <thead>
            <tr>
                <th style="width:100px; text-align: center !important;">
                    Operações
                </th>
                <th>
                    Título
                </th>
                <th>
                    Classificação
                </th>
                <th>
                    Criada por:
                </th>
                <th>
                    Data
                </th>
            </tr>
            </thead>
            <tbody>
';


        /* executa enquanto existir registro na tabela */
        while ($linha = mysql_fetch_array($resultado)) {
            echo '
            <tr>
                <td align="center">
                    <a href="index.php?s=noticia&action=editar&id_noticia=' . $linha['id_noticia'] . '"><img title="Editar" src="images/editar.png"/></a>
                    <a href="index.php?s=noticia&action=visualizar&id_noticia=' . $linha['id_noticia'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
                    <a href="index.php?s=noticia&action=excluir&id_noticia=' . $linha['id_noticia'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                </td>
                <td>
                    ' . $linha['titulo'] . '
                </td>
                <td>
                    ' . $linha['classificacao'] . '
                </td>
                <td>
                    ' . $linha['login'] . '
                </td>
                <td>
                    ' . formata_data($linha['data'], 'datetime', 'buscar') . '
                </td>
               </tr>
             ';
        }

        echo '</tbody></table>';


        ###############################################
        #####/* Gera a tabela para exportação  */######
        ###############################################
        /* recebe os titulos da tabela */
        $tabela_exportar = '<table class="tabela_exportar"><tr>
                            <th>
                                Título
                            </th>
                            <th>
                                Classificação
                            </th>
                            <th>
                                Data
                            </th>
                             </tr>';

        /* realiza a consulta novamente */
        $resultado = mysql_query($query);

        $cont = 0;

        /* monta a tabela para exportar */
        while ($linha = mysql_fetch_array($resultado)) {
            (($cont % 2) == 0) ? ($even_odd = 'even') : ($even_odd = 'odd');
            $tabela_exportar .= '
            <tr class="' . $even_odd . '">
                <td>
                    ' . $linha['titulo'] . '
                </td>
                <td>
                    ' . $linha['classificacao'] . '
                </td>
                <td>
                    ' . formata_data($linha['data'], 'datetime', 'buscar') . '
                </td>
            </tr>
             ';
            $cont++;
        }
        $tabela_exportar .= '</table>';

        /* define o nome do arquivo que será gerado */
        $nome_arquivo = "noticias";

        /* form  para exportar os dados */
        include 'php/form_exportar.php';

        ######################
        #/* Fim Exportação */#
        ######################
    }
}

##############################################
#####/* se a ação selecionada for INSERIR */##
##############################################
if ($_GET['action'] == 'inserir') {
    /* breadcrumbs */
    echo breadcrumbs(array('Notícias' => 'index.php?s=noticia', 'Inserir Notícia' => ''));

    /* titulo principal */
    echo '<h1>Inserir</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=noticia&action=inserir';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/noticia/validacoes_noticia.php';


        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "INSERT  INTO noticia (titulo, resumo, conteudo, id_menu, id_usuario) VALUES ('$titulo', '$resumo', '$conteudo', $classificacao, " . $_SESSION['id_usuario'] . ")";
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                /* atualiza o arquivo XML do RSS */
                gera_xml_rss('../rss.xml');
                /* se nao ocorreu erros redireciona para a action default LISTAR */
                header('location: index.php?s=noticia');
            }
        } else { /* se ocorreu erro, mostra o form com os erros */
            /* importa o formulario */
            include_once 'modules/noticia/form_noticia.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form */
        /* importa o formulario */
        include_once 'modules/noticia/form_noticia.php';
    }
}

##############################################
#####/* se a ação selecionada for EDITAR  */##
##############################################
if ($_GET['action'] == 'editar') {
    /* breadcrumbs */
    echo breadcrumbs(array('Notícias' => 'index.php?s=noticia', 'Editar Notícia' => ''));

    /* titulo principal */
    echo '<h1>Editar</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=noticia&action=editar';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/noticia/validacoes_noticia.php';

        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "UPDATE noticia SET titulo = '" . $titulo . "', resumo = '" . $resumo . "', conteudo = '" . $conteudo . "', id_menu = " . $classificacao . " WHERE id_noticia = " . $id_noticia;
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                /* atualiza o arquivo XML do RSS */
                gera_xml_rss('../rss.xml');
                /* se nao ocorreu erros redireciona para a action VISUALIZAR */
                header('location: index.php?s=noticia&action=visualizar&id_noticia=' . $id_noticia);
            }
        } else {
            /* importa o formulario */
            include_once 'modules/noticia/form_noticia.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form com os dados do editado */
        conecta();
        /* busca os dados do editado */
        $query = "SELECT n.*, m.titulo as classificacao FROM noticia n INNER JOIN menu m ON m.id_menu = n.id_menu WHERE id_noticia = " . $_GET['id_noticia'];
        $resultado = mysql_query($query);

        if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
            echo '<span class="erro">Erro de Conexão!</span>';
        } else {

            $linha = mysql_fetch_array($resultado);
            $id_noticia = $linha['id_noticia'];
            $titulo = $linha['titulo'];
            $resumo = $linha['resumo'];
            $conteudo = $linha['conteudo'];
            $classificacao = $linha['classificacao'];
            $data = $linha['data'];


            /* importa o formulario */
            include_once 'modules/noticia/form_noticia.php';
        }
    }
}

##################################################
#####/* se a ação selecionada for VISUALIZAR  */##
##################################################
if ($_GET['action'] == 'visualizar') {
    /* breadcrumbs */
    echo breadcrumbs(array('Notícias' => 'index.php?s=noticia', 'Visualizar Notícia' => ''));

    /* titulo principal */
    echo '<h1>Visualizar</h1>';

    conecta();
    /* busca os dados do editado */
    $query = "SELECT n.*, m.titulo as classificacao FROM noticia n INNER JOIN menu m ON m.id_menu = n.id_menu WHERE id_noticia = " . $_GET['id_noticia'];
    $resultado = mysql_query($query);

    if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
        echo '<span class="erro">Erro de Conexão!</span>';
    } else {

        $linha = mysql_fetch_array($resultado);
        $id_noticia = $linha['id_noticia'];
        $titulo = $linha['titulo'];
        $resumo = $linha['resumo'];
        $conteudo = $linha['conteudo'];
        $classificacao = $linha['classificacao'];
        $data = $linha['data'];


        /* monta a tabela de vizualização */

        echo "
            <table class='visualizar'>
                <tr>
                    <td class='label'>
                        Título:
                    </td>
                    <td>
                        " . $titulo . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Resumo:
                    </td>
                    <td>
                        " . $resumo . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Conteúdo:
                    </td>
                    <td>
                        " . $conteudo . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Classificação:
                    </td>
                    <td>
                        " . $classificacao . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Data:
                    </td>
                    <td>
                        " . formata_data($data, 'datetime', 'buscar') . "
                    </td>
                </tr>
            </table>";
    }
}

##################################################
#####/* se a ação selecionada for EXCLUIR     */##
##################################################
if ($_GET['action'] == 'excluir') {
    /* breadcrumbs */
    echo breadcrumbs(array('Notícias' => 'index.php?s=noticia', 'Excluir Notícia' => ''));

    /* titulo principal */
    echo '<h1>Excluir</h1>';

    /* se foi pressionado o botão EXCLUIR */
    if ($_POST['excluir']) {

        conecta();

        /* verifica se o registro existe */
        $query = "SELECT * FROM noticia WHERE id_noticia = " . $_GET['id_noticia'];
        $resultado = mysql_query($query);
        $linha = mysql_fetch_array($resultado);

        if (mysql_num_rows($resultado) == 0) {
            echo '<span class="erro">Registro não existe!</span>';
        } else {

            /* exclui registro */
            $query = "DELETE FROM noticia WHERE id_noticia = " . $_GET['id_noticia'];
            $resultado = mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                /* atualiza o arquivo XML do RSS */
                gera_xml_rss('../rss.xml');
                echo "<p> Deletado com sucesso!</p><br><input type='button' value='Voltar' onclick='history.go(-2)'/>";
            }
        }
    } else {
        /* mostra o form excluir - pergunta se tem certeza */
        echo form_excluir();
    }
}
?>