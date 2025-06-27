
document.addEventListener("DOMContentLoaded", () => {
  // Cuenta atrás
  const parrafo = document.getElementById("cuentaAtras");
  if (parrafo) {
    const fechaBoda = new Date('2025-09-12T17:00:00').getTime();

    function actualizarCuenta() {
      const ahora = Date.now();
      const diferencia = fechaBoda - ahora;

      if (diferencia < 0) {
        parrafo.innerHTML = "¡Ya llegó el gran día!";
        clearInterval(intervalo);
        return;
      }

      const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
      const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
      const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

      parrafo.innerHTML = `${dias} días, ${horas}h ${minutos}m ${segundos}s`;
    }

    actualizarCuenta();
    const intervalo = setInterval(actualizarCuenta, 1000);
  }

  // Galería de fotos móvil
  const fotos = document.querySelectorAll('.fto');
  let indice = 0;
  let intervaloId;

  function mostrarSiguiente() {
    if (fotos.length > 0) {
      fotos[indice].classList.remove('activa');
      indice = (indice + 1) % fotos.length;
      fotos[indice].classList.add('activa');
    }
  }

  // Ajuste de visibilidad según tamaño de pantalla
  function ajustarElementos() {
    const fotoCoctel = document.getElementById('fotoCoctel');
    const fotoCoctelTablet = document.getElementById('fotoCoctelTablet');

    if (fotoCoctel && fotoCoctelTablet) {
      if (window.innerWidth <= 768) {
        fotoCoctel.classList.add('oculto');
        fotoCoctelTablet.classList.remove('oculto');
      } else {
        fotoCoctel.classList.remove('oculto');
        fotoCoctelTablet.classList.add('oculto');
      }
    }

    if (window.innerWidth <= 485) {
      console.log("Vista móvil activa:", window.innerWidth);
      if (!intervaloId) {
        intervaloId = setInterval(mostrarSiguiente, 4000);
      }
    } else {
      if (intervaloId) {
        clearInterval(intervaloId);
        intervaloId = null;
      }
    }
  }

  ajustarElementos(); // Ejecutar al inicio
  window.addEventListener('resize', ajustarElementos);

  // Fade-in con IntersectionObserver
  const faders = document.querySelectorAll('.fade-in');
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  faders.forEach(fader => observer.observe(fader));
});

// Efecto de fondo parallax
window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;
  const fondo = document.querySelector('.fondo-fijo');
  if (fondo) {
    fondo.style.backgroundPosition = `center ${scrollY * 0.5}px`;
  }
});

// Prueba de depuración para móviles reales
window.addEventListener('load', () => {
  console.log("Anchura real:", window.innerWidth);
});
