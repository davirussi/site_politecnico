<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_ru" value="<?php echo $id_ru; ?>"/>
    <table class="form">
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
            <td class="label">HTML Antes do Cardapio do dia:</td>
            <td>
                <input type="text" name="html_antes_do_cardapio_do_dia" value="<?php echo htmlentities($html_antes_do_cardapio_do_dia); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_antes_do_cardapio_do_dia'])) {
                    echo '<span class="erro">' . $erro['html_antes_do_cardapio_do_dia'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Antes do Prato:</td>
            <td>
                <input type="text" name="html_antes_do_prato" value="<?php echo htmlentities($html_antes_do_prato); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_antes_do_prato'])) {
                    echo '<span class="erro">' . $erro['html_antes_do_prato'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Depois do Prato:</td>
            <td>
                <input type="text" name="html_depois_do_prato" value="<?php echo htmlentities($html_depois_do_prato); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_depois_do_prato'])) {
                    echo '<span class="erro">' . $erro['html_depois_do_prato'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Antes da Data:</td>
            <td>
                <input type="text" name="html_antes_data" value="<?php echo htmlentities($html_antes_data); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_antes_data'])) {
                    echo '<span class="erro">' . $erro['html_antes_data'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Depois da Data:</td>
            <td>
                <input type="text" name="html_depois_data" value="<?php echo htmlentities($html_depois_data); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_depois_data'])) {
                    echo '<span class="erro">' . $erro['html_depois_data'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Separador da Data:</td>
            <td>
                <input type="text" name="separador_explode_data" value="<?php echo htmlentities($separador_explode_data); ?>" style="width:600px;"/>
                <?php if (isset($erro['separador_explode_data'])) {
                    echo '<span class="erro">' . $erro['separador_explode_data'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Usa Proxy?(0 = nao - 1 = sim)</td>
            <td>
                <input type="text" name="usa_proxy" value="<?php echo $usa_proxy; ?>" style="width:50px;"/>
                <?php if (isset($erro['usa_proxy'])) {
                    echo '<span class="erro">' . $erro['usa_proxy'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr class="botoes">
            <td>
                <input type="submit" name="enviar" value="Alterar"/>
            </td>
        </tr>
    </table>
</form>