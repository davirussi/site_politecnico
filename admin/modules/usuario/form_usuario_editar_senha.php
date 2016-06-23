<form class="form_validacao" action="index.php?s=usuario&action=editar_senha" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>"/>
    <table class="form">
        <tr>
            <td class="label">Login:</td>
            <td>
                <?php echo $login;?>
            </td>
        </tr>
        <?php
            /* mostra o campo senha atual somente se não for administrador */
            if ($_SESSION['nivel'] != 1) {
                echo '
                <tr>
                    <td class="label">Senha Atual:</td>
                    <td>
                        <input type="password" name="senha_atual" value="" style="width:200px;"/>
                        ';
                        if(isset($erro['senha_atual'])){echo '<span class="erro">' . $erro['senha_atual'] . '</span>';}
               echo '</td>
                </tr>';
            }
        ?>
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
        <tr class="botoes">
            <td>
                <input type="submit" name="enviar" value="Enviar"/>
            </td>
        </tr>
    </table>
</form>