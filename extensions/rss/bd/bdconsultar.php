<?php
   include "bdconfig.php";
   $query= "SELECT `nome` FROM `xml_base`";

   if ($return=mysql_query($query, $link)) //testa pra ver se a query retorna algo estava funcionando de um jeito estranho
   {
      $i=0;
      while($retorno_da_consulta=mysql_fetch_array($return))
         if($retorno_da_consulta['nome']!="")
            $vetxml[$i++]=$retorno_da_consulta['nome']; 
   }
   else
      echo "OCORREU ALGUM PROBLEMA COM O CONEXAO COM O BANCO DE DADOS";

?>
