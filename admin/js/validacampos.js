
// Inicia o validador ao carregar a página
$(function() {
    // valida o formulário
    $('.form_validacao').validate({
        // define regras para os campos
        rules: {
            login: {
                required: true
            },	
            senha: {
                required: true,
                minlength: 6
            },
            senha2: {
                required: true,
                minlength: 6
            },
            senhaatual: {
                required: true,
                minlength: 6
            }
        },
        // define messages para cada campo
        messages: {
            login: {
                required: "<span class='erro'>* Campo Obrigatório!</span>"
            },
            senha: {
                required: "<span class='erro'>* Campo Obrigatório!</span>",
                minlength: "<span class='erro'>* A senha deve possuir 6 caracteres!</span>"
            },
            senha2: {
                required: "<span class='erro'>* Campo Obrigatório!</span>",
                minlength: "<span class='erro'>* A senha deve possuir 6 caracteres!</span>"
            },
            senhaatual: {
                required: "<span class='erro'>* Campo Obrigatório!</span>",
                minlength: "<span class='erro'>* A senha deve possuir 6 caracteres!</span>"
            }
        }
    }); 
});