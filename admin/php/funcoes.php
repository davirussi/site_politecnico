<?php

/* inclui o arquivo de funcoes da aplicação principal - SITE */
include_once '../funcoes.php';

#####################################################
##/* definicao de variaveis globais na aplicação */##
#####################################################
conecta();

/* REDEFINE caminho dos arquivos */
$g_caminho_arquivos = '../../../arquivos/';


/* array de níveis de acesso do sistema */
$gniveis = array('Administrador' => 1, 'Cadastrador' => 2);

/* array mostrar SIM NAO */
$gmostrar = array('Sim' => 1, 'Não' => 0);

/* array de classificacao das noticias */
$query = "SELECT titulo, id_menu FROM menu WHERE (id_menu_pai = '' OR id_menu_pai IS NULL) ORDER BY titulo";
$resultado = mysql_query($query);
while ($linha = mysql_fetch_array($resultado)) {
    $gclassificacao_noticias[$linha['titulo']] = $linha['id_menu'];
}

/* array de arquivos */
$query = "SELECT nome FROM arquivo ORDER BY nome";
$resultado = mysql_query($query);
while ($linha = mysql_fetch_array($resultado)) {
    $g_arquivos[$linha['nome']] = $linha['nome'];
}

/* array modulos cadastrados */
$query = "SELECT id_menu, titulo FROM menu ORDER BY titulo";
$resultado = mysql_query($query);
while ($linha = mysql_fetch_array($resultado)) {
    $gmenus[$linha['titulo']] = $linha['id_menu'];
}

/* array conteudos cadastrados */
$query = "SELECT id_conteudo, titulo FROM conteudo ORDER BY titulo";
$resultado = mysql_query($query);
while ($linha = mysql_fetch_array($resultado)) {
    $gconteudos[$linha['titulo']] = $linha['id_conteudo'];
}

/* array de tipos de conteudo */
$gtipos_conteudo = array('Conteúdo' => 'conteudo', 'Link' => 'link');

#####FIM - definição - GLOBAIS#####

/* lista filhos */

//function lista_filhos($id_menu) {
//    /* busca as competencias relacionadas com o id_modulo passado por parametro */
//    $resultado = mysql_query("SELECT * FROM menu WHERE id_menu_pai = " . $id_menu);
//    /* se nao retornou nenhum resultado */
//    if (mysql_num_rows($resultado) == 0) {
//        $retorno = '<span class="erro">Nenhum menu filho cadastrado!</span><br>';
//    } else {
//        $retorno = "<table class='visualizar'>";
//        while ($linha = mysql_fetch_array($resultado)) {
//            $retorno .= "<tr><td>" . $linha['titulo'] . ' | Ordem: ' . $linha['ordem'] . "</td><td width='25px'><a href='index.php?s=menu&action=excluir&id_menu=" . $linha['id_menu'] . "'><img src='images/excluir.png' title='Excluir'></a></td></tr>";
//        }
//        $retorno .= "</table>";
//    }
//
//    return $retorno;
//}

/* função que monta o breadcrumbs :: recebe como parametro um array com o label e o link do breadcrumb */

function breadcrumbs($array_breadcrumbs = array()) {
    $breadcrumbs = '<div id="breadcrumbs"><a href="index.php">Início</a>';
    foreach ($array_breadcrumbs as $label => $link) {
        $breadcrumbs .= ' -> <a href="' . $link . '"> ' . $label . '</a>';
    }
    $breadcrumbs .= '</div>';
    return $breadcrumbs;
}
//
/*
 * função que valida o usuário que esta logado, permissão
 */

function valida_logado($nivel=0) {

    //session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('location: index.php?s=login');
        exit;
    }
    switch ($nivel) {
        case 0:
            break;
        case 1:
            if ($_SESSION['nivel'] != 1) {
                header('location: index.php?s=inicial');
                exit;
            }
            break;
        case 2:
            if (!($_SESSION['nivel'] <= 2 )) {
                header('location: index.php?s=inicial');
                exit;
            }
            break;
    }
}

