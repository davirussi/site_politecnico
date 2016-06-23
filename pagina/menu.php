<?php
    conecta();

    /* busca os menus pai do sistema e monta o menu */
    $resultado_menus = mysql_query("SELECT * FROM menu WHERE id_menu_pai IS NULL OR id_menu_pai = '' ORDER BY ordem");

    /* monta o menu */
    $menu = "<ul>";
    while ($menus = mysql_fetch_array($resultado_menus)) {
        if ($menus['tipo'] == 'link') {
            $menu .= '<li><a href="' . $menus['conteudo'] . '" target="_blank">' . $menus['titulo'] . ' |</a></li>';
        } else {
            $menu .= '<li><a href="index.php?s=menu&id1=' . $menus['id_menu'] . '">' . $menus['titulo'] . ' |</a></li>';
        }
    }
    $menu .= '<br style="clear: left" /></ul>';
?>

<div id="smoothmenu1" class="ddsmoothmenu" style="">
        <?php echo $menu; ?>
</div>