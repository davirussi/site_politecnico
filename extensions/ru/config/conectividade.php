<html>
   <?php
      $url="http://www.google.com";
   
      if ($usa_proxy)
      {
         include "config/proxy.php";
      }
      else
      {
         if (fopen("http://www.google.com/",'r'))
            echo "OK";
         else
            echo "problema na conexão";  
      }
   ?>
</html>


