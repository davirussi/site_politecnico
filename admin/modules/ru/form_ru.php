<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
    <table class="form">
        <tr>
            <td class="label">Data:</td>
            <td>
                <input type="text" name="data" value="<?php echo $data; ?>" style="width:100px;"/>
                <?php if (isset($erro['data'])) {
                    echo '<span class="erro">' . $erro['data'] . '</span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td class="label">Prato</td>
            <td>
                <input type="text" name="conteudo" value="<?php echo $conteudo; ?>" style="width:500px;"/>
                <?php if (isset($erro['conteudo'])) {
                    echo '<span class="erro">' . $erro['conteudo'] . '</span>';
                } ?>
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