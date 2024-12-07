function goTohome() {
  const ctaabout = document.querySelector("#inicio");
  window.scrollTo({
    top: ctaabout.offsetTop - 100,
    behavior: "smooth",
  });
}

