//validación del formulario 
//cuando el documento haya cargado 
 let val = {
        nombre:false,
        apellidos:false,
        telefono:false
    };
const restricciones ={
        nombre: {
            codigo:/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-]{2,50}$/,
            mensaje:"*Este campo solo puede contener letras y tiene que tener entre 2 y 15 carácteres"
        },
        apellidos:{
            codigo:/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-]{2,50}$/,
            mensaje:"*Este campo solo puede contener letras y tiene que tener entre 2 y 40 carácteres"
        },
        telefono:{
            codigo:/^(?:\+34|0034)?[ -]?[679]\d{2}(?:[ -]?\d{3}){2}$/,
            mensaje:"*Formato incorrecto, sólo puede contener números"
        }
    };
 export function validarInputs() {
    Object.keys(restricciones).forEach((clave) => {
        const input = document.querySelector(`input[name="${clave}"]`);

        input.addEventListener('blur', () => {
            if (input.value == null || input.value.trim() === '') {
                val[clave] = false;
                setError(input, "*Este campo no puede estar vacío");
            } else if (!restricciones[clave].codigo.test(input.value)) {
                val[clave] = false;
                setError(input, restricciones[clave].mensaje);
            } else {
                val[clave] = true;
                setSuccess(input);
            }
        });
    });
}
    function setError(input, mensaje){
        const padre = input.parentElement; 
        const small = padre.querySelector("small"); 
        if(small) small.innerText = mensaje;
        padre.classList.remove("formSucces");
        padre.classList.add("formError");
    }
    function setSuccess(input){
        const padre = input.parentElement; 
        padre.classList.remove("formError");
        padre.classList.add("formSucces");
    }
     function controladorErrores(clave){
        var input = document.querySelector(`input[name="${clave}"]`); 
        if(input){
            if(input.value == null || input.value == ""){
                setError(input, "* Este campo no puede estar vacío");
            }else if (!restricciones[clave].codigo.test(input.value)) {
                val[clave] = false;
                setError(input, restricciones[clave].mensaje);
            } else {
                val[clave] = true;
                setSuccess(input);
            }
        }
    }
    
   export function numInvitados(){
        var numInvitados = document.getElementById('numInvitados');
        if(numInvitados.value.trim() === ""){
            numInvitados.value = 0;
        }
    }

   function comprobamosChecked() {
    var acompanyante = document.querySelectorAll('input[name="acompanyante"]');
    return Array.from(acompanyante).some(radio=> radio.checked);
    }
    controlarChecked();
    function controlarChecked (){
        var acompanyante = document.querySelectorAll('input[name="acompanyante"]');
        acompanyante.forEach(input=>{
            input.addEventListener('change', ()=>{
                 if(comprobamosChecked()){
                    setSuccess(input);
                }else{
                    setError(input, '*Selecciona una opción.'); 
                }
            });
        });
    }


 export function validado (){
        var validado = true; 
        //comprobamos que todos los campos hayan sido validados 
        Object.keys(val).forEach(clave=>{
            if(!val[clave]){
                controladorErrores(clave);
                validado = false;
            }
        });
         if(!comprobamosChecked()){
                 validado = false;
            }  
        
           
        return validado;
    }