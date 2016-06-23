<?php
//   define("Servidor","127.0.0.1");
//   define("Login","root");
//   define("Senha","");
//   define("Banco","davi");

   //conectar na base de dados
//   $link = mysql_connect($host,Login,Senha);
//   if (!$link) {
//      die('N�o foi poss�vel conectar: ' . mysql_error());
//   }
//   //echo 'Conex�o bem sucedida<BR>';
//
//   //escolha do banco
//   $db_selected = mysql_select_db(Banco, $link);
//   if (!$db_selected) {
//      die ('Can\'t use ' .Banco. ' : ' . mysql_error());
//   }
$link = conecta();
?>
