import VanillaTilt from "vanilla-tilt";

VanillaTilt.init(document.querySelectorAll<HTMLElement>(".artist-img"), {
  glare: true,
  "max-glare": 0.2,
  perspective: 1800,
  transition: true,
  speed: 1200,
});
