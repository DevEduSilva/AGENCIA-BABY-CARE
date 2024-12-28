$(document).ready(function () {
    // Máscaras para o CEP em ambos os formulários
    $('.input-cep').mask('00000-000');

    // Máscara inicial para o telefone nos dois formulários
    $('.input-telefone').mask('(00) 00000-0009');

    // Lógica para aplicar a máscara de celular ou fixo após o blur
    $('.input-telefone').blur(function () {
        if ($(this).val().length === 15) {
            // Se o telefone tiver 15 caracteres, aplica a máscara de celular
            $(this).mask('(00) 00000-0009');
        } else {
            // Caso contrário, aplica a máscara de telefone fixo
            $(this).mask('(00) 0000-00009');
        }
    });

    // Validação de email com exibição de erro
    $('.input-email').blur(function () {  // Usando .input-email para selecionar os campos de email pela classe
        var email = $(this).val();
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (!emailRegex.test(email)) {
            $(this).css('border', '2px solid red');  // Muda a cor da borda
            $(this).siblings('.emailError')  // Seleciona o span com a classe .emailError
                .text('Por favor, insira um email válido.')
                .css({
                    'color': 'red',
                    'font-size': '12px',
                    'margin-top': '0',
                    'margin-bottom': '5px',
                    'display': 'block'
                });  // Exibe a mensagem de erro e aplica os estilos
        } else {
            $(this).css('border', '');  // Reseta a borda
            $(this).siblings('.emailError').hide();  // Esconde a mensagem de erro
        }
    });
});