/* As funções de validação retornam 0 zero quando verdadeiras, ou (1 ou erros) quando falsas */

function valida_data($data) {
    if (preg_match("/^((0[1-9]|[12]\d)\/(0[1-9]|1[0-2])|30-(0[13-9]|1[0-2])|31-(0[13578]|1[02]))\/\d{4}$/", $data)) {
        $datas = explode('/', $data);
        if (checkdate($datas[1], $datas[0], $datas[2])) {
            return 0;
        }
    }
    return 1;
}

function valida_nome($nome) {
    if (preg_match("/^[[:alpha:]][[:alpha:] ÁÉÍÓÚáéíóú]+$/", $nome)) {
        return 0;
    }
    return 1;
}

function valida_sexo($sexo) {
    $sexos = array('m', 'f');
    $existe = 0;
    foreach ($sexos as $cadastrado) {
        if ($sexo == $cadastrado) {
            $existe = 1;
        }
    }
    if ($existe == 1)
        return 0;
    else
        return 1;
}

function valida_cpf(&$cpf) {
    $sinais = array("/", " ", ".", "-", ",");
    $cpf = str_replace($sinais, "", $cpf);

    $cpf_validar = substr($cpf, 0, 9);
    $soma = 0;
    $n = 11;
    for ($i = 0; $i <= 9; $i++) {
        $n = $n - 1;
        $soma = $soma + (substr($cpf_validar, $i, 1) * $n);
    };
    $resto = $soma % 11;
    if ($resto < 2) {
        $cpf_validar = $cpf_validar . "0";
    } else {
        $cpf_validar = $cpf_validar . (11 - $resto);
    };
    //Segunda parte da validação do CPF
    $soma = 0;
    $n = 12;
    for ($i = 0; $i <= 10; $i++) {
        $n = $n - 1;
        $soma = $soma + (substr($cpf_validar, $i, 1) * $n);
    };
    $resto = $soma % 11;
    if ($resto < 2) {
        $cpf_validar = $cpf_validar . "0";
    } else {
        $cpf_validar = $cpf_validar . (11 - $resto);
    }
    if ($cpf_validar == $cpf) {
        return 0;
    } else {
        return 1;
    };
}

function valida_combobox($par, $valores_validos) {
    $existe = 0;
    foreach ($valores_validos as $valor_valido => $valor) {
        if ($par == $valor) {
            $existe = 1;
        }
    }
    if ($existe == 1)
        return 0;
    else
        return 1;
}

function valida_login($login) {
    $login = strip_tags($login);
    if (strlen($login) < 6) {
        return 1;
    }
    return 0;
}

function valida_senha($senha) {
    if (strlen($senha) < 6) {
        return 1;
    }
    return 0;
}

function valida_comentarios($comentarios) {
    return 0;
}

function valida_checkbox($valores_checkbox) {
    $existe = 0;
    foreach ($valores_checkbox as $status) {
        if (strtoupper($status) == "ON") {
            $existe = 1;
        }
    }
    if ($existe == 1)
        return 0;
    else
        return 1;
}

/* função que remove tags e escapas caracteres */

function filtro($string) {
    //se magic_quotes não estiver ativado, escapa a string
    if (!get_magic_quotes_gpc()) {
        // função nativa do php para escapar variáveis.
        $string = mysql_escape_string($string);
    }
    // função que retira as tags html
    return strip_tags($string);
}

/* função que mostra o display do pager */

function display_pager($path = 'images/') {
    return '<div class="pager" align="center">
                <form>
                    <img src="' . $path . 'primeira.png" class="first" height="15px" width="15px"/>
                    <img src="' . $path . 'anterior.png" class="prev" height="15px" width="15px"/>
                    <input readonly type="text" class="pagedisplay"/>
                    <img src="' . $path . 'proxima.png" class="next" height="15px" width="15px"/>
                    <img src="' . $path . 'ultima.png" class="last" height="15px" width="15px"/>
                    <select class="pagesize">
                        <option selected="selected" value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                    </select>
                </form>
            </div>';
}

