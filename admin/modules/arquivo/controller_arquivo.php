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
    echo breadcrumbs(array('Arquivos' => ''));

    /* titulo principal */
    echo '<h1>Arquivos</h1>';

    /* botao inserir novo */
    echo '<span class="right"><h3><a href="index.php?s=arquivo&action=inserir" title="Novo">+ Novo</a></h3></span>';

    $display = 'none';
    /* se foi pressionado o botão buscar da pesquisa */
    if ($_POST['buscar']) {
        /* mostra o formulario de pesquisa */
        $display = '';

        $where = ' WHERE 1=1 ';

        /* recebe as variaveis de busca e monta o WHERE */
        if ($_POST['nome']) {
            $nome = $_POST['nome']; /* inicializa a variavel para mostrar no form */
            $where .= ' AND nome LIKE "%' . $nome . '%"';
        }
    }

    /* botao pesquisa :: onclick (mostra ou esconde o formulario de pesquisa) */
    echo botao_pesquisa();

    /* formulario de busca */
    echo '<div class="form_pesquisa" style="display:' . $display . ';">
            <form action="index.php?s=arquivo&action=listar" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td class="label">Nome:</td>
                        <td>
                            <input type="text" name="nome" value="' . $nome . '" style="width:400px;"/>
                        </td>
                        <td>
                            <input type="submit" name="buscar" value="Buscar"/>
                        </td>
                    </tr>
                </table>
            </form>
          </div>';

    conecta();

    $query = "SELECT    *
                        FROM arquivo 
                        " . $where . " ORDER BY nome DESC";

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
                    <a href="index.php?s=arquivo&action=excluir&id_arquivo=' . $linha['id_arquivo'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                </td>
                <td>
                    ' . $linha['nome'] . '
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
                                Nome
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
                    ' . $linha['nome'] . '
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
        $nome_arquivo = "arquivos";

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
    echo breadcrumbs(array('Arquivos' => 'index.php?s=arquivo', 'Inserir Arquivo' => ''));

    /* titulo principal */
    echo '<h1>Inserir</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=arquivo&action=inserir';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/arquivo/validacoes_arquivo.php';


        if (count($erro) == 0) {
            if (!is_uploaded_file($file_tmp_name)) {
                $erro[$name] = 'Erro ao processar arquivo!';
            } else {
                if (!move_uploaded_file($file_tmp_name, $g_caminho_arquivos . "/" . $file_name)) {
                    $erro[$name] = 'Não foi possível salvar o arquivo!';
                }
            }

            if (count($erro) == 0) {

                /* conecta com o banco de dados */
                conecta();

                /* consulta sql */
                $query = "INSERT  INTO arquivo (nome) VALUES ('$file_name')";
                mysql_query($query);

                if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                    echo '<span class="erro">Erro de Conexão!</span>';
                } else {
                    /* se nao ocorreu erros redireciona para a action default LISTAR */
                    header('location: index.php?s=arquivo');
                }
            } else { /* se ocorreu erro, mostra o form com os erros */
                /* importa o formulario */
                include_once 'modules/arquivo/form_arquivo.php';
            }
        } else { /* se ocorreu erro, mostra o form com os erros */
            /* importa o formulario */
            include_once 'modules/arquivo/form_arquivo.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form */
        /* importa o formulario */
        include_once 'modules/arquivo/form_arquivo.php';
    }
}


##################################################
#####/* se a ação selecionada for EXCLUIR     */##
##################################################
if ($_GET['action'] == 'excluir') {
    /* breadcrumbs */
    echo breadcrumbs(array('Arquivos' => 'index.php?s=arquivo', 'Excluir Arquivo' => ''));

    /* titulo principal */
    echo '<h1>Excluir</h1>';

    /* se foi pressionado o botão EXCLUIR */
    if ($_POST['excluir']) {

        conecta();

        /* verifica se o registro existe */
        $query = "SELECT * FROM arquivo WHERE id_arquivo = " . $_GET['id_arquivo'];
        $resultado = mysql_query($query);
        $linha = mysql_fetch_array($resultado);

        if (mysql_num_rows($resultado) == 0) {
            echo '<span class="erro">Registro não existe!</span>';
        } else {

            if (unlink($g_caminho_arquivos . $linha['nome'])) {
                /* exclui registro */
                $query = "DELETE FROM arquivo WHERE id_arquivo = " . $_GET['id_arquivo'];
                $resultado = mysql_query($query);

                if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                    echo '<span class="erro">Erro de Conexão!</span>';
                } else {
                    echo "<p> Deletado com sucesso!</p><br><input type='button' value='Voltar' onclick='history.go(-2)'/>";
                }
            } else {
                echo 'Erro ao excluir arquivo de foto!';
            }
        }
    } else {
        /* mostra o form excluir - pergunta se tem certeza */
        echo form_excluir();
    }
}
?>