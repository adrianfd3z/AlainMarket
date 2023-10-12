function modificarUsuario(){
    if(document.getElementById('nombreMod').value.length>0){
        if((!isNaN(document.getElementById('nombreMod').value))){ //Comprueba si el campo es vacio o contiene numeros ()
            alert("El campo nombre esta vacio o contiene un numero");
            return false;
        }
    }
    if(document.getElementById('fechaMod').value.length>0){ 
                if(!(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(document.getElementById('fechaMod').value))){ //https://foroayuda.es/php-regex-para-verificar-la-fecha-esta-en-formato-aaaa-mm-dd/
                    alert("La fecha introducida no sigue el patron: aaaa-mm-dd");
                    return false;
                }
            }       
     if(document.getElementById('telefonoMod').value.length>0){
          if(document.getElementById('telefonoMod').value.length !=9){
            alert("El numero debe ser de 9 digitos!");
            return false;
          }
        }  
    if(document.getElementById('emailMod').value.length>0){
        if(!(/^[a-zA-Z]+([\.]?[a-zA-Z0-9_-]+)*@[a-z0-9]+([\.-]+[a-z0-9]+)*\.[a-z]{2,4}$/.test(document.getElementById('emailMod').value))){ //https://es.stackoverflow.com/questions/142/validar-un-email-en-javascript-que-acepte-todos-los-caracteres-latinos
            alert("El email introducido no es correcto");
            return false;   
        }
    }    

    if(document.getElementById('dniMod').value.length>0){
        if(/^\d{8}[a-zA-Z]$/.test(document.getElementById('dniMod').value)) {
            var n = document.getElementById('dniMod').value.substr(0,8);
            var c = document.getElementById('dniMod').value.substr(8,1);
            if(!(c.toUpperCase() == 'TRWAGMYFPDXBNJZSQVHLCKET'.charAt(n%23))){
                alert('DNI erroneo');
                return false;
            }
            }else{
                alert('DNI erroneo');
                return false;
        
            }
        }
}

