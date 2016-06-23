/* botoes persnalizados JQuery UI */
J(function() {
    //define os botoes utilizando o jquery UI
    J( ".button" ).button();
    J( "input:button" ).button();
    J( "input:submit" ).button();
    J( "input:reset" ).button();
});

/* Define as configurações do BANNER */
J(function(){
    J("#slideshow").cycle({
        timeout: 16000,
        delay:  -1000
    });
});

/* Mostra ou esconde um elemento*/
function onclickAbrir(id) {
    J('#'+id).toggle();
}
