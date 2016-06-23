<?php
//   define("Servidor","localhost");
//   define("Login","root");
//   define("Senha","");
//   define("Banco","informatica_poli");
//
//   //conectar na base de dados
//   $link = mysql_connect(Servidor,Login,Senha);
//   if (!$link) {
//      die('Não foi possível conectar: ' . mysql_error());
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
