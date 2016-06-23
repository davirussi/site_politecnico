<?php

include '../../funcoes.php';
conecta();
$linha = mysql_fetch_array(mysql_query("SELECT * FROM foto WHERE id_foto = " . $_POST['id_foto']));

echo '<img src="' . $g_caminho_fotos . $linha['nome'] . '"/><br/><br/>URL: '. $g_caminho_fotos . $linha['nome'];
?>