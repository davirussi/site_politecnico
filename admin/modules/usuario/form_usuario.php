<form class="form_validacao" action="index.php?s=usuario&action=inserir" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>"/>
    <table class="form">
        <tr>
            <td class="label">Login:</td>
            <td>
                <input type="text" name="login" value="<?php echo $login;?>" style="width:400px;"/>
                <?php if(isset($erro['login'])){echo '<span class="erro">' . $erro['login'] . '</span>';}?>
            </td>
        </tr>
        <tr>
            <td class="label">Senha:</td>
            <td>
                <input type="password" name="senha" value="" style="width:200px;"/>
            </td>
        </tr>
        <tr>
            <td class="label">Repita a Senha:</td>
            <td>
                <input type="password" name="senha2" value="" style="width:200px;"/>
                <?php if(isset($erro['senha'])){echo '<span class="erro">' . $erro['senha'] . '</span>';}?>
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