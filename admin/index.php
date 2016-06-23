<?php ob_start(); ?> 
<?php
session_start();
include_once 'php/funcoes.php';
?>
<html>
    <head>
        <title>Painel de Controle</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="images/logo.png">

        <script src="../js/jquery-1.6.2.min.js" type="text/javascript"></script>

        <!-- calendario -->
        <script src="../extensions/calendar/js/lib/prototype.js" type="text/javascript"></script>
        <script src="../extensions/calendar/js/src/scriptaculous.js" type="text/javascript"></script>

        <!-- Plugins -->
        <script src="../js/jquery.validate.js" type="text/javascript"></script>
        <script src="../js/jquery.tablesorter.js" type="text/javascript"></script>
        <script src="../js/jquery.validate.js" type="text/javascript"></script>
        <script src="../js/jquery.tablesorter.pager.js" type="text/javascript"></script>
        <script src="../js/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
        <script src="../js/ordenatabela.js" type="text/javascript"></script>
        <script src="../js/paginacaotabela.js" type="text/javascript"></script>
        <script src="js/validacampos.js" type="text/javascript"></script>
        <script src="../js/mascara.js" type="text/javascript"></script>

        <!-- menu -->
        <link rel="stylesheet" type="text/css" href="extensions/menu/ddsmoothmenu.css" />
        <script type="text/javascript" src="extensions/menu/ddsmoothmenu.js"></script>
        <script type="text/javascript" src="extensions/menu/menu.js"></script>

        <!-- JQuery UI -->
        <script type="text/javascript" src="../extensions/jquery-ui-1.8.13.custom/js/jquery-ui-1.8.13.custom.min.js">
        </script><link type="text/css" href="../extensions/jquery-ui-1.8.13.custom/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet"/>
        <script type="text/javascript">
            J(function() {
                //define os botoes utilizando o jquery UI
                J( ".button" ).button();
                J( "input:button" ).button();
                J( "input:submit" ).button();
                J( "input:reset" ).button();
            });
        </script>

        <script>
            function enviaId(id) {
                J('#id').val(id);
            }
            
            J(function() {
                J( "#dialog-modal" ).dialog({
                    autoOpen: false,
                    modal: true,
                    width: 700
                });
                J( ".visualizar_foto" ).click(function() {
                    J.ajax({
                        type: "POST",
                        url: 'ajax/visualizar_foto.php',
                        data: "id_foto=" + J('#id').val(),
                        success: function(data) {
                            J('#dialog-modal').html(data);
                        }
                    });  
                    J( "#dialog-modal" ).dialog( "open" );
                    return false;
                });
            });
        
        </script>

        <!-- editor de texto TinyMCE -->
        <script type="text/javascript" src="../extensions/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            tinyMCE.init({
                // General options
                mode : "exact",
                elements : "editor",
                language : "en",
                theme : "advanced",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                relative_urls : false,
                // Theme options
                theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,

                // Example content CSS (should be your site CSS)
                content_css : "css/content.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "lists/template_list.js",
                external_link_list_url : "lists/link_list.js",
                external_image_list_url : "lists/image_list.js",
                media_external_list_url : "lists/media_list.js",

                // Style formats
                style_formats : [
                    {title : 'Bold text', inline : 'b'},
                    {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                    {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                    {title : 'Example 1', inline : 'span', classes : 'example1'},
                    {title : 'Example 2', inline : 'span', classes : 'example2'},
                    {title : 'Table styles'},
                    {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
                ],

                // Replace values for the template plugin
                template_replace_values : {
                    username : "Some User",
                    staffid : "991234"
                }
            });
        </script>


        <!-- Funções JS -->
        <script type="text/javascript" src="js/funcoes.js"></script>

    </head>
    <body>
        <div id="tudo">
            <div id="cabecalho">
                <?php include_once 'php/cabecalho.php'; ?>
                <?php
                if (isset($_SESSION['id_usuario']))
                    include_once 'php/menu.php';
                ?>
            </div>
            <div id="meio">
                <div id="corpo">
                    <div id="content">
                        <div id="esquerda">
                            <?php
                            /* content */
                            if (isset($_GET['s'])) {
                                switch ($_GET['s']) {
                                    case "inicial": include_once "modules/inicial.php";
                                        break;
                                    case "logout": include_once "php/logout.php";
                                        break;
                                    case "usuario": include_once "modules/usuario/controller_usuario.php";
                                        break;
                                    case "menu": include_once "modules/menu/controller_menu.php";
                                        break;
                                    case "calendario": include_once "modules/calendario/controller_calendario.php";
                                        break;
                                    case "noticia": include_once "modules/noticia/controller_noticia.php";
                                        break;
                                    case "rss": include_once "modules/rss/controller_rss.php";
                                        break;
                                    case "conteudo": include_once "modules/conteudo/controller_conteudo.php";
                                        break;
                                    case "onibus": include_once "modules/onibus/controller_onibus.php";
                                        break;
                                    case "ru": include_once "modules/ru/controller_ru.php";
                                        break;
                                    case "arquivo": include_once "modules/arquivo/controller_arquivo.php";
                                        break;
                                    case "foto": include_once "modules/foto/controller_foto.php";
                                        break;
                                    default: include_once "php/login.php";
                                }
                            }
                            else
                                include_once "php/login.php";
                            ?>
                        </div>
                        <div id="direita">
                        </div>
                        <br clear="both"/>
                    </div>
                </div>
            </div>
            <div id="rodape">
                <?php include_once 'php/rodape.php' ?>
            </div>
        </div>
    <body>
</html>