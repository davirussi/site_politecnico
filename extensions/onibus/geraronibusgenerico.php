<html>
   <?php
      if ($usa_proxy)
         include "config/proxy.php";
      else
         include "config/direto.php";
         
      

      unset($horario);
      $indice=0;
      $flag=0;//usado para salvar
      $test=0;

      while(true)
      {
         //procura pelo horario de onibus se nao encontrar mais nenhum aborta(break)
         $pos_inicial=strpos($conteudo_site,$html_antes_horario);
         if ($pos_inicial!="")
            $pos_inicial+=strlen($html_antes_horario);//numero referente ao deslocamento referente ao html_antes
         else
            break;
         $pos_final=strpos(substr($conteudo_site, $pos_inicial, 20), $html_depois_horario);//erro de 20 caracteres
         $conteudo = substr($conteudo_site, $pos_inicial, $pos_final);
         $conteudo_site = substr($conteudo_site, $pos_final+$pos_inicial);//muda o inicio +P
         $horario[$indice]= $conteudo;

         //procura pela linha de onibus faixa velha ou nova ou tamnbo
         $pos_inicial=strpos($conteudo_site,$html_antes_da_linha)+24;
         $pos_final=strpos(substr($conteudo_site, $pos_inicial, 20),$html_depois_da_linha);
         $conteudo = substr($conteudo_site, $pos_inicial, $pos_final);

         $conteudo_site = substr($conteudo_site, $pos_final+$pos_inicial);//muda o inicio
         $linha[$indice] = $conteudo;

         //escreve primeiro grupo
         if (strpos(substr($conteudo_site,0,300),"<table bgcolor=white cellpadding=2 cellspacing=1 border=0>"))
            $flag=1;
         
         
      
         
         if (($flag==1))//write on file
         {
            $flag=2;
            $pon = fopen("../extensions/onibus/horarios/".$nome_linha_destino_ufsm.".php","w");
            fwrite($pon,"<?php\n");
            for ($i=0;$i<count($horario);$i++)
               fwrite($pon,str_replace(':','','$horario[] = (int)"'.$horario[$i]."\";\n"));
            fwrite($pon,"?>\n");
            fclose($pon);
            unset($horario);
            $indice=0;
         }

         

         $indice++;

      }
      //escreve segundo grupo
         if (($flag==2))//write on file
         {
            $flag=2;
            $pon = fopen("../extensions/onibus/horarios/".$nome_linha_origem_ufsm.".php","w");
            fwrite($pon,"<?php\n");
            for ($i=1;$i<count($horario)+1;$i++)
               fwrite($pon,str_replace(':','','$horario[] = (int)"'.$horario[$i]."\";\n"));
            fwrite($pon,"?>\n");
            fclose($pon);
         }
         
         unset($horario);
   ?>
</html>


