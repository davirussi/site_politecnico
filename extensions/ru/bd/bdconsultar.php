<?
   include "bdconfig.php";


                      //-86400
   if (date("N",time())==7)
   {
      $cardapio[0]="Domingo não tem RU";
   }
   else
   {
      $query= "SELECT `id` FROM `ru`";
      $result = mysql_query($query, $link);
      $num_rows = mysql_num_rows($result);
      if ($num_rows>300)
      {
         $query= "DELETE from ru";
         mysql_query($query, $link);
         require "extensions/ru/gerarcardapio.php";
      }
      //$data2= date("m/d/y",time()-86400*5);
      $query= "SELECT `conteudo` FROM `ru` WHERE data='".$data."'";

      if ($return=mysql_query($query, $link)) //testa pra ver se a query retorna algo estava funcionando de um jeito estranho
      {
         $i=0;
         
         while($retorno_da_consulta=mysql_fetch_array($return))
         {
            if($retorno_da_consulta['conteudo']!="")
               $cardapio[$i++]=$retorno_da_consulta['conteudo']; 
         }
         if (!$retorno_da_consulta && !isset($cardapio))
         {
            echo "FUCK.";
            $cardapio[0]="Feriado ou nao cadastrado";
            //require("teste.php");
            require "extensions/ru/gerarcardapio.php";
            
         }
      }
      else
         echo "OCORREU ALGUM PROBLEMA COM O CONEXAO COM O BANCO DE DADOS";
   }
?>
