<html>
   <?php
      
      //configurações padrão
      include "config/config_html_default.php";
      
      $proxy = 'tcp://192.168.254.254:3128';//caso use proxy configurar aqui
      
      //aqui poderia ser definido alguns teste de conexão mas não conseguia fazer um eficiente
      
      //universidade
      $url="http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=2&cod_tipo=1&dia=Segunda%20a%20sexta";
      $nome_linha_destino_ufsm="universidade_centro_ufsm";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="universidade_ufsm_centro";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
         
      //Universidade Domingo
      $url = "http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=2&cod_tipo=1&dia=Domingos";
      $nome_linha_destino_ufsm="universidade_centro_ufsm_domingo";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="universidade_ufsm_centro_domingo";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";

      //Universidade Sabado
      $url = "http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=2&cod_tipo=1&dia=Sabado";
      $nome_linha_destino_ufsm="universidade_centro_ufsm_sabado";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="universidade_ufsm_centro_sabado";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //circular ufsm
      $url="http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=4&cod_tipo=1&dia=Segunda%20a%20sexta";
      $nome_linha_destino_ufsm="circular_universidade_centro_ufsm";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="circular_universidade_ufsm_centro";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //tancredo neves
      $url="http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=5&cod_tipo=1&dia=Segunda%20a%20sexta";
      $nome_linha_destino_ufsm="tancredo_tancredo_ufsm";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="tancredo_ufsm_tancredo";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //tancredo neves sabado
      $url="http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=5&cod_tipo=1&dia=Sabado";
      $nome_linha_destino_ufsm="tancredo_tancredo_ufsm_sabado";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="tancredo_ufsm_tancredo_sabado";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //tancredo neves domingo
      $url="http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=5&cod_tipo=1&dia=Domingos";
      $nome_linha_destino_ufsm="tancredo_tancredo_ufsm_domingo";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="tancredo_ufsm_tancredo_domingo";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //bombeiros
      $url = "http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=3&cod_tipo=1&dia=Segunda%20a%20sexta";
      $nome_linha_destino_ufsm="bombeiros_centro_ufsm";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="bombeiros_ufsm_centro";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //Seletivo
      $url = "http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=1&cod_tipo=2&dia=Segunda%20a%20sexta";
      $nome_linha_destino_ufsm="seletivo_centro_ufsm";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="seletivo_ufsm_centro";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //Seletivo Sabado
      $url = "http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=1&cod_tipo=2&dia=Sabados";
      $nome_linha_destino_ufsm="seletivo_centro_ufsm_sabado";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="seletivo_ufsm_centro_sabado";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      //Seletivo Domingo
      $url = "http://sucuri.cpd.ufsm.br/portal2011/onibus/sistema2.php?cod_linha=1&cod_tipo=2&dia=Domingos";
      $nome_linha_destino_ufsm="seletivo_centro_ufsm_domingo";//nome do arquivo a ser salvo
      $nome_linha_origem_ufsm="seletivo_ufsm_centro_domingo";//nome do arquivo a ser salvo
      include "geraronibusgenerico.php";
      
      include "gerarhorariosauxiliares.php";
      
   ?>
</html>


