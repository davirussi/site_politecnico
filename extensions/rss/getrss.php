<?php
   //definindo os rss
   include "linksrss.php";

   foreach($vetxml as $xml)
   {
      $xmlDoc = new DOMDocument();
      $xmlDoc->load($xml);

      //get elements from "<channel>"
      $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
      $channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
      $channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
      //$channel_desc = $channel->getElementsByTagName('description')
      //->item(0)->childNodes->item(0)->nodeValue;

      //output elements from "<channel>"

      echo "<table id=\"tabela\">";

      echo("<tr><th><p>" . $channel_title . "</th></tr>");
      //echo("<br />");
      //echo($channel_desc . "</p>");

      //get and output "<item>" elements
      $x=$xmlDoc->getElementsByTagName('item');
      for ($i=0; $i<=4; $i++)
      {
         $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
         $item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
         //$item_desc=$x->item($i)->getElementsByTagName('description')
         //->item(0)->childNodes->item(0)->nodeValue;

         echo ("<tr><td><p><a href='" . $item_link
         . "'>" . $item_title . "</a></tr></td>");
         //echo ("<br />");
         //echo ($item_desc . "</p>");
      }
      echo "</table>";
      
   }   
?>