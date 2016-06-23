<html>
   <?php
      //carregando o nome das linhas de onibus
      if ($handle = opendir('../extensions/onibus/horarios/')) {
         while (false !== ($file = readdir($handle))) {
            if("$file"!="." && "$file"!="..")
               $linhasbus[]=str_replace(".php","","$file");
         }
         closedir($handle);
      }
      //gerar arquivos com horarios auxiliares - ultimo horario da linha
      $pon = fopen("../extensions/onibus/horarios/auxiliar.php","w");
      fwrite($pon,"<?php\n");
      foreach($linhasbus as $nomedalinha)
      {
         if ($nomedalinha != "auxiliar")
         {
            include "../extensions/onibus/horarios/".$nomedalinha.".php";
            fwrite($pon,'$horario[\''.$nomedalinha.'\'] = (int)"'.$horario[(count($horario)-1)]."\";\n");
         }         
      }
      fwrite($pon,"?>\n");
      fclose($pon);
   ?>
</html>


