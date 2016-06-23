<?php

if (!isset($_SESSION))
    exit;
?>

<?php

##############################################################
#####/* se a ação selecionada for LISTAR  (action default)*/##
##############################################################
if (!isset($_GET['action']) || $_GET['action'] == 'listar') {
    valida_logado(1);
    /* breadcrumbs */
    echo breadcrumbs(array('Usuários' => ''));

    /* titulo principal */
    echo '<h1>Usuários</h1>';

    /* botao inserir novo */
    echo '<span class="right"><h3><a href="index.php?s=usuario&action=inserir" title="Novo">+ Novo</a></h3></span>';

    $display = 'none';
    /* se foi pressionado o botão buscar da pesquisa */
    if ($_POST['buscar']) {
        /* mostra o formulario de pesquisa */
        $display = '';

        $where = ' WHERE 1=1 ';

        /* recebe as variaveis de busca e monta o WHERE */
        if ($_POST['login']) {
            $login = $_POST['login']; /* inicializa a variavel para mostrar no form */
            $where .= ' AND login LIKE "%' . $login . '%"';
        }

        if ($_POST['nivel']) {
            $nivel = $_POST['nivel']; /* inicializa a variavel para mostrar no form */
            $where .= ' AND nivel = ' . $nivel;
        }
    }

    /* botao pesquisa :: onclick (mostra ou esconde o formulario de pesquisa) */
    echo botao_pesquisa();

    /* formulario de busca */
    echo '<div class="form_pesquisa" style="display:' . $display . ';">
            <form action="index.php?s=usuario&action=listar" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td class="label">Login:</td>
                        <td>
                            <input type="text" name="login" value="' . $login . '" style="width:400px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Nível:</td>
                        <td>
                            <select name="nivel">';

                        $niveis = array_merge(array('Todos' => 0), $gniveis);
                        foreach ($niveis as $label => $valor) {
                            ($valor == $nivel) ? ($selected = 'selected') : ($selected = '');
                            echo '<option ' . $selected . ' value="' . $valor . '">' . $label . '</option>';
                        }

                        echo '</select>
                        </td>
                        <td>
                            <input type="submit" name="buscar" value="Buscar"/>
                        </td>
                    </tr>
                </table>
            </form>
          </div>';

    conecta();

    $query = "SELECT * FROM usuario " . $where . " ORDER BY login";

    $resultado = mysql_query($query);

    /* mostra o pager da paginação - display com o numero de paginas - parametro: path imagens */
    echo display_pager();

    /* se nao retornou nenhum resultado */
    if (mysql_num_rows($resultado) == 0) {
        echo '<span class="erro">Nenhum resultado ecncontrado!</span><br>';
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
                    Login
                </th>
                <th>
                    Nível
                </th>
            </tr>
            </thead>
            <tbody>
';


        /* executa enquanto existir registro na tabela */
        while ($linha = mysql_fetch_array($resultado)) {

            /* verifica qual é o nível */
            foreach ($gniveis as $label => $valor) {
                if ($valor == $linha['nivel'])
                    $nivel_label = $label;
            }

            echo '
            <tr>
                <td align="center">
                    <a href="index.php?s=usuario&action=editar&id_usuario=' . $linha['id_usuario'] . '"><img title="Editar" src="images/editar.png"/></a>
                    <a href="index.php?s=usuario&action=visualizar&id_usuario=' . $linha['id_usuario'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
                    <a href="index.php?s=usuario&action=editar_senha&id_usuario=' . $linha['id_usuario'] . '"><img title="Alterar Senha" src="images/senha.png"/></a>
                    <a href="index.php?s=usuario&action=excluir&id_usuario=' . $linha['id_usuario'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                </td>
                <td>
                    ' . $linha['login'] . '
                </td>
                <td>
                    ' . $nivel_label . '
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
                            <th>Login</th>
                            <th>Nível</th>
                            </tr>';

        /* realiza a consulta novamente */
        $resultado = mysql_query($query);

        $cont = 0;

        /* monta a tabela para exportar */
        while ($linha = mysql_fetch_array($resultado)) {
            /* verifica qual é o nível */
            foreach ($gniveis as $label => $valor) {
                if ($valor == $linha['nivel'])
                    $nivel_label = $label;
            }
            (($cont % 2) == 0) ? ($even_odd = 'even') : ($even_odd = 'odd');
            $tabela_exportar .= '
            <tr class="' . $even_odd . '">
                <td>
                    ' . $linha['login'] . '
                </td>
                <td>
                    ' . $nivel_label . '
                </td>
            </tr>
             ';
            $cont++;
        }
        $tabela_exportar .= '</table>';

        /* define o nome do arquivo que será gerado */
        $nome_arquivo = "usuarios";

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
    valida_logado(1);
    /* breadcrumbs */
    echo breadcrumbs(array('Usuários' => 'index.php?s=usuario', 'Inserir Usuário' => ''));

    /* titulo principal */
    echo '<h1>Inserir</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    //$action = 'index.php?s=usuario&action=inserir';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/usuario/validacoes_usuario.php';


        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "INSERT  INTO usuario (login, senha, nivel) VALUES ('" . $login . "', '" . md5($senha) . "', " . $nivel . ")";
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                ############LOG##########################
                /* insere um registro no log */
                log_sistema('Inserir', 'Inseriu usuário de login = ' . $login);
                ############FIM-LOG######################

                /* se nao ocorreu erros redireciona para a action default LISTAR */
                header('location: index.php?s=usuario');
            }
        } else { /* se ocorreu erro, mostra o form com os erros */
            /* importa o formulario */
            include_once 'modules/usuario/form_usuario.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form */
        /* importa o formulario */
        include_once 'modules/usuario/form_usuario.php';
    }
}