function form_excluir() {
    return "
        <p>Voce deseja excluir realmente?</p>
        <form action='' method='post' enctype='multipart/form-data'>
            <input type='submit' name='excluir' value='Excluir'/>
        </form>";
}

/* funcao que grava um registro na tabela log:: parametros  acao(inserir,editar,excluir) - descricao */

function log_sistema($acao, $descricao) {
    conecta();
    $query = 'INSERT INTO log (usuario, acao, descricao, data) VALUES ("' . $_SESSION['login'] . '", "' . $acao . '", "' . $descricao . '", "' . date('Y-m-d H:i:s') . '")';
    mysql_query($query);
}

/* funcao que mostra o botão de pesquisa */

function botao_pesquisa() {
    return '<span class="left"><h3><a href="#" onclick="onclickBotaoPesquisa();" title="Pesquisa"><img src="images/visualizar.png"/> Pesquisa</a></h3></span><br clear="both">';
}

/* função que valida o email */

function valida_email($mail) {
    if (preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $mail)) {
        return 0;
    } else {
        return 1;
    }
}

/* função que lista as competências, recebe como parametro o id_modulo */

function lista_competencias($id_modulo) {
    /* busca as competencias relacionadas com o id_modulo passado por parametro */
    $resultado = mysql_query("SELECT c.competencia, c.codigo, mc.id_modulo, mc.id_competencia FROM competencia c INNER JOIN modulo_has_competencia mc ON  c.id_competencia = mc.id_competencia WHERE mc.id_modulo = " . $id_modulo);
    /* se nao retornou nenhum resultado */
    if (mysql_num_rows($resultado) == 0) {
        $retorno = '<span class="erro">Nenhuma competência cadastrada!</span><br>';
    } else {
        $retorno = "<table class='visualizar'>";
        while ($linha = mysql_fetch_array($resultado)) {
            $retorno .= "<tr><td>" . $linha['competencia'] . ' - ' . $linha['codigo'] . "</td><td width='25px'><a href='index.php?s=modulo_has_competencia&action=excluir&id_modulo=" . $linha['id_modulo'] . "&id_competencia=" . $linha['id_competencia'] . "'><img src='images/excluir.png' title='Excluir'></a></td></tr>";
        }
        $retorno .= "</table>";
    }

    return $retorno;
}

/* função que lista os pre_requisitos, recebe como parametro o id_competencia */

function lista_pre_requisitos($id_competencia) {
    /* busca as competencias relacionadas com o id_modulo passado por parametro */
    $resultado = mysql_query("SELECT c.competencia, c.codigo, pr.id_pre_requisito FROM pre_requisito pr INNER JOIN competencia c ON  c.id_competencia = pr.id_competencia_pr WHERE pr.id_competencia = " . $id_competencia);
    /* se nao retornou nenhum resultado */
    if (mysql_num_rows($resultado) == 0) {
        $retorno = '<span class="erro">Nenhum pré-requisito cadastrado!</span><br>';
    } else {
        $retorno = "<table class='visualizar'>";
        while ($linha = mysql_fetch_array($resultado)) {
            $retorno .= "<tr><td>" . $linha['competencia'] . ' - ' . $linha['codigo'] . "</td><td width='25px'><a href='index.php?s=pre_requisito&action=excluir&id_pre_requisito=" . $linha['id_pre_requisito'] . "'><img src='images/excluir.png' title='Excluir'></a></td></tr>";
        }
        $retorno .= "</table>";
    }

    return $retorno;
}

/* função que valida os pre_requisitos, recebe como parametro o id_competencia e o id_competencia_pr */

function valida_pre_requisito($id_competencia, $id_competencia_pr) {
    /* busca as competencias relacionadas com o id_modulo passado por parametro */
    $resultado = mysql_query("SELECT * FROM pre_requisito WHERE id_competencia = " . $id_competencia . " AND id_competencia_pr = " . $id_competencia_pr);
    /* se nao retornou nenhum resultado */
    if (mysql_num_rows($resultado) == 0) {
        return 0;
    } else {
        return 1;
    }
}


