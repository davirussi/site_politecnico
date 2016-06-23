<?php
   //insersao no banco do $conteudo
   $query= "INSERT INTO `ru` (`data`, `conteudo`)
   VALUES('".$datas[$indice2]."', '".$conteudo."')";
   if (!mysql_query($query, $link)) //testa pra ver se a query retorna algo estava funcionando de um jeito estranho
      //echo "CADASTRO EFETUADO COM SUCESSO";
   //else
      echo "OCORREU ALGUM PROBLEMA COM O CONEXAO COM O BANCO DE DADOS";
?>
