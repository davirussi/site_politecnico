<html>
   <head>
      <link rel="stylesheet" href="css/ru.css">
   </head>
   <?php
      //error_reporting(0);
      $dia_semana= array(1 => "Segunda-Feira",2 => "Terça-Feira", 3 => "Quarta-Feira", 4 => "Quinta-Feira", 5 => "Sexta-Feira", 6 => "Sábado", 7 => "Domingo");
      
      function cardapio_dia($data) 
      {
         unset($cardapio);
         include "extensions/ru/bd/bdconsultar.php";
      //   include "bd/bdconsultar.php";


         return $cardapio;
      }

      //testes

      //$cardapio_dia=cardapio_dia("10/31/11");

      /*
      echo "10/31/11 "."<br>";
      foreach(cardapio_dia("10/31/11") as $conteudo)
      echo $conteudo."<br>";
      */
   ?>
   <body>
      <table id="tabela">
      <tr>
         <th><?php echo date("d/m/Y",time())."<br>".$dia_semana[date("N",time())] ?></th>
      </tr>
      <?php
         $flag=0;                                //-86400*4
         foreach(cardapio_dia(date("m/d/y",time())) as $conteudo)
         {
            if($flag%2==0)
               echo "<tr>";
            else
               echo "<tr class=\"alt\">";
               
            echo "<td>".$conteudo."</td>";
            echo "</tr>";

            $flag++;
         }
      ?>
      </table>
   </body>




</html>


