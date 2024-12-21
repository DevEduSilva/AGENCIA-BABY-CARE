// DEIXAR HEADER TRANSPARENTE OU COR FIXA
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  if (window.scrollY > 50) {
    header.classList.add("translucent");
  } else {
    header.classList.remove("translucent");
  }
});

//ABRIR MENU DROPDOWN
function toggleMenu() {
  const nav = document.querySelector('nav');
  const menuIcon = document.querySelector('.menu-icon');
  nav.classList.toggle('active');
  menuIcon.classList.toggle('active');
}

// VOLTAR AO INÍCIO
function goTohome() {
  const ctaabout = document.querySelector("#inicio");
  window.scrollTo({
    top: ctaabout.offsetTop - 100,
    behavior: "smooth",
  });
}

// USAR ATALHOS
function goToSection(id) {
  const atalho = document.getElementById(id);
  // Calcula a posição da rolagem de forma que o elemento fique 100px acima
  window.scrollTo({

    // usando o get para pegar a distância entre o topo do elemento e o topo da janela
    top: atalho.getBoundingClientRect().top + window.scrollY - 100,
    behavior: "smooth"
  });
}