/* parametros (arquivo $_FILES), (array de tipos validos para o arquivo enviado), (tamanho do arquivo em bytes)
 * retorna 0 em caso de sucesso ou a descricao do erro ocorrido */

function valida_arquivo_enviado($arquivo, $tipos_validos, $tamanho_arquivo) {
    /* se existe algum erro */
    if ($arquivo["error"] > 0) {
        return 'Erro no envio do arquivo';
    }
    /* valida o tamanho do arquivo */
    if ($arquivo["size"] > $tamanho_arquivo) {
        $kb = $tamanho / 1024;
        return "O tamanho máximo do arquivo é $kb Kb!";
    }
    /* valida os tipos de arquivos possíveis */
    $valida = 0;
    foreach ($tipos_validos as $tipo_valido => $ext) {
        if ($arquivo["type"] == $tipo_valido) {
            $valida = 1;
        }
    }
    if ($valida == 0) {
        return "Tipo de arquivo inválido!";
    }

    /* verifica se o arquivo foi enviado sem erros para o diretorio temp */
    if (!is_uploaded_file($arquivo["tmp_name"])) {
        return 'Erro ao processar arquivo!';
    }
}

/* função que valida o ano em 4 digitos numéricos */

function valida_ano($ano) {
    if ((strlen(trim($ano)) == 4) && is_numeric($ano)) {
        return 0;
    }
    return 1;
}

###################################################################
/* funcoes que listam os menus em forma de diretorio e niveis */
function lista_menu1($id_menu_pai) {
    $resultado = mysql_query("SELECT titulo, id_menu FROM menu WHERE id_menu_pai = " . $id_menu_pai . " ORDER BY ordem");
    if (mysql_num_rows($resultado) > 0) {
        echo '<ul>';
        while ($linha = mysql_fetch_array($resultado)) {
            echo '<li><span class="fonte1">' . $linha['titulo'] . '</span>   <a href="index.php?s=menu&action=editar&id_menu=' . $linha['id_menu'] . '"><img title="Editar" src="images/editar.png"/></a>
                                        <a href="index.php?s=menu&action=visualizar&id_menu=' . $linha['id_menu'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
                                        <a href="index.php?s=menu&action=excluir&id_menu=' . $linha['id_menu'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                                            <a href="index.php?s=menu&action=inserir&id_menu_pai=' . $linha['id_menu'] . '"><img title="Novo Menu" src="images/add.png"/></a>' . '</li>';

            $id_menu_pai = $linha['id_menu'];
            lista_menu2($id_menu_pai); 
        }
        echo '</ul>';
    } else {
        //$sem_filhos = 1;
    }
}

function lista_menu2($id_menu_pai) {
    $resultado = mysql_query("SELECT titulo, id_menu FROM menu WHERE id_menu_pai = " . $id_menu_pai . " ORDER BY ordem");
    if (mysql_num_rows($resultado) > 0) {
        echo '<ul>';
        while ($linha = mysql_fetch_array($resultado)) {
            echo '<li><span class="fonte1">' . $linha['titulo'] . '</span>   <a href="index.php?s=menu&action=editar&id_menu=' . $linha['id_menu'] . '"><img title="Editar" src="images/editar.png"/></a>
                                        <a href="index.php?s=menu&action=visualizar&id_menu=' . $linha['id_menu'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
                                        <a href="index.php?s=menu&action=excluir&id_menu=' . $linha['id_menu'] . '"><img title="Excluir" src="images/excluir.png"/></a>
                                            <a href="index.php?s=menu&action=inserir&id_menu_pai=' . $linha['id_menu'] . '"><img title="Novo Menu" src="images/add.png"/></a>' . '</li>';

            $id_menu_pai = $linha['id_menu'];
            lista_menu1($id_menu_pai); 
        }
        echo '</ul>';
    } else {
        //$sem_filhos = 1;
    }
}
########### fim #############
?>