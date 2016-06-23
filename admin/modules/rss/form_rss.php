<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_rss" value="<?php echo $id_rss; ?>"/>
    <table class="form">
        <tr>
            <td class="label">Nome:</td>
            <td>
                <input type="text" name="nome" value="<?php echo $nome; ?>" style="width:400px;"/>
                <?php if (isset($erro['nome'])) {
                    echo '<span class="erro">' . $erro['nome'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">URL:</td>
            <td>
                <input type="text" name="url" value="<?php echo $url; ?>" style="width:600px;"/>
                <?php if (isset($erro['url'])) {
                    echo '<span class="erro">' . $erro['url'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Número de Itens Visualizados:</td>
            <td>
                <input type="text" name="nro_itens" value="<?php echo $nro_itens; ?>" style="width:50px;"/>
                <?php if (isset($erro['nro_itens'])) {
                    echo '<span class="erro">' . $erro['nro_itens'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Mostrar:</td>
            <td>
                <select name="mostrar">
                    <?php
                         
                        foreach ($gmostrar as $label => $valor) {
                            ($valor == $mostrar)?($selected = 'selected'):($selected = '');
                            echo '<option '.$selected.' value="' . $valor . '">' . $label . '</option>';
                       }
                    ?>
                </select>
                <?php if(isset($erro['mostrar'])){echo '<span class="erro">' . $erro['mostrar'] . '</span>';}?>
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