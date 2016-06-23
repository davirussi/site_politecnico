<html>
   <?php
   error_reporting(0);
    
      /*
      linhas         saída
      - universidade - centro ou ufsm
      - bombeiros - centro ou ufsm                  
      - tancredo - tancredo ou ufsm
      - circular - centro ou ufsm
      - seletivo - centro ou ufsm
      */
      function horario($linha,$origem) 
      {
         //date(N,time()) -> 1 segunda 2 terça 3 quarta 4 quinta 5 sexta 6 sabado 7 domingo
         $diasemana=date('N',time());
         //$diasemana=7;
         //$horamin=(int)date(Hi,time()) -> retorna horario no formato 1200, 0000, 0100.
         $hora_agora=(int)date('Hi',time());
         //$hora_agora=2015;
         //inclusao do vetor de horarios auxiliares para desição de qual é o vetor certo a ser carregado na memória

         include "config/vetordenomes.php";
         include "horarios/auxiliar.php";
         //new option let's try this.
         //teste para ver se é segunda ou terça ou quarta ou quinta ou sexta antes do ultimo horario de onibus do dia ou se for domingo e passou um ultimo onibus
         if(($diasemana>=1 && $diasemana<=4) || ($diasemana==5 && $hora_agora < $horario[str_replace(".php","",$vetordenomes[$linha][$origem]['seg-sexta'])]) || ($diasemana==7 && $hora_agora > $horario[str_replace(".php","",$vetordenomes[$linha][$origem]['domingo'])]))
         {
            unset($horario);
            include "horarios/".$vetordenomes[$linha][$origem]['seg-sexta'];
         }
         //agora verificar se já passou do ultimo horario de sabado
         elseif (($diasemana==5 && $hora_agora > $horario[str_replace(".php","",$vetordenomes[$linha][$origem]['seg-sexta'])]) ||($diasemana==6 && $hora_agora < $horario[str_replace(".php","",$vetordenomes[$linha][$origem]['sabado'])]))
         {
            if ($linha=="bombeiros" || $linha=="circular")//tratar o sabado e domingo de linhas q não tem onibus nesse dia
            {
               unset($horario);
               return "1 dia";//aqui pode ser um dia de difenreça
            }
            else
            {
               unset($horario);
               include "horarios/".$vetordenomes[$linha][$origem]['sabado'];
            }
         }
         else
         {
            
            if (($linha=="bombeiros" || $linha=="circular"))// && ($hora_agora<$horario[str_replace(".php","",$vetordenomes[$linha][$origem]['domingo'])]))//domingo de linhas q não tem onibus nesse dia
            {
               unset($horario);
               include "horarios/".$vetordenomes[$linha][$origem]['domingo'];
               $auxx=$horario[0];
               if ($hora_agora <= $auxx)
               {
                  unset($horario);
                  return "1 dia";//aqui pode ser um dia de difenreça
               }
               else
               {
                   unset($horario);
                   $horario[0]=$auxx;
               }
            }
            else
            {
               unset($horario);
               include "horarios/".$vetordenomes[$linha][$origem]['domingo'];
            }
         }
         $hora_onibus=$horario[buscaBinaria($hora_agora,$horario)];
         if (is_null($horario[buscaBinaria($hora_agora,$horario)]))//teste pra ver se o ultimo onibus dia ja passou
            $hora_onibus=$horario[0];
         //echo "Proximo bus".$hora_onibus."<br>";

         //calcula o numero de minutos da hora atual até o proximo horario do onibus.
         $minproxbus=((int)($hora_onibus/100))*60+$hora_onibus%100;
         $minagora=((int)($hora_agora/100))*60+$hora_agora%100;
         if($minagora<=$minproxbus)
            $temp=$minproxbus-$minagora;
         else
            $temp=$minproxbus+(60*24-$minagora);
         ($temp<0) ? $temp=$temp*-1 : "" ;

         return formatarminutos($temp);
      }

      //função muito importante retorna o indice exatod a hora ou o rpoxímo indice
      function buscaBinaria($valorPesquisa, array $vetor) {

         $n_elementos = count($vetor);
         $inicio = 0; $fim = $n_elementos -1; $meio = (int) (($fim - $inicio) / 2) + $inicio;

         while ($inicio <= $fim) {
            if ($vetor[$meio] < $valorPesquisa) {
               $inicio = $meio + 1;
            } elseif ($vetor[$meio] > $valorPesquisa) {
               $fim = $meio - 1;
            } else {
               return $meio;
            }

            $meio = (int) (($fim - $inicio) / 2) + $inicio;

         }

         return $meio;
      }

      function formatarminutos($minutos)
      {
         $dia=0;
         $hora=0;
         $result="";

         while ($minutos>=1440)//ve se o onibus vai levar mais de dia
         {
            $dia++;
            $minutos = $minutos-1440;
         }
         if ($dia>0)//caso o onibus elve mais de dia não importa qtas horas e minutos
         {           
            ($dia>1) ? $result .= $dia . " dias" : $result .= $dia . " dia" ;
         }  
         else//caso menos de um dia 
         {
            while ($minutos>=60)//calcula numero de horas e minutos
            {
               $hora++;
               $minutos = $minutos-60;
            }
            if ($hora>0)//se for horas pro proximo onibus
               $result .= $hora . " h ";

            if ($minutos>0)
               $result .= $minutos . " min";
            else
            {
               if($hora==0)//não mostra os minutos se hora for diferente de zero e minutos = 0
                  $result .= $minutos . " min";
            }
         }
         return  $result;
      }
   ?>
</html>


