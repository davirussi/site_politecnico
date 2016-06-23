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
    echo breadcrumbs(array('RSS' => ''));

    /* titulo principal */
    echo '<h1>RSS</h1>';

    /* botao inserir novo */
    echo '<span class="right"><h3><a href="index.php?s=rss&action=inserir" title="Novo">+ Novo</a></h3></span>';

    $display = 'none';
    /* se foi pressionado o botão buscar da pesquisa */
    if ($_POST['buscar']) {
        /* mostra o formulario de pesquisa */
        $display = '';

        $where = ' WHERE 1=1 ';

        /* recebe as variaveis de busca e monta o WHERE */
        if ($_POST['url']) {
            $url = $_POST['url']; /* inicializa a variavel para mostrar no form */
            $where .= ' AND url LIKE "%' . $url . '%"';
        }
    }

    /* botao pesquisa :: onclick (mostra ou esconde o formulario de pesquisa) */
    echo botao_pesquisa();

    /* formulario de busca */
    echo '<div class="form_pesquisa" style="display:' . $display . ';">
            <form action="index.php?s=rss&action=listar" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td class="label">URL:</td>
                        <td>
                            <input type="text" name="url" value="' . $url . '" style="width:400px;"/>
                        </td>
                        <td>
                            <input type="submit" name="buscar" value="Buscar"/>
                        </td>
                    </tr>
                </table>
            </form>
          </div>';

    conecta();

    $query = "SELECT * FROM rss " . $where;

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
                    Nome
                </th>
                <th>
                    URL
                </th>
                <th>
                    Número de Itens Visualizados
                </th>
                <th>
                    Mostrar
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
                    <a href="index.php?s=rss&action=editar&id_rss=' . $linha['id_rss'] . '"><img title="Editar" src="images/editar.png"/></a>
                    <a href="index.php?s=rss&action=visualizar&id_rss=' . $linha['id_rss'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
                    <a href="index.php?s=rss&action=excluir&id_rss=' . $linha['id_rss'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                </td>
                <td>
                    ' . $linha['nome'] . '
                </td>
                <td>
                    ' . $linha['url'] . '
                </td>
                <td>
                    ' . $linha['nro_itens'] . '
                </td>
                <td>
                    ' . ($linha['mostrar']?'Sim':'Não') . '
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
                                Nome
                            </th>
                            <th>
                                URL
                            </th>
                            <th>
                                Número de Itens Visualizados
                            </th>
                            <th>
                                Mostrar
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
                    ' . $linha['nome'] . '
                </td>
                <td>
                    ' . $linha['url'] . '
                </td>
                <td>
                    ' . $linha['nro_itens'] . '
                </td>
                <td>
                    ' . ($linha['mostrar']?'Sim':'Não') . '
                </td>
            </tr>
             ';
            $cont++;
        }
        $tabela_exportar .= '</table>';

        /* define o nome do arquivo que será gerado */
        $nome_arquivo = "rss";

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
    echo breadcrumbs(array('RSS' => 'index.php?s=rss', 'Inserir Feed RSS' => ''));

    /* titulo principal */
    echo '<h1>Inserir</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=rss&action=inserir';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/rss/validacoes_rss.php';


        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "INSERT  INTO rss (url, nome, nro_itens, mostrar) VALUES ('$url', '$nome', $nro_itens, $mostrar)";
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {

                /* se nao ocorreu erros redireciona para a action default LISTAR */
                header('location: index.php?s=rss');
            }
        } else { /* se ocorreu erro, mostra o form com os erros */
            /* importa o formulario */
            include_once 'modules/rss/form_rss.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form */
        /* importa o formulario */
         include_once 'modules/rss/form_rss.php';
    }
}

##############################################
#####/* se a ação selecionada for EDITAR  */##
##############################################
if ($_GET['action'] == 'editar') {
    /* breadcrumbs */
    echo breadcrumbs(array('RSS' => 'index.php?s=rss', 'Editar Feed RSS' => ''));

    /* titulo principal */
    echo '<h1>Editar</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=rss&action=editar';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/rss/validacoes_rss.php';

        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "UPDATE rss SET url = '" . $url . "', nome = '" . $nome . "', nro_itens = " . $nro_itens . ", mostrar = " . $mostrar . " WHERE id_rss = " . $id_rss;
      
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {

                /* se nao ocorreu erros redireciona para a action VISUALIZAR */
                header('location: index.php?s=rss&action=visualizar&id_rss=' . $id_rss);
            }
        } else {
            /* importa o formulario */
            include_once 'modules/rss/form_rss.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form com os dados do editado */
        conecta();
        /* busca os dados do editado */
        $query = "SELECT * FROM rss WHERE id_rss = " . $_GET['id_rss'];
        $resultado = mysql_query($query);

        if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
            echo '<span class="erro">Erro de Conexão!</span>';
        } else {

            $linha = mysql_fetch_array($resultado);
            $url = $linha['url'];
            $nome = $linha['nome'];
            $nro_itens= $linha['nro_itens'];
            $mostrar= $linha['mostrar'];
            $id_rss= $linha['id_rss'];
            
            
            /* importa o formulario */
            include_once 'modules/rss/form_rss.php';
        }
    }
}

##################################################
#####/* se a ação selecionada for VISUALIZAR  */##
##################################################
if ($_GET['action'] == 'visualizar') {
    /* breadcrumbs */
    echo breadcrumbs(array('RSS' => 'index.php?s=rss', 'Visualizar Feed RSS' => ''));

    /* titulo principal */
    echo '<h1>Visualizar</h1>';

    conecta();
    /* busca os dados do editado */
    $query = "SELECT * FROM rss WHERE id_rss = " . $_GET['id_rss'];
    $resultado = mysql_query($query);

    if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
        echo '<span class="erro">Erro de Conexão!</span>';
    } else {

        $linha = mysql_fetch_array($resultado);
            $url = $linha['url'];
            $nome = $linha['nome'];
            $nro_itens= $linha['nro_itens'];
            $mostrar= $linha['mostrar'];


        /* monta a tabela de vizualização */

        echo "
            <table class='visualizar'>
                <tr>
                    <td class='label'>
                        Nome:
                    </td>
                    <td>
                        " . $nome . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        URL:
                    </td>
                    <td>
                        " . $url . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Número de Itens Visualizados:
                    </td>
                    <td>
                        " . $nro_itens . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Mostrar:
                    </td>
                    <td>
                        " . ($mostrar?'Sim':'Não') . "
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
    echo breadcrumbs(array('RSS' => 'index.php?s=rss', 'Excluir Feed RSS' => ''));

    /* titulo principal */
    echo '<h1>Excluir</h1>';

    /* se foi pressionado o botão EXCLUIR */
    if ($_POST['excluir']) {

        conecta();

        /* verifica se o registro existe */
        $query = "SELECT * FROM rss WHERE id_rss = " . $_GET['id_rss'];
        $resultado = mysql_query($query);
        $linha = mysql_fetch_array($resultado);

        if (mysql_num_rows($resultado) == 0) {
            echo '<span class="erro">Registro não existe!</span>';
        } else {

            /* exclui registro */
            $query = "DELETE FROM rss WHERE id_rss = " . $_GET['id_rss'];
            $resultado = mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                echo "<p> Deletado com sucesso!</p><br><input type='button' value='Voltar' onclick='history.go(-2)'/>";
            }
        }
    } else {
        /* mostra o form excluir - pergunta se tem certeza */
        echo form_excluir();
    }
}
?>