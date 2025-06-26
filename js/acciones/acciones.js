document.addEventListener('DOMContentLoaded', ()=>{

 //queremos que cuando el usuario indique que lleva acompañante aparezcon un mensaje de advertencia
 añadirAdvertencia(); 
 añadirAlergenos();
}); 
function añadirAdvertencia(){
    var acompanyante = document.getElementById('acom_si'); 
 acompanyante.addEventListener('click', ()=>{
    if(acompanyante.checked){
        var advertencia = document.getElementById('cubierto'); 
        advertencia.classList.remove('oculto'); 
    }
 });
}
function añadirAlergenos(){
     var alergenos = document.getElementById('alergenoss'); 
    alergenos.addEventListener('change', ()=>{
        var divAlergenos = document.getElementById('alergenos'); 
        if(alergenos.checked){
            //cogemos el padre de alergenos 
            
            divAlergenos.innerHTML = 
            `
             <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Gluten"
                                    id="alergeno1" />
                                <label for="alergeno1" class="inline">Gluten</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Huevos"
                                    id="alergeno3" />
                                <label for="alergeno3" class="inline">Huevos</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Pescado"
                                    id="alergeno4" />
                                <label for="alergeno4" class="inline">Pescado</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Cacahuetes"
                                    id="alergeno5" />
                                <label for="alergeno5" class="inline">Frutos de cáscara</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Soja"
                                    id="alergeno6" />
                                <label for="alergeno6" class="inline">Soja</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Leche"
                                    id="alergeno7" />
                                <label for="alergeno7" class="inline">Leche</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Mostaza"
                                    id="alergeno10" />
                                <label for="alergeno10" class="inline">Mostaza</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Granos de sésamo"
                                    id="alergeno11" />
                                <label for="alergeno11" class="inline">Granos de sésamo</label>
                            </div>
                            <div>
                                <input class="checkbox" type="checkbox" name="alergenos[]" value="Marisco"
                                    id="alergeno14" />
                                <label for="alergeno14" class="inline">Marisco</label>
                            </div>

            `;

        }else {
            divAlergenos.innerHTML = "";
        }
    })

}