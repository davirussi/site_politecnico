<form class="form_validacao" action="index.php?s=usuario&action=editar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>"/>
    <table class="form">
        <tr>
            <td class="label">Login:</td>
            <td>
                <?php echo $login;?>
            </td>
        </tr>
        <tr>
            <td class="label">Nível:</td>
            <td>
                <select name="nivel">
                    <?php
                        foreach ($gniveis as $label => $valor) {
                            ($valor == $nivel)?($selected = 'selected'):($selected = '');
                            echo '<option '.$selected.' value="' . $valor . '">' . $label . '</option>';
                       }
                    ?>
                </select>
                <?php if(isset($erro['nivel'])){echo '<span class="erro">' . $erro['nivel'] . '</span>';}?>
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