<html>
   <?php
      $context = array(
      'http' => array(
      'proxy' => $proxy,
      'request_fulluri' => True,
      ),
      );
      $context = stream_context_create($context);
      $conteudo_site = file_get_contents($url, False, $context);
   ?>
</html>