##############################################
#####/* se a ação selecionada for EDITAR  */##
##############################################
if ($_GET['action'] == 'editar') {
    valida_logado(1);
    /* breadcrumbs */
    echo breadcrumbs(array('Usuários' => 'index.php?s=usuario', 'Editar Usuário' => ''));

    /* titulo principal */
    echo '<h1>Editar</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    //$action = 'index.php?s=usuario&action=editar';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/usuario/validacoes_usuario_editar.php';

        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "UPDATE usuario SET nivel = " . $nivel . " WHERE id_usuario = " . $id_usuario;
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                ############LOG##########################
                /* busca os dados para salvar no log */
                $query = "SELECT login FROM usuario WHERE id_usuario = " . $id_usuario;
                $resultado = mysql_query($query);
                $linha = mysql_fetch_array($resultado);

                /* insere um registro no log */
                log_sistema('Editar', 'Editou usuário de login = ' . $linha['login']);
                ############FIM-LOG######################

                /* se nao ocorreu erros redireciona para a action VISUALIZAR */
                header('location: index.php?s=usuario&action=visualizar&id_usuario=' . $id_usuario);
            }
        } else {
            /* importa o formulario */
            include_once 'modules/usuario/form_usuario_editar.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form com os dados do editado */
        conecta();
        /* busca os dados do editado */
        $query = "SELECT * FROM usuario WHERE id_usuario = " . $_GET['id_usuario'];
        $resultado = mysql_query($query);

        if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
            echo '<span class="erro">Erro de Conexão!</span>';
        } else {

            $linha = mysql_fetch_array($resultado);

            $id_usuario = $linha['id_usuario'];
            $login = $linha['login'];
            $nivel = $linha['nivel'];


            /* importa o formulario */
            include_once 'form_usuario_editar.php';
        }
    }
}

