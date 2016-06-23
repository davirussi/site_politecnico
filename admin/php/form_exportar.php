<?php
/* formulario para exportar os dados da tabela listar */
echo '  <form id="form_exportar" action="modules/exportar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="tabela_exportar" value=\'' . $tabela_exportar . '\'/>
            <input type="hidden" name="nome_arquivo" value=\'' . $nome_arquivo . '\'/>
            <input id="tipo_exportacao" type="hidden" name="tipo_exportacao" value=""/>
        </form>';
?>