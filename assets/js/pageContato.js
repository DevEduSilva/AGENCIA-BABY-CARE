const formularioEscolha = document.querySelector('#escolhaFormularioUnico');
const formularioBaba = document.querySelector('#meuFormulario');
const formularioFuncionario = document.querySelector('#formularioBabá');

const contatoMapa = document.querySelector(".contact-info")

formularioEscolha.addEventListener("click", function (event) {
    event.preventDefault();
    const target = event.target;

    if (target.classList.contains("contratarUnico")) {
        formularioBaba.classList.remove("hide");
        formularioEscolha.classList.add("hide");
        contatoMapa.classList.add("hideContainer");
    } else if (target.classList.contains("trabalharUnico")) {
        formularioFuncionario.classList.remove("hide");
        formularioEscolha.classList.add("hide");
        contatoMapa.classList.add("hideContainer");
    }
});

function voltar() {
    formularioEscolha.classList.remove("hide");
    contatoMapa.classList.remove("hideContainer");
    formularioBaba.classList.add("hide");
    formularioFuncionario.classList.add("hide");
}
