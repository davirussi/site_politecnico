<html>
   <head>
      <link rel="stylesheet" href="css/bus.css">
   </head>

   <body>
      <?php
         include "horarioonibus.php";
      ?>

      <table id="tabela">
         <tr>
            <th colspan="3">Saindo da UFSM</th>
         </tr>
         <tr>
            <td><?php  echo "Universidade</td><td> - </td><td>".horario("universidade","ufsm"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Bombeiros</td><td> - </td><td>".horario("bombeiros","ufsm"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Tancredo</td><td> - </td><td>".horario("tancredo","ufsm"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Seletivo</td><td> - </td><td>".horario("seletivo","ufsm"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Circular</td><td> - </td><td>".horario("circular","ufsm"); ?></td>
         </tr>
      </table>
      <table id="tabela">
         <tr>
            <th colspan="3">Saindo dos terminais</th>
         </tr>
         <tr>
            <td><?php  echo "Universidade</td><td> - </td><td>".horario("universidade","centro"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Bombeiros</td><td> - </td><td>".horario("bombeiros","centro"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Tancredo</td><td> - </td><td>".horario("tancredo","tancredo"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Seletivo</td><td> - </td><td>".horario("seletivo","centro"); ?></td>
         </tr>
         <tr>
            <td><?php  echo "Circular</td><td> - </td><td>".horario("circular","centro"); ?></td>
         </tr>
      </table>


      <?php
         //TESTES
         /*echo "Hora agora ".(int)date('Hi',time())."<br>"."<br>";
         echo "Universidade centro ".horario("universidade","centro")."<br>"."<br>";
         echo "Universidade ufsm ".horario("universidade","ufsm")."<br>"."<br>";
         echo "Bombeiros centro ".horario("bombeiros","centro")."<br>"."<br>";
         echo "Bombeiros ufsm ".horario("bombeiros","ufsm")."<br>"."<br>";
         echo "Tancredo centro ".horario("tancredo","tancredo")."<br>"."<br>";
         echo "Tancredo ufsm ".horario("tancredo","ufsm")."<br>"."<br>";
         echo "Seletivo centro ".horario("seletivo","centro")."<br>"."<br>";
         echo "Seletivo ufsm ".horario("seletivo","ufsm")."<br>"."<br>";
         echo "Circular centro ".horario("circular","centro")."<br>"."<br>";
         echo "Circula ufsm ".horario("circular","ufsm")."<br>"."<br>";
         */
      ?>

   </body>
</html>


