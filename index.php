<?php ob_start(); ?> 
<?php
session_start();
include_once 'funcoes.php';
?>
<html>
    <head>
        <title>Informática</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/slider.css">
        <link rel="shortcut icon" href="images/logo.png">

        <!-- JQuery -->
        <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

        <!-- calendario -->
        <script src="extensions/calendar/js/lib/prototype.js" type="text/javascript"></script>
        <script src="extensions/calendar/js/src/scriptaculous.js" type="text/javascript"></script>

        <!-- Plugins -->
        <script src="js/jquery.cycle.all.min.js" type="text/javascript"></script>
        <!-- menu -->
        <link rel="stylesheet" type="text/css" href="extensions/menu/ddsmoothmenu.css" />
        <script type="text/javascript" src="extensions/menu/ddsmoothmenu.js"></script>
        <script type="text/javascript" src="extensions/menu/menu.js"></script>

        <!-- JQuery UI -->
        <script type="text/javascript" src="extensions/jquery-ui-1.8.13.custom/js/jquery-ui-1.8.13.custom.min.js">
        </script><link type="text/css" href="extensions/jquery-ui-1.8.13.custom/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet"/>

        <!-- Funções JS -->
        <script type="text/javascript" src="js/funcoes.js"></script>

    </head>
    <body>
        <div id="cabecalho_brasil">
            <div class="fundo_verde"></div>
            <div class="fundo_verde_amarelo"></div>
            <div class="brasil"><img src="images/br.png" align="right" /></div>
        </div>
        <div id="tudo">
            <div id="cabecalho"></div>
            <div id="menu"><?php include_once 'pagina/menu.php' ?></div>
            <div id="content_slider"><?php include_once 'pagina/banner.php' ?></div>
            <div id="content">
                <?php
                /* content */
                if (isset($_GET['s'])) {
                    switch ($_GET['s']) {
                        case "menu": include_once "modules/menu/controller_menu.php";
                            break;
                        case "noticia": include_once "modules/noticia/controller_noticia.php";
                            break;
                        case "link": include_once "modules/link/controller_link.php";
                            break;
                        default: include_once "modules/menu/controller_menu.php";
                    }
                }
                else
                    include_once "modules/menu/controller_menu.php";
                ?>
            </div>
            <div id="rodape"><?php include_once 'pagina/rodape.php' ?></div>
        </div>
    <body>
</html>