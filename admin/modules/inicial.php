<?php
if (!isset($_SESSION))
    exit;
valida_logado(2);
?>


<center>
<table id="tabela_menu_inicial">
    <tr class="break">
        <td colspan="5">Site</td>
    </tr>    
    <tr>    
        <td title="Menus"><a href="index.php?s=menu&action=listar" ><img src="images/menus.png" /><br>Menus</a></td>
        <td title="Conteúdos"><a href="index.php?s=conteudo&action=listar" ><img src="images/conteudos.png" /><br>Conteúdos</a></td>
        <td title="Arquivos"><a href="index.php?s=arquivo&action=listar" ><img src="images/arquivos.png" /><br>Arquivos</a></td>
        <td title="Fotos"><a href="index.php?s=foto&action=listar" ><img src="images/fotos.png" /><br>Fotos</a></td>
        <td title="Notícias"><a href="index.php?s=noticia&action=listar" ><img src="images/noticias.png"/><br>Notícias</a></td>
    </tr>    
    <tr class="break">
        <td colspan="4">Serviços</td>
    </tr>   
    <tr>    
        <td title="Calendário"><a href="index.php?s=calendario&action=admin" ><img src="images/calendario.png" /><br>Calendário</a></td>
        <td title="RSS"><a href="index.php?s=rss&action=listar" ><img src="images/rss.png" /><br>RSS</a></td>
        <td title="RU"><a href="index.php?s=ru&action=listar" ><img src="images/ru.png" /><br>RU</a></td>
        <td title="Horários Ônibus"><a href="index.php?s=onibus&action=config" ><img src="images/onibus.png" /><br>Ônibus</a></td>
    </tr>  
    <tr class="break">
        <td colspan="1">Sistema</td>
    </tr>   
    <tr>
        <td title="Usuários" ><a href="index.php?s=usuario&action=listar" ><img src="images/usuarios.png" /><br>Usuários</a></td>
    </tr>  
</table>
</center>