<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_ru" value="<?php echo $id_ru; ?>"/>
    <table class="form">
        <tr>
            <td class="label">HTML entre as duas Tabelas:</td>
            <td>
                <input type="text" name="html_entre_as_duas_tabelas" value="<?php echo $html_entre_as_duas_tabelas; ?>" style="width:600px;"/>
                <?php if (isset($erro['html_entre_as_duas_tabelas'])) {
                    echo '<span class="erro">' . $erro['html_entre_as_duas_tabelas'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Antes do Horario:</td>
            <td>
                <input type="text" name="html_antes_horario" value="<?php echo htmlentities($html_antes_horario); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_antes_horario'])) {
                    echo '<span class="erro">' . $erro['html_antes_horario'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Depois do Horario:</td>
            <td>
                <input type="text" name="html_depois_horario" value="<?php echo htmlentities($html_depois_horario); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_depois_horario'])) {
                    echo '<span class="erro">' . $erro['html_depois_horario'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Antes da Linha:</td>
            <td>
                <input type="text" name="html_antes_da_linha" value="<?php echo htmlentities($html_antes_da_linha); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_antes_da_linha'])) {
                    echo '<span class="erro">' . $erro['html_antes_da_linha'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">HTML Depois da Linha:</td>
            <td>
                <input type="text" name="html_depois_da_linha" value="<?php echo htmlentities($html_depois_da_linha); ?>" style="width:600px;"/>
                <?php if (isset($erro['html_depois_da_linha'])) {
                    echo '<span class="erro">' . $erro['html_depois_da_linha'] . '</span>';
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