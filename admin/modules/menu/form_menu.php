<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>"/>
    <input type="hidden" name="id_menu_pai" value="<?php echo ($_GET['id_menu_pai'])?$_GET['id_menu_pai']:($id_menu_pai?$id_menu_pai:''); ?>"/>
    <table class="form">
        <tr>
            <td class="label">Título:</td>
            <td>
                <input type="text" name="titulo" value="<?php echo $titulo; ?>" style="width:400px;"/>
                <?php if (isset($erro['titulo'])) {
                    echo '<span class="erro">' . $erro['titulo'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Ordem:</td>
            <td>
                <input type="text" name="ordem" value="<?php echo $ordem; ?>" style="width:50px;"/>
                <?php if (isset($erro['ordem'])) {
                    echo '<span class="erro">' . $erro['ordem'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Linkar Conteúdo:</td>
            <td>
                <select id="id_conteudo" name="id_conteudo">
                    <?php
                         
                        $gconteudos['Nenhum'] = '';
                        foreach ($gconteudos as $label => $valor) {
                            ($valor == $id_conteudo)?($selected = 'selected'):($selected = '');
                            echo '<option '.$selected.' value="' . $valor . '">' . $label . '</option>';
                       }
                    ?>
                </select>
                <?php if(isset($erro['id_conteudo'])){echo '<span class="erro">' . $erro['id_conteudo'] . '</span>';}?>
            </td>
        </tr>
    </table>
            
    <div id="conteudo" >
        <h2>Conteúdo Novo:</h2>
        <hr>
    <table class="form">
        <tr>
            <td class="label">Tipo:</td>
            <td>
                <select name="tipo" id="tipo_menu">
                    <?php
                        foreach ($gtipos_conteudo as $label => $valor) {
                            ($valor == $tipo)?($selected = 'selected'):($selected = '');
                            echo '<option '.$selected.' value="' . $valor . '">' . $label . '</option>';
                       }
                    ?>
                </select>
                <?php if(isset($erro['tipo'])){echo '<span class="erro">' . $erro['tipo'] . '</span>';}?>
            </td>
        </tr>
        <tr>
            <td class="label">Título:</td>
            <td>
                <input type="text" name="titulo_conteudo" value="<?php echo $titulo_conteudo; ?>" style="width:400px;"/>
                <?php if (isset($erro['titulo_conteudo'])) {
                    echo '<span class="erro">' . $erro['titulo_conteudo'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td id="conteudo_link" class="label">Conteúdo:</td>
            <td>
                <textarea id="editor" name="conteudo" rows="15" style="width:400px;"><?php echo $conteudo;?></textarea>
                <?php if(isset($erro['conteudo'])){echo '<span class="erro">' . $erro['conteudo'] . '</span>';}?>
            </td>
        </tr>
        <tr id="url">
            <td class="label" >URL:</td>
            <td>
                <input type="text" name="url" value="<?php echo $url; ?>" style="width:600px;"/>
                <?php if (isset($erro['url'])) {
                    echo '<span class="erro">' . $erro['url'] . '</span>';
                } ?>
            </td>
        </tr>
    </table>
    </div>    
        
    <table class="form">
        <tr class="botoes">
            <td>
                <input type="submit" name="enviar" value="Enviar"/>
            </td>
            <td>
            </td>
        </tr>
    </table>
</form>