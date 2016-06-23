<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_conteudo" value="<?php echo $id_conteudo; ?>"/>
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
                <input type="text" name="titulo" value="<?php echo $titulo; ?>" style="width:400px;"/>
                <?php if (isset($erro['titulo'])) {
                    echo '<span class="erro">' . $erro['titulo'] . '</span>';
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
        <tr class="url">
            <td class="label" >URL:</td>
            <td>
                <input type="text" name="url" id="url" value="<?php echo ($url?$url:'http://'); ?>" style="width:600px;"/>
                <?php if (isset($erro['url'])) {
                    echo '<span class="erro">' . $erro['url'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr class="url">
            <td class="label" >ou arquivo interno:</td>
            <td>
                <select name="url_interno" id="url_interno">
                    <?php
                        foreach ($g_arquivos as $label => $valor) {
                            ($valor == $url)?($selected = 'selected'):($selected = '');
                            echo '<option '.$selected.' value="' . $valor . '">' . $label . '</option>';
                       }
                    ?>
                </select>
                <input type="button" id="arquivo_interno" value="Adicionar"/>
            </td>
        </tr>
        <tr class="botoes">
            <td>
                <input type="submit" name="enviar" value="Enviar"/>
            </td>
            <td>
            </td>
        </tr>
    </table>
</form>