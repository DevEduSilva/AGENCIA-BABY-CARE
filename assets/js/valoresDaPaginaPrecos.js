const radioButtons = document.querySelectorAll('input[name="horario"]');
const valorDisplay = document.getElementById('valorValue');

document.addEventListener('DOMContentLoaded', () => {
    const valores = {
        diurno: ' R$ 35,00/h',
        noturno: ' R$ 40,00/h',
        'final-de-semana': ' R$ 45,00/h',
    };

    // Adiciona eventos de mudança para os botões de seleção
    radioButtons.forEach((radio) => {
        radio.addEventListener('change', () => {
            const valorSelecionado = valores[radio.value];
            valorDisplay.textContent = valorSelecionado;
        });
    });
});