<div id="smoothmenu1" class="ddsmoothmenu" style="">
    <ul>
        <li><a href="index.php">Início</a></li>

        <li><a href="#">Site</a>
            <ul>
                <li><a href="index.php?s=menu&action=listar">Menus</a>
                    <ul>
                        <li><a href="index.php?s=menu&action=listar">Listar Menus</a></li>
                        <li><a href="index.php?s=menu&action=inserir">Inserir Menu</a></li>
                    </ul>
                </li>
                <li><a href="index.php?s=conteudo&action=listar">Conteúdos</a>
                    <ul>
                        <li><a href="index.php?s=conteudo&action=listar">Listar Conteúdos</a></li>
                        <li><a href="index.php?s=conteudo&action=inserir">Inserir Conteúdos</a></li>
                    </ul>
                </li>
                <li><a href="index.php?s=arquivo&action=listar">Arquivos</a></li>
                <li><a href="index.php?s=foto&action=listar">Fotos</a></li>
                <li><a href="index.php?s=noticia&action=listar">Notícias</a>
                    <ul>
                        <li><a href="index.php?s=noticia&action=listar">Listar Notícias</a></li>
                        <li><a href="index.php?s=noticia&action=inserir">Inserir Notícia</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#">Serviços</a>
            <ul>
                <li><a href="index.php?s=calendario&action=admin">Calendário</a></li>
                <li><a href="index.php?s=rss&action=listar">RSS</a>
                    <ul>
                        <li><a href="index.php?s=rss&action=listar">Listar Feed RSS</a></li>
                        <li><a href="index.php?s=rss&action=inserir">Inserir Feed RSS</a></li>
                    </ul>
                </li>
                <li><a href="index.php?s=ru&action=listar">RU</a>
                    <ul>
                        <li><a href="index.php?s=ru&action=listar">Listar RU</a></li>
                        <li><a href="index.php?s=ru&action=config">Config RU</a></li>
                    </ul>
                </li>
                <li><a href="index.php?s=onibus&action=config">Ônibus</a>
                    <ul>
                        <li><a href="index.php?s=onibus&action=config">Config Ônibus</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#">( <?php echo $_SESSION['login']; ?> )</a>
            <ul>
                <li><a href="index.php?s=usuario&action=listar">Usuários</a>
                    <ul>
                        <li><a href="index.php?s=usuario&action=listar">Listar Usuários</a></li>
                        <li><a href="index.php?s=usuario&action=inserir">Inserir Usuário</a></li>
                    </ul>
                </li>
                <li><a href="index.php?s=usuario&action=editar_senha&id_usuario= <?php echo $_SESSION['id_usuario']; ?>"><img align="center" src="images/senha.png" /> Editar Senha</a></li>
                <li><a href="index.php?s=logout"><span style="color:red;">X</span> Sair</a></li>
            </ul>
        </li>
        <br style="clear: left" />
    </ul>
</div>