<?php
$linha = mysql_fetch_array(mysql_query("SELECT titulo FROM menu WHERE id_menu = " . $_GET['id1']));
if ($linha['titulo'] == 'Página Inicial') {
    $resultado = mysql_query("SELECT n.*, m.titulo as classificacao FROM noticia n INNER JOIN menu m ON m.id_menu = n.id_menu  ORDER BY data DESC LIMIT 10");
} else {
    $resultado = mysql_query("SELECT n.*, m.titulo as classificacao FROM noticia n INNER JOIN menu m ON m.id_menu = n.id_menu  WHERE n.id_menu = " . $_GET['id1'] . " ORDER BY data DESC LIMIT 10");
}

while ($linha = mysql_fetch_array($resultado)) {
    echo '<div class="noticia">
            <a href="index.php?s=noticia&id_noticia=' . $linha['id_noticia'] . '&id1=' . $linha['id_menu'] . '">
                <span class="titulo">'. $linha['titulo'] . '</span><br>
                <span class="resumo">' . $linha['resumo'] . '</span><br>
                <span class="data">(' . formata_data($linha['data'], 'datetime', 'buscar') . ')(' . $linha['classificacao'] . ')</span>
             </a>
          </div>';
}

?>