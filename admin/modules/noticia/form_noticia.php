<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_noticia" value="<?php echo $id_noticia; ?>"/>
    <table class="form">
        <tr>
            <td class="label">Classificação:</td>
            <td>
                <select name="classificacao">
                    <?php
                         
                        foreach ($gclassificacao_noticias as $label => $valor) {
                            ($valor == $classificacao)?($selected = 'selected'):($selected = '');
                            echo '<option '.$selected.' value="' . $valor . '">' . $label . '</option>';
                       }
                    ?>
                </select>
                <?php if(isset($erro['classificacao'])){echo '<span class="erro">' . $erro['classificacao'] . '</span>';}?>
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
            <td id="conteudo_link" class="label">Resumo:</td>
            <td>
                <textarea name="resumo" rows="5" style="width:400px;"><?php echo $resumo;?></textarea>
                <?php if(isset($erro['resumo'])){echo '<span class="erro">' . $erro['resumo'] . '</span>';}?>
            </td>
        </tr>
        <tr>
            <td id="conteudo_link" class="label">Conteúdo:</td>
            <td>
                <textarea id="editor" name="conteudo" rows="15" style="width:400px;"><?php echo $conteudo;?></textarea>
                <?php if(isset($erro['conteudo'])){echo '<span class="erro">' . $erro['conteudo'] . '</span>';}?>
            </td>
        </tr>
        <tr class="botoes">
            <td>
                <input type="submit" name="enviar" value="Enviar"/>
            </td>
            <td>
                <input type="reset" name="limpar" value="Limpar"/>
            </td>
        </tr>
    </table>
</form>