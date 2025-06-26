
document.addEventListener('DOMContentLoaded', () => {
    const iglesia = document.getElementById('enlaceIglesia'); 
    const salonActos = document.getElementById('enlaceSalon');
    cambiarUbi(iglesia);
    cambiarUbi(salonActos);
});
const ubicaciones = {
    enlaceIglesia: {
        titulo:'Iglesia',
        texto: 'La ceremonia religiosa tendrá lugar en la <span><a class="eUbi" href="https://www.google.com/maps/place/Parr%C3%B2quia+Sant+Antoni+Abat/@39.2614241,-0.4723047,17z/data=!3m1!4b1!4m6!3m5!1s0xd61adbd845c8705:0x126b819fcba72e67!8m2!3d39.2614241!4d-0.4697298!16s%2Fg%2F1z264kzjr?entry=ttu&g_ep=EgoyMDI1MDYxMS4wIKXMDSoASAFQAw%3D%3D" target="_blank" title="ubicacion iglesia">Parròquia Sant Antoni Abat </a></span>  , situada en la Av. Reis Catòlics, 18, 46230 Alginet, Valencia. Os esperamos a las 17:00 h para compartir este momento tan especial.',
        foto: './imagenes/ubicaciones/iglesiaAlginet.png'
    }, 
    enlaceSalon: {
        titulo:'Salón de la Ceremonia',
        texto: 'Tras la ceremonia, continuaremos la celebración en el <span><a class="eUbi" href="https://www.google.com/maps/place/Restaurante+San+Patricio/@39.2696583,-0.4924257,17z/data=!4m6!3m5!1s0xd61adba9e6680ed:0x9360758debc24850!8m2!3d39.26961!4d-0.489026!16s%2Fg%2F1vlk2x7b?entry=ttu&g_ep=EgoyMDI1MDYxMS4wIKXMDSoASAFQAw%3D%3D" title="Salón Ceremonia" target="_blank"> Salón de Actos San Patricio </a> </span>, en la Urb. San Patricio, 7, 46230 Alginet, Valencia, España.',
        foto: './imagenes/ubicaciones/sanPatricio.jpg'
    }
}
function cambiarUbi(ubicacion){
    ubicacion.addEventListener('click', () => {
        const nombre = ubicacion.id;
        const textUbi = document.getElementById('textoUbi'); 
        const titulo = document.getElementById('titUbicaciones');
        const img = document.getElementById('imgUbi');
        titulo.innerHTML = ubicaciones[nombre].titulo;
        textUbi.innerHTML = ubicaciones[nombre].texto;
        img.src = ubicaciones[nombre].foto;
    });
} 

 const botones = document.querySelectorAll('.btn');
  botones.forEach(boton => {
    boton.addEventListener('click', () => {
      botones.forEach(b => b.classList.remove('selected')); // quitar clase a todos
      boton.classList.add('selected'); // añadir solo al clicado
    });
  });