######################################################
#####/* se a ação selecionada for EDITAR A SENHA  */##
######################################################
if ($_GET['action'] == 'editar_senha') {
    valida_logado(2);

    /* breadcrumbs */
    echo breadcrumbs(array('Usuários' => 'index.php?s=usuario', 'Alterar Senha' => ''));

    /* titulo principal */
    echo '<h1>Alterar Senha</h1>';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/usuario/validacoes_usuario_editar_senha.php';
        /* se nao for administrador verifica se está tentando editar realmente o seu usuário */
        if (($_SESSION['nivel'] != 1) && ($_SESSION['id_usuario'] != $id_usuario)) {
            echo '<span class="erro">Você não pode editar este usuário!</span>';
        } else {
            /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
            if (count($erro) == 0) {

                /* conecta com o banco de dados */
                conecta();

                /* consulta sql */
                $query = "UPDATE usuario SET senha = '" . md5($senha) . "' WHERE id_usuario = " . $id_usuario;
                mysql_query($query);

                if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                    echo '<span class="erro">Erro de Conexão!</span>';
                } else {
                    ############LOG##########################
                    /* busca os dados para salvar no log */
                    $query = "SELECT login FROM usuario WHERE id_usuario = " . $id_usuario;
                    $resultado = mysql_query($query);
                    $linha = mysql_fetch_array($resultado);

                    /* insere um registro no log */
                    log_sistema('Editar Senha', 'Editou a senha do usuário de login = ' . $linha['login']);
                    ############FIM-LOG######################

                    /* se nao ocorreu erros redireciona para a action VISUALIZAR */
                    header('location: index.php?s=usuario&action=visualizar&id_usuario=' . $id_usuario);
                }
            } else {
                /* importa o formulario */
                include_once 'modules/usuario/form_usuario_editar_senha.php';
            }
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form com os dados do editado */
        conecta();
        /* busca os dados do editado */
        $query = "SELECT * FROM usuario WHERE id_usuario = " . $_GET['id_usuario'];
        $resultado = mysql_query($query);

        if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
            echo '<span class="erro">Erro de Conexão!</span>';
        } else {

            $linha = mysql_fetch_array($resultado);

            $id_usuario = $linha['id_usuario'];
            $login = $linha['login'];



            /* importa o formulario */
            include_once 'modules/usuario/form_usuario_editar_senha.php';
        }
    }
}

##################################################
#####/* se a ação selecionada for VISUALIZAR  */##
##################################################
if ($_GET['action'] == 'visualizar') {
    valida_logado(1);
    /* breadcrumbs */
    echo breadcrumbs(array('Usuários' => 'index.php?s=usuario', 'Visualizar Usuário' => ''));

    /* titulo principal */
    echo '<h1>Visualizar</h1>';

    conecta();
    /* busca os dados do editado */
    $query = "SELECT * FROM usuario WHERE id_usuario = " . $_GET['id_usuario'];
    $resultado = mysql_query($query);

    if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
        echo '<span class="erro">Erro de Conexão!</span>';
    } else {

        $linha = mysql_fetch_array($resultado);

        /* inicializa as variáveis */
        $id_usuario = $linha['id_usuario'];
        $login = $linha['login'];
        $nivel = $linha['nivel'];

        /* busca o nivel de acordo com o valor do campo salvo */
        foreach ($gniveis as $label => $valor) {
            if ($valor == $nivel)
                $nivel_label = $label;
        }

        /* monta a tabela de vizualização */

        echo "
            <table class='visualizar'>
                <tr>
                    <td class='label'>
                        Login:
                    </td>
                    <td>
                        " . $login . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Nível:
                    </td>
                    <td>
                        " . $nivel_label . "
                    </td>
                </tr>
            </table>";
    }
}

##################################################
#####/* se a ação selecionada for EXCLUIR     */##
##################################################
if ($_GET['action'] == 'excluir') {
    valida_logado(1);
    /* breadcrumbs */
    echo breadcrumbs(array('Usuários' => 'index.php?s=usuario', 'Excluir Usuário' => ''));

    /* titulo principal */
    echo '<h1>Excluir</h1>';

    /* se foi pressionado o botão EXCLUIR */
    if ($_POST['excluir']) {

        conecta();

        /* verifica se o registro existe */
        $query = "SELECT * FROM usuario WHERE id_usuario = " . $_GET['id_usuario'];
        $resultado = mysql_query($query);
        $linha = mysql_fetch_array($resultado);

        if (mysql_num_rows($resultado) == 0) {
            echo '<span class="erro">Registro não existe!</span>';
        } else {

            /* exclui registro */
            $query = "DELETE FROM usuario WHERE id_usuario = " . $_GET['id_usuario'];
            $resultado = mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {
                ############LOG##########################
                /* insere um registro no log */
                log_sistema('Excluir', 'Excluiu usuário de login = ' . $linha['login']);
                ############FIM-LOG######################

                echo "<p> Deletado com sucesso!</p><br><input type='button' value='Voltar' onclick='history.go(-2)'/>";
            }
        }
    } else {
        /* mostra o form excluir - pergunta se tem certeza */
        echo form_excluir();
    }
}
?>