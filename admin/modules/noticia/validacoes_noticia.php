<?php
 
/* titulo */
$titulo = filtro($_POST['titulo']);
if (empty ($titulo)) {
    $erro['titulo'] = 'O título não pode ficar em branco!';
}
if (strlen($titulo) > 45) {
    $erro['titulo'] = 'O título deve ter no máximo 45 caracteres!';
}

/* resumo */
$resumo = filtro($_POST['resumo']);
if (empty ($resumo)) {
    $erro['resumo'] = 'O Resumo não pode ficar em branco!';
}

/* conteudo */
$conteudo = $_POST['conteudo'];
if (empty($conteudo)) {
    $erro['conteudo'] = 'Conteudo inválido!';
}

/* classificacao */
$classificacao = filtro($_POST['classificacao']);
if (valida_combobox($classificacao, $gclassificacao_noticias)) {
    $erro['classificacao'] = 'Classificação inválida!';
}

/* id_noticia */
if (isset($_POST['id_noticia'])) {
    $id_noticia = filtro($_POST['id_noticia']);
}
 
?>