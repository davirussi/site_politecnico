<form class="form_validacao" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <table class="form">
        <tr>
            <td class="label">Foto:</td>
            <td>
               <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $g_tamanho_arquivo; ?>" />
                <input type="file" name="foto" style="width:400px;"/>
                <?php if(isset($erro['foto'])){echo '<span class="erro">' . $erro['foto'] . '</span>';}?>
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