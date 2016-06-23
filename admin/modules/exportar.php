<?php

##############################################################################
##/* arquivo que recebe uma tabela html e exporta para excel, pdf ou Word */##
##############################################################################

/* recebe a tabela e decodifica utf8 para (word e excel) pdf não precisa decodificar */
$tabela_exportar = utf8_decode($_POST['tabela_exportar']);

/* se existe nome recebe por post, senao adiciona um nome generico */
$_POST['nome_arquivo'] ? $nome_arquivo = $_POST['nome_arquivo'] . '_' . date('d-m-Y_h-i-s') : ($nome_arquivo = 'arquivo_' . date('d-m-Y_h-i-s'));

############################################
##/* se a opcão for exportar para EXCEL */##
############################################
if ($_POST['tipo_exportacao'] == 'excel') {
    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=" . $nome_arquivo . ".xls");
    

    echo $tabela_exportar;
}

############################################
##/* se a opcão for exportar para WORD  */##
############################################
if ($_POST['tipo_exportacao'] == 'word') {
    header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=" . $nome_arquivo . ".doc");

    echo $tabela_exportar;
}

############################################
##/* se a opcão for exportar para PDF   */##
############################################
if ($_POST['tipo_exportacao'] == 'pdf') {

    /* monta o cabecalho do pdf */
    $cabecalho = "<table class='cabecalho' width='700px;'>
                        <tr>
                            <td>
                                <img src='../images/logo.jpg' width='20px' height='25px'/>
                            </td>
                            <td align='right'>
                                Técnico em Informática
                            </td>
                        </tr>
                      </table><hr>";
    
    /* monta o rodape do pdf */
    $rodape = "<div class='rodape'>
                        <div class='left'>".date('d-m-Y h:i:s')."</div>
                        <hr>
                   </div>";

    /* importa a classe MPDF */
    include "../extensions/MPDF52/mpdf.php";
    $mpdf = new mPDF('pt', 'A4');
    $stylesheet = file_get_contents('../css/exportar.css');
    $mpdf->tMargin = 35;
    $mpdf->bMargin = 25;
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->SetHTMLHeader($cabecalho);
    $mpdf->SetHTMLFooter($rodape);
    $mpdf->WriteHTML($_POST['tabela_exportar']);
    $mpdf->Output($nome_arquivo . ".pdf", "D");
}
?>