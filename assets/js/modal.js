// Seleção de elementos
const openModalButton = document.getElementById('ctaabout');
const modalOverlay = document.createElement('div');
modalOverlay.id = 'modal-overlay';
modalOverlay.innerHTML = `
  <div id="modal-content">
    <div class="modal-card">
      <img src="assets/img/Lays.png" alt="Imagem da Laís">
      <h3>Laís</h3>
      <p>Olá, sou a Laís! Com 7 anos de experiência como babá e graduando em Pedagogia, adoro cuidar de crianças de diferentes idades e necessidades. Agora, com <span id="more-lays" class="more-text"> minha própria agência, ofereço um serviço de confiança e carinho, com profissionais qualificados e dedicados a proporcionar um cuidado especial para cada criança. Será um prazer atender você e sua família.</span></p>
      <button class="btnModal" id="toggle-lays">LER MAIS</button>
    </div>
    <div class="modal-card">
      <img src="assets/img/Leticia.png" alt="Imagem da Leticia">
      <h3>Letícia</h3>
      <p>Sou Letícia, advogada trabalhista com 10 anos de experiência, mãe de dois meninos e apaixonada pela maternidade. Ao buscar um cuidado especializado para meus filhos, percebi a falta de opções de qualidade no mercado. Foi então <span id="more-leticia" class="more-text"> que conheci a Laís, que me mostrou que era possível oferecer um serviço de babás com excelência e carinho. Com isso, criamos uma solução para garantir à sua família não só um cuidado especializado, mas também a redução de custos e riscos, com assessoria jurídica e acompanhamento profissional.</span></p>
      <button class="btnModal" id="toggle-leticia">LER MAIS</button>
    </div>
  </div>
  <button id="close-modal">X</button>
`;

// Adicionar o modal ao DOM
document.body.appendChild(modalOverlay);

// Abertura do modal
openModalButton.addEventListener('click', () => {
    modalOverlay.style.display = 'flex';

    // Desabilitar o scroll da página
    document.body.style.overflow = 'hidden';

    // Resetar o estado dos botões para "LER MAIS" e esconder o texto extra
    resetModal();
});

// Fechar o modal ----------------------------
// Pelo botão
const closeModalButton = modalOverlay.querySelector('#close-modal');
closeModalButton.addEventListener('click', () => {
    modalOverlay.style.display = 'none';

    // Restaurar o scroll da página
    document.body.style.overflow = '';
});

//  Clicando fora
modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) {
        modalOverlay.style.display = 'none';

        // Restaurar o scroll da página
        document.body.style.overflow = '';
    }
});
// Mostrar/ocultar texto extra (Ler Mais/Ler Menos) ----------------------------

// Para Lays
const toggleLaysButton = modalOverlay.querySelector('#toggle-lays');
const moreLaysText = modalOverlay.querySelector('#more-lays');

toggleLaysButton.addEventListener('click', () => {
    if (moreLaysText.style.display === 'none') {
        moreLaysText.style.display = 'inline';
        toggleLaysButton.textContent = 'LER MENOS';
    } else {
        moreLaysText.style.display = 'none';
        toggleLaysButton.textContent = 'LER MAIS';
        moreLaysText.innerHTML = " minha própria agência, ofereço um serviço de confiança e carinho, com profissionais qualificados e dedicados a proporcionar um cuidado especial para cada criança. Será um prazer atender você e sua família...";
    }
});

// Para Letícia
const toggleLeticiaButton = modalOverlay.querySelector('#toggle-leticia');
const moreLeticiaText = modalOverlay.querySelector('#more-leticia');

toggleLeticiaButton.addEventListener('click', () => {
    if (moreLeticiaText.style.display === 'none') {
        moreLeticiaText.style.display = 'inline';
        toggleLeticiaButton.textContent = 'LER MENOS';
    } else {
        moreLeticiaText.style.display = 'none';
        toggleLeticiaButton.textContent = 'LER MAIS';
        moreLeticiaText.innerHTML = " que conheci a Laís, que me mostrou que era possível oferecer um serviço de babás com excelência e carinho. Com isso, criamos uma solução para garantir à sua família não só um cuidado especializado, mas também a redução de custos e riscos, com assessoria jurídica e acompanhamento profissional...";
    }
});

// Resetar o modal sempre que ele for aberto
function resetModal() {
    const moreLaysText = modalOverlay.querySelector('#more-lays');
    const toggleLaysButton = modalOverlay.querySelector('#toggle-lays');
    const moreLeticiaText = modalOverlay.querySelector('#more-leticia');
    const toggleLeticiaButton = modalOverlay.querySelector('#toggle-leticia');

    moreLaysText.style.display = 'none';
    toggleLaysButton.textContent = 'LER MAIS';

    moreLeticiaText.style.display = 'none';
    toggleLeticiaButton.textContent = 'LER MAIS';
}
