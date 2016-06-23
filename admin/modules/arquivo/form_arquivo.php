<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <table class="form">
        <tr>
            <td class="label">Arquivo:</td>
            <td>
               <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $g_tamanho_arquivo; ?>" />
                <input type="file" name="arquivo" style="width:400px;"/>
                <?php if(isset($erro['arquivo'])){echo '<span class="erro">' . $erro['arquivo'] . '</span>';}?>
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