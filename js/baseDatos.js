import { validado } from "./validacion.js";
import { validarInputs } from "./validacion.js";
import { numInvitados } from "./validacion.js";
document.addEventListener('DOMContentLoaded', ()=>{
    validarInputs();
    numInvitados();
        const formulario = document.getElementById('formulario');
        formulario.addEventListener('submit', (event)=>{
            //desactivamos el envio del formulario 
            validarInputs();
            event.preventDefault(); 
            if(validado()){
                formulario.submit();               
            }
        });
});

 //<?php ?>
                        
                      