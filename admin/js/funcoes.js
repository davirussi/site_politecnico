/* Mostra ou esconde o Form de Pesquisa que filtra os dados do LISTAR*/
function onclickBotaoPesquisa() {
    J('.form_pesquisa').toggle("slow");
}
/* onClick do botao para exportar para EXCEL, troca o value do campo tipo_exportacao e faz o submit do form*/
function exportaExcel() {
    J('#tipo_exportacao').val('excel');
    J('#form_exportar').submit();
}
/* onClick do botao para exportar para WORD, troca o value do campo tipo_exportacao e faz o submit do form*/
function exportaWord() {
    J('#tipo_exportacao').val('word');
    J('#form_exportar').submit();
}
/* onClick do botao para exportar para PDF, troca o value do campo tipo_exportacao e faz o submit do form*/
function exportaPdf() {
    J('#tipo_exportacao').val('pdf');
    J('#form_exportar').submit();
}

/* Troca o label do campo conteudo para link, aos elecionar o tipo link */
J(function() {
    J('#tipo_menu').change(function(){
        if (J('#tipo_menu').val() == 'link') {
            J('#conteudo_link').html('Descrição:');
            J('.url').css('display', '');
        } else {
            J('#conteudo_link').html('Conteúdo:');
            J('.url').css('display', 'none');
        }
    });
    J('#tipo_menu').change();
});

/* ao clicar no botao adiciona o caminho do arquivo interno no campo URL */
J(function() {
    J('#arquivo_interno').click(function(){
        J('#url').val(J('#url_interno').val());
    });
    J('#tipo_menu').change();
});

/* esconde o conteudo novo caso seja linkado um conteudo existente ao menu */
J(function() {
    J('#id_conteudo').change(function(){
        if (J('#id_conteudo').val() == '') {
            J('#conteudo').css('display', '');
        } else {
            J('#conteudo').css('display', 'none');
        }
    });
    J('#id_conteudo').change();
});

/* hover mause icones menu pagina inicial */
J(function() {
    J('#tabela_menu_inicial td').hover(
    function(){
        J(this).css('border', '2px dashed gray');
    },
    function(){
        J(this).css('border', '2px dashed white');
    }
    );
});