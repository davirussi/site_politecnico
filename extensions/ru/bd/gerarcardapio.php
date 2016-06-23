<?php
   //esse arquivo é alterado no sistema administrativo
   echo "XD";
   include_once "config/ru_config.php"; 

   if ($usa_proxy)
      include "config/proxy.php";
   else
      include "config/direto.php";

   include_once("bd/bdconfig.php");

   $indice=0;

   $pos_inicial=strpos($conteudo_site,$html_antes_do_cardapio_do_dia);
   if ($pos_inicial!="")
      $pos_inicial+=strlen($html_antes_do_cardapio_do_dia);//para iniciar a leitura do primeiro cardapio
   else
      break;
   $conteudo_site = substr($conteudo_site, $pos_inicial);//muda o inicio +P

   //tratamento das datas
   while(true)
   {
      if (strpos(substr($conteudo_site, 0, 20), "</tr>"))   
         break;
      $pos_inicial=strpos($conteudo_site,$html_antes_data);
      if ($pos_inicial!="")
         $pos_inicial+=strlen($html_antes_data);//para iniciar a leitura do primeiro cardapio
      else
         break;
      $pos_final=strpos($conteudo_site,$html_depois_data);
      if ($pos_final>$pos_inicial)
         $conteudo = substr($conteudo_site, $pos_inicial, $pos_final-$pos_inicial);
      else
         $conteudo = substr($conteudo_site, $pos_inicial, $pos_inicial-$pos_final);
      $conteudo=str_replace("<br>"," ",$conteudo);
      
      //tratamento feriado
      $detectar_feriado=strpos($conteudo,"FERIADO");
      if ($detectar_feriado=="")//não e feriado
      {
         $data = explode($separador_explode_data, $conteudo);
         //echo date("d-m",strtotime($data[1]."/".substr($data[0],strlen($data[0])-2)."/".$data[2]))."<br>";
         //echo date("d-m",strtotime($data[1]."/".substr($data[0],strlen($data[0])-2)."/".$data[2])+ 86400)."<br>";
         $datas[$indice]= $data[1]."/".substr($data[0],strlen($data[0])-2)."/".$data[2];
         //echo $data[1]."/".$data[0]."/".$data[2]."<br>";
         //echo $indice." ".substr($data[0],strlen($data[0])-2).$data[1].$data[2]."<br>";
      }
      else
         $datas[$indice]= "FERIADO";
      //include "bd/bdcadastro.php";
      $indice++;

      $conteudo_site = substr($conteudo_site, $pos_final+strlen($html_depois_do_prato));//muda o inicio +P


   }
   
   
   $indice=0;
   $indice2=0;
   while(true)
   {

      $pos_inicial=strpos($conteudo_site,$html_antes_do_cardapio_do_dia);
      if ($pos_inicial!="")
         $pos_inicial+=strlen($html_antes_do_cardapio_do_dia);//para iniciar a leitura do primeiro cardapio
      else
         break;
      $conteudo_site = substr($conteudo_site, $pos_inicial);//muda o inicio +P
      
      //mudar a posição da posição para o inicio da string procurada
      while (true)
      {
         if($indice2==6)
            $indice2=0;
         $pos_inicial=strpos(substr($conteudo_site,0,50),$html_antes_do_prato);
         if ($pos_inicial!="")
            $pos_inicial+=strlen($html_antes_do_prato);//para iniciar a leitura do primeiro cardapio
         else
            break;
         $pos_final=strpos($conteudo_site,$html_depois_do_prato);//erro de 20 caracteres
         if ($pos_final>$pos_inicial)
            $conteudo = substr($conteudo_site, $pos_inicial, $pos_final-$pos_inicial);
         else
            $conteudo = substr($conteudo_site, $pos_inicial, $pos_inicial-$pos_final);

         //tratamento de um erro encontrado na tabela do ru ¬¬
         $wrong_conteudo=strpos($conteudo,"</table>");
         if ($wrong_conteudo!="")
         {
            $pos_final=strpos($conteudo,"</tr>");//erro de 20 caracteres
            $conteudo = substr($conteudo, 0, $pos_final);
            $conteudo=str_replace("<br>"," ",$conteudo);
            echo $datas[$indice2]." ". $conteudo."<br>\n";
            include "bd/bdcadastro.php";
            break;
         }

         $conteudo=str_replace("<br>"," ",$conteudo);
         echo $datas[$indice2]." ".$conteudo."<br>\n";
         include "bd/bdcadastro.php";
         $indice++;
         $indice2++;
         
         $conteudo_site = substr($conteudo_site, $pos_final+strlen($html_depois_do_prato));//muda o inicio +P
         if (strpos(substr($conteudo_site, 0, 20), "</tr>"))   
            break;
         

      }   
   }
?>


