 document.addEventListener("DOMContentLoaded", function () {
      const parrafo = document.getElementById("cuentaAtras");
      
      if (!parrafo) return;

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
        console.log(document.getElementById("cuentaAtras"));


      /*Control de pantallas*/
      var fotoCoctel = document.getElementById('fotoCoctel');
      var fotoCoctelTablet = document.getElementById('fotoCoctelTablet');

  const fotos = document.querySelectorAll('.fto');
    let indice = 0;
    let intervaloId;
    function mostrarSiguiente() {
      // Quitar la clase activa de la actual
      fotos[indice].classList.remove('activa');  
      // Calcular la siguiente (con bucle)
      indice = (indice + 1) % fotos.length;
      // Añadir clase 'activa' a la siguiente
      fotos[indice].classList.add('activa');  
    }
    ajustarElementos();
    function ajustarElementos() {
      
      if (window.innerWidth <= 768) {
        fotoCoctel.classList.add('oculto');
        fotoCoctelTablet.classList.remove('oculto');
      } else {
        fotoCoctel.classList.remove('oculto');
        fotoCoctelTablet.classList.add('oculto');
      }
      if (window.innerWidth <= 485) {
        console.log("HolaMundo");
        // Solo iniciar el intervalo si no existe
        if (!intervaloId) {
          intervaloId = setInterval(mostrarSiguiente, 3000);
        }
      } else {
        // Si se agranda la ventana, puedes detener el intervalo si lo deseas
        if (intervaloId) {
          clearInterval(intervaloId);
          intervaloId = null;
        }
      }
    } 
      // Ejecutar al cambiar tamaño
  window.addEventListener('resize', ajustarElementos);

});
  window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;
  document.querySelector('.fondo-fijo').style.backgroundPosition = `center ${scrollY * 0.5}px`;
}); 
document.addEventListener("DOMContentLoaded", () => {
  const faders = document.querySelectorAll('.fade-in');

  const options = {
    threshold: 0.1
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); // para que no se ejecute más veces
      }
    });
  }, options);

  faders.forEach(fader => {
    observer.observe(fader);
  });
});