<?php

   if (!isset($_SESSION))
      exit;
   valida_logado(1);
?>

<?php

   ##############################################################
   #####/* se a ação selecionada for LISTAR  (action default)*/##
   ##############################################################


   ##############################################
   #####/* se a ação selecionada for CONFIGURAR */##
   ##############################################


   if (!isset($_GET['action']) || $_GET['action'] == 'config') {

      /* breadcrumbs */
      echo breadcrumbs(array('Onibus' => ''));

      /* titulo principal */
      echo '<h1>Onibus</h1>';

      $action = 'index.php?s=onibus&action=config';
      
      if (isset($_POST['update']))
      {
         include "../extensions/onibus/gerador.php";
         echo "Horarios de Onibus atualizados com sucesso";
      }


      if (!$_POST['enviar']){
         include "../extensions/onibus/config/config_html_default.php";
      }
      else
      {
         include "modules/onibus/validacoes_onibus.php";
         if (!isset($erro))
         {
            include "modules/onibus/save_onibus_vars.php";
            echo "Atualizado com sucesso!";
         }
      }
      include "modules/onibus/form_config_onibus.php";
      include "modules/onibus/updater.php";
   }
?>