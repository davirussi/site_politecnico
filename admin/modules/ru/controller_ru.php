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
      echo breadcrumbs(array('RU' => ''));

      /* titulo principal */
      echo '<h1>RU</h1>';

      $display = 'none';
      /* se foi pressionado o botão buscar da pesquisa */
      if ($_POST['buscar']) {
         /* mostra o formulario de pesquisa */
         $display = '';

         $where = ' WHERE 1=1 ';

         /* recebe as variaveis de busca e monta o WHERE */
         if ($_POST['data']) {
            $data = $_POST['data']; /* inicializa a variavel para mostrar no form */
            $where .= ' AND data LIKE "%' . $data . '%"';
         }
      }

      /* botao pesquisa :: onclick (mostra ou esconde o formulario de pesquisa) */
      echo botao_pesquisa();

      /* formulario de busca */
      echo '<div class="form_pesquisa" style="display:' . $display . ';">
      <form action="index.php?s=ru&action=listar" method="post" enctype="multipart/form-data">
      <table class="form">
      <tr>
      <td class="label">DATA:</td>
      <td>
      <input type="text" name="data" value="' . $data . '" style="width:400px;"/>
      </td>
      <td>
      <input type="submit" name="buscar" value="Buscar"/>
      </td>
      </tr>
      </table>
      </form>
      </div>';
      
      conecta();
      
      if(isset($_POST['update']))
      {
         $query = "Delete from ru";   
         if (mysql_query($query));
         {
            echo "Limpo e ";
            include "../extensions/ru/gerarcardapio.php";
            echo "atualizado";
         }
         
      }


      $query = "SELECT * FROM ru " . $where;

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
            <a href="index.php?s=ru&action=editar&id=' . $linha['id'] . '"><img title="Editar" src="images/editar.png"/></a>
            <a href="index.php?s=ru&action=visualizar&id=' . $linha['id'] . '"><img title="Visualizar" src="images/visualizar.png"/></a>
            <a href="index.php?s=ru&action=excluir&id=' . $linha['id'] . '"><img title="Excluir" src="images/excluir.png"/></a>
            </td>
            <td>
            ' . $linha['id'] . '
            </td>
            <td>
            ' . $linha['data'] . '
            </td>
            <td>
            ' . ($linha['conteudo']) . '
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
         ID
         </th>
         <th>
         Data
         </th>
         <th>
         Conteudo
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
            ' . $linha['id'] . '
            </td>
            <td>
            ' . $linha['data'] . '
            </td>
            <td>
            ' . ($linha['conteudo']) . '
            </td>
            </tr>
            ';
            $cont++;
         }
         $tabela_exportar .= '</table>';

         /* define o nome do arquivo que será gerado */
         $nome_arquivo = "ru";

         /* form  para exportar os dados */
         include 'php/form_exportar.php';

         ######################
         #/* Fim Exportação */#
         ######################
      }
      include "modules/ru/updater.php";
   }


   ##############################################
   #####/* se a ação selecionada for CONFIGURAR */##
   ##############################################


   if (!isset($_GET['action']) || $_GET['action'] == 'config') {

      /* breadcrumbs */
      echo breadcrumbs(array('RU' => ''));

      /* titulo principal */
      echo '<h1>RU</h1>';

      $action = 'index.php?s=ru&action=config';


      if (!$_POST['enviar']){
         include "../extensions/ru/config/ru_config.php";
      }
      else
      {
         include "modules/ru/validacoes_ru.php";
         if (!isset($erro))
         {
            include "modules/ru/save_ru_vars.php";
            echo "Atualizado com sucesso!";
         }
      }
      include "modules/ru/form_config_ru.php";
   }

   ##############################################
   #####/* se a ação selecionada for INSERIR */##
   ##############################################
   //include "modules/ru/form_ru.php";
   if ($_GET['action'] == 'inserir') {
      /* breadcrumbs */
      echo breadcrumbs(array('RSS' => 'index.php?s=ru', 'Inserir Feed RSS' => ''));

      /* titulo principal */
      echo '<h1>Inserir</h1>';

      /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
      $action = 'index.php?s=ru&action=inserir';

      /* se foi pressionado o botão ENVIAR */
      include "modules/rss/form_ru.php";
      if ($_POST['enviar']) {
         /* importa as validações */
         include_once 'modules/ru/validacoes_form_ru.php';


         /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
         if (count($erro) == 0) {

            /* conecta com o banco de dados */
            conecta();

            /* consulta sql */
            $query = "INSERT  INTO rss (url, nro_itens, mostrar) VALUES ('$url', $nro_itens, $mostrar)";
            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
               echo '<span class="erro">Erro de Conexão!</span>';
            } else {

               /* se nao ocorreu erros redireciona para a action default LISTAR */
               header('location: index.php?s=ru');
            }
         } else { /* se ocorreu erro, mostra o form com os erros */
            /* importa o formulario */
            include_once 'modules/rss/form_ru.php';
         }
      } else { /* senao caso seja a primeira vez na pagina somente exibe o form */
         /* importa o formulario */
         include_once 'modules/rss/form_ru.php';
      }
   }

   ##############################################
   #####/* se a ação selecionada for EDITAR  */##
   ##############################################
   if ($_GET['action'] == 'editar') {
      /* breadcrumbs */
      echo breadcrumbs(array('RU' => 'index.php?s=ru', 'Editar prato RU' => ''));

      /* titulo principal */
      echo '<h1>Editar</h1>';

      /* inicia a variavel de define a action do FORM :: Define se vai ser EDITAR ou INSERIR */
      $action = 'index.php?s=ru&action=editar';

      /* se foi pressionado o botão ENVIAR */
      if (isset($_POST['enviar'])) {
         /* importa as validações */
         include_once 'modules/ru/validacoes_form_ru.php';
         
         

         /* se nao ocorreu erro executa a lógica, senao mostra o formulario novamente */
         if (!isset($erro)) {

            /* conecta com o banco de dados */
            conecta();
            

            /* consulta sql */
            $query = "UPDATE ru SET data = '" . $data . "', conteudo = '" . $conteudo . "' WHERE id = " . $_POST['id'];

            mysql_query($query);

            if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
               echo '<span class="erro">Erro de Conexão!</span>';
            } else {

               /* se nao ocorreu erros redireciona para a action VISUALIZAR */
               header('location: index.php?s=ru&action=visualizar&id=' . $_POST['id']);
            }
         } else {
            /* importa o formulario */
            include_once 'modules/ru/form_ru.php';
         }
      } else { /* senao caso seja a primeira vez na pagina somente exibe o form com os dados do editado */
         conecta();
         /* busca os dados do editado */
         $query = "SELECT * FROM ru WHERE id = " . $_GET['id'];
         $resultado = mysql_query($query);

         if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
            echo '<span class="erro">Erro de Conexão!</span>';
         } else {

            $linha = mysql_fetch_array($resultado);
            $data = $linha['data'];
            $conteudo= $linha['conteudo'];
            $id= $linha['id'];


            /* importa o formulario */
            include_once 'modules/ru/form_ru.php';
         }
      }
   }

   ##################################################
   #####/* se a ação selecionada for VISUALIZAR  */##
   ##################################################
   if ($_GET['action'] == 'visualizar') {
      /* breadcrumbs */
      echo breadcrumbs(array('RU' => 'index.php?s=rss', 'Visualizar Prato RU' => ''));

      /* titulo principal */
      echo '<h1>Visualizar</h1>';

      conecta();
      /* busca os dados do editado */
      $query = "SELECT * FROM ru WHERE id = " . $_GET['id'];
      $resultado = mysql_query($query);

      if (mysql_errno() != 0) { /* se nao foi executada corretamente a consulta retorna um erro */
         echo '<span class="erro">Erro de Conexão!</span>';
      } else {

         $linha = mysql_fetch_array($resultado);
         $data = $linha['data'];
         $conteudo = $linha['conteudo'];


         /* monta a tabela de vizualização */

         echo "
         <table class='visualizar'>
         <tr>
         <td class='label'>
         Data:
         </td>
         <td>
         " . $data . "
         </td>
         </tr>
         <tr>
         <td class='label'>
         Conteudo:
         </td>
         <td>
         " . $conteudo . "
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
      echo breadcrumbs(array('RU' => 'index.php?s=ru', 'Excluir Prato RU' => ''));

      /* titulo principal */
      echo '<h1>Excluir</h1>';

      /* se foi pressionado o botão EXCLUIR */
      if ($_POST['excluir']) {

         conecta();

         /* verifica se o registro existe */
         $query = "SELECT * FROM ru WHERE id = " . $_GET['id'];
         $resultado = mysql_query($query);
         $linha = mysql_fetch_array($resultado);

         if (mysql_num_rows($resultado) == 0) {
            echo '<span class="erro">Registro não existe!</span>';
         } else {

            /* exclui registro */
            $query = "DELETE FROM ru WHERE id = " . $_GET['id'];
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