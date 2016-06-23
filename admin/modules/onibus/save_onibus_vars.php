<?php
   $pon = fopen("../extensions/onibus/config/config_html_default".".php","w");
   fwrite($pon,"<?php\n");
   fwrite($pon,'$html_entre_as_duas_tabelas="'.html_entity_decode($_POST['html_entre_as_duas_tabelas'])."\";\n");
   fwrite($pon,'$html_antes_horario="'.str_replace('"','\\"',html_entity_decode($_POST['html_antes_horario']))."\";\n");
   fwrite($pon,'$html_depois_horario="'.str_replace('"','\\"',html_entity_decode($_POST['html_depois_horario']))."\";\n");
   fwrite($pon,'$html_antes_da_linha="'.str_replace('"','\\"',html_entity_decode($_POST['html_antes_da_linha']))."\";\n");
   fwrite($pon,'$html_depois_da_linha="'.str_replace('"','\\"',html_entity_decode($_POST['html_depois_da_linha']))."\";\n");
   fwrite($pon,'$usa_proxy="'.str_replace('"','\\"',html_entity_decode($_POST['usa_proxy']))."\";\n");
   fwrite($pon,"?>\n");
   fclose($pon);
?>