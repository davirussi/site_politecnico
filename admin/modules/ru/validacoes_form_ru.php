<?php

unset($erro);
 




/* DaTA */
$data = ($_POST['data']);
if (empty ($data)) {
    $erro['data'] = 'A Data não pode ficar em branco!';
}


/* URL */
$conteudo = ($_POST['conteudo']);
if (empty ($conteudo)) {
    $erro['conteudo'] = 'Prato não pode ficar em branco!';
}
?>