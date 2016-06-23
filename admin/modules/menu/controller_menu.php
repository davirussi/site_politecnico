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
    echo breadcrumbs(array('Menus' => ''));

    /* titulo principal */
    echo '<h1>Menus</h1>';

    /* botao inserir novo */
    echo '<span class="right"><h3><a href="index.php?s=menu&action=inserir" title="Novo">+ Novo menu de nível 1</a></h3></span><br/>';

    conecta();

    $resultado = mysql_query("SELECT titulo, id_menu FROM menu WHERE id_menu_pai = '' OR id_menu_pai IS NULL ORDER BY ordem");

    if (mysql_num_rows($resultado) == 0) {
        echo '<span class="erro">Nenhum resultado encontrado!</span>';
    }
    echo '<ul id="lista_menus">';
    while ($linha = mysql_fetch_array($resultado)) {
        echo '<li><span class="fonte1">' . $linha['titulo'] . '</span>   <a href="index.php?s=menu&action=editar&id_menu=' . $linha['id_menu'] . '"><img title="Editar" src="images/editar.png"/></a>
                                    <a href="index.php?s=menu&action=visualizar&id_menu=' . $linha['id_menu'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
                                    <a href="index.php?s=menu&action=excluir&id_menu=' . $linha['id_menu'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                                        <a href="index.php?s=menu&action=inserir&id_menu_pai=' . $linha['id_menu'] . '"><img title="Novo Menu" src="images/add.png"/></a>' . '</li>';

        lista_menu1($linha['id_menu']);

    }
    echo '</ul>';
}

##############################################
#####/* se a ação selecionada for INSERIR */##
##############################################
if ($_GET['action'] == 'inserir') {
    /* breadcrumbs */
    echo breadcrumbs(array('Menus' => 'index.php?s=menu', 'Inserir Menu' => ''));

    /* titulo principal */
    echo '<h1>Inserir</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=menu&action=inserir';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/menu/validacoes_menu.php';


        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            if ($id_conteudo == '') {
                /* insere um novo conteudo */
                /* consulta sql */
                $query = "INSERT  INTO conteudo (titulo, conteudo, url, id_usuario, tipo) VALUES ('$titulo_conteudo', '$conteudo', '$url', " . $_SESSION['id_usuario'] . ", '$tipo')";
                mysql_query($query);

                $id_conteudo = mysql_insert_id();
            }



            /* consulta sql */
            $query = "INSERT  INTO menu (titulo, ordem, id_menu_pai, id_conteudo) VALUES ('$titulo', $ordem, '$id_menu_pai', '$id_conteudo')";
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {

                /* se nao ocorreu erros redireciona para a action default LISTAR */
                header('location: index.php?s=menu');
            }
        } else { /* se ocorreu erro, mostra o form com os erros */
            /* importa o formulario */
            include_once 'modules/menu/form_menu.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form */
        /* importa o formulario */
        include_once 'modules/menu/form_menu.php';
    }
}

##############################################
#####/* se a ação selecionada for EDITAR  */##
##############################################
if ($_GET['action'] == 'editar') {
    /* breadcrumbs */
    echo breadcrumbs(array('Menus' => 'index.php?s=menu', 'Editar Menu' => ''));

    /* titulo principal */
    echo '<h1>Editar</h1>';

    /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
    $action = 'index.php?s=menu&action=editar';

    /* se foi pressionado o botão ENVIAR */
    if ($_POST['enviar']) {
        /* importa as validações */
        include_once 'modules/menu/validacoes_menu.php';

        /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
        if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "UPDATE menu SET titulo = '" . $titulo . "', ordem = " . $ordem . ", id_conteudo = " . $id_conteudo . " WHERE id_menu = " . $id_menu;
            mysql_query($query);
            
            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
                echo '<span class="erro">Erro de Conexão!</span>';
            } else {

                /* se nao ocorreu erros redireciona para a action VISUALIZAR */
                header('location: index.php?s=menu&action=listar');
            }
        } else {
            /* importa o formulario */
            include_once 'modules/menu/form_menu.php';
        }
    } else { /* senao caso seja a primeira vez na pagina somente exibe o form com os dados do editado */
        conecta();
        /* busca os dados do editado */
        $query = "SELECT * FROM menu WHERE id_menu = " . $_GET['id_menu'];
        $resultado = mysql_query($query);

        if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
            echo '<span class="erro">Erro de Conexão!</span>';
        } else {

            $linha = mysql_fetch_array($resultado);
            $id_menu = $linha['id_menu'];
            $titulo = $linha['titulo'];
            $ordem = $linha['ordem'];
            $id_menu_pai = $linha['id_menu_pai'];
            $id_conteudo = $linha['id_conteudo'];


            /* importa o formulario */
            include_once 'modules/menu/form_menu.php';
        }
    }
}

##################################################
#####/* se a ação selecionada for VISUALIZAR  */##
##################################################
if ($_GET['action'] == 'visualizar') {
    /* breadcrumbs */
    echo breadcrumbs(array('Menus' => 'index.php?s=menu', 'Visualizar Menu' => ''));

    /* titulo principal */
    echo '<h1>Visualizar</h1>';

    conecta();
    /* busca os dados do editado */
    $query = "SELECT    m.titulo,
                        m.ordem,
                        c.conteudo,
                        c.tipo
                    FROM menu m 
                    INNER JOIN conteudo c ON c.id_conteudo = m.id_conteudo
                    WHERE m.id_menu = " . $_GET['id_menu'];
    $resultado = mysql_query($query);

    if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
        echo '<span class="erro">Erro de Conexão!</span>';
    } else {

        $linha = mysql_fetch_array($resultado);
        $id_menu = $linha['id_menu'];
        $titulo = $linha['titulo'];
        $ordem = $linha['ordem'];
        $conteudo = $linha['conteudo'];
        $tipo = $linha['tipo'];


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
                        Ordem:
                    </td>
                    <td>
                        " . $ordem . "
                    </td>
                </tr>
                 <tr>
                    <td class='label'>
                        Conteúdo ou Descrição:
                    </td>
                    <td>
                        " . $conteudo . "
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        Tipo:
                    </td>
                    <td>
                        " . $tipo . "
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
    echo breadcrumbs(array('Menus' => 'index.php?s=menu', 'Excluir Menu' => ''));

    /* titulo principal */
    echo '<h1>Excluir</h1>';

    /* se foi pressionado o botão EXCLUIR */
    if ($_POST['excluir']) {

        conecta();

        /* verifica se o registro existe */
        $query = "SELECT * FROM menu WHERE id_menu_pai = " . $_GET['id_menu'];
        $resultado = mysql_query($query);
        $linha = mysql_fetch_array($resultado);

        if (mysql_num_rows($resultado) > 0) {
            echo '<span class="erro">Este menu possui menus filhos cadastrados e não pode ser excluído!</span>';
        } else {

            /* exclui registro */
            $query = "DELETE FROM menu WHERE id_menu = " . $_GET['id_menu'];
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