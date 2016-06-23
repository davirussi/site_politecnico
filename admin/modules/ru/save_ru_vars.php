<?php
   $pon = fopen("../extensions/ru/config/ru_config".".php","w");
   fwrite($pon,"<?php\n");
   fwrite($pon,'$url="'.html_entity_decode($_POST['url'])."\";\n");
   fwrite($pon,'$html_antes_do_cardapio_do_dia="'.str_replace('"','\\"',html_entity_decode($_POST['html_antes_do_cardapio_do_dia']))."\";\n");
   fwrite($pon,'$html_antes_do_prato="'.str_replace('"','\\"',html_entity_decode($_POST['html_antes_do_prato']))."\";\n");
   fwrite($pon,'$html_depois_do_prato="'.str_replace('"','\\"',html_entity_decode($_POST['html_depois_do_prato']))."\";\n");
   fwrite($pon,'$html_antes_data="'.str_replace('"','\\"',html_entity_decode($_POST['html_antes_data']))."\";\n");
   fwrite($pon,'$html_depois_data="'.str_replace('"','\\"',html_entity_decode($_POST['html_depois_data']))."\";\n");
   fwrite($pon,'$separador_explode_data="'.str_replace('"','\\"',html_entity_decode($_POST['separador_explode_data']))."\";\n");
   fwrite($pon,'$usa_proxy="'.str_replace('"','\\"',html_entity_decode($_POST['usa_proxy']))."\";\n");
   //fwrite($pon,str_replace(':','','$horario[] = (int)"'.$horario[$i]."\";\n"));
   fwrite($pon,"?>\n");
   fclose($pon);
?>