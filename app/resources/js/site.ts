// Page entrance animations: reveal `.load` elements as they enter the viewport
window.addEventListener("load", () => {
  const loader = document.getElementById("load-cont");

  const update = () => {
    const windowBottom = window.scrollY + window.innerHeight;

    document.querySelectorAll<HTMLElement>(".load").forEach((element) => {
      const top = element.getBoundingClientRect().top + window.scrollY;

      if (top <= windowBottom) element.classList.remove("load");
    });
  };

  if (loader) {
    setTimeout(() => {
      loader.style.transition = "opacity 0.4s";
      loader.style.opacity = "0";
      setTimeout(() => (loader.style.display = "none"), 400);
      update();
    }, 400);
  } else {
    update();
  }

  window.addEventListener("scroll", update);
  window.addEventListener("resize", update);
});

// Mobile menu: lock the page scroll while the menu is open
document.getElementById("navHm_inp")?.addEventListener("change", () => {
  const menu = document.getElementById("navHm")!;

  document.body.classList.toggle("fixH", menu.offsetParent !== null);
});
