function redondear(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}

function recorrertb(idtb){

    var cont=1;
        $("#"+idtb+" tbody tr").each(function (index)
        {

            $(this).children("td").each(function (index2)
            {
               //alert(index+'-'+index2);

               if(index2==0){
                  $(this).text(cont);
                  cont++;
               }


            })

        })
  }

  function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'JPG': case 'GIF': case 'PNG': case 'JPEG': case 'jpe': case 'JPE':
            return true;
        break;
        default:
            return false;
        break;
    }
}

function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return ((key >= 48 && key <= 57) || (key==8) || (key==35) || (key==34) || (key==46));
}

 function soloNumerosConDecimales(e, input) {
    var key = window.Event ? e.which : e.keyCode;
    var valorActual = input.value;
    var yaTieneDecimal = valorActual.includes('.');
  
    // Permitir teclas de control
    if (key == 8 || key == 35 || key == 36 || key == 46 && !e.target.selectionStart === e.target.selectionEnd) {
      return true;
    }
  
    // Solo permitir un punto decimal
    if (key == 46) {
      if (yaTieneDecimal) {
        return false;
      }
      return true;
    }
  
    // Permitir números
    if (key >= 48 && key <= 57) {
      if (yaTieneDecimal) {
        // Comprobar la posición del punto decimal
        var posicionDecimal = valorActual.indexOf('.');
        var longitudDecimal = valorActual.length - posicionDecimal - 1;
  
        // Si ya hay dos dígitos después del punto, no permitir más
        if (longitudDecimal >= 2) {
          return false;
        }
      }
      return true;
    }
  
    // Bloquear cualquier otra entrada
    return false;
  } 

  function soloNumerosConDecimalesReg(e, input) {
    
    var key = e.which || e.keyCode;
    var char = String.fromCharCode(key);
    var valorActual = input.value;
    var cursorPos = input.selectionStart;
    var valorFuturo = valorActual.slice(0, cursorPos) + char + valorActual.slice(cursorPos);

    // Permitir teclas de control siempre (backspace, delete, etc.)
    var esTeclaDeControl = key === 8 || key === 37 || key === 39;
    if (esTeclaDeControl) {
        return true;
    }

    // Permitir solo números y un solo punto decimal
    if (!/[0-9.]/.test(char)) {
        return false;
    }

    // Verificar si el valor futuro tiene más de un punto decimal
    
    var tieneMasDeUnPunto = valorFuturo.split('.').length > 3;

    // Patrón para permitir solo números con hasta dos decimales
    var pattern = /^\d*(\.\d{0,2})?$/;

    // Si el valor futuro no coincide con el patrón o tiene más de un punto, impedir la entrada
    if (!pattern.test(valorFuturo) || tieneMasDeUnPunto) {
        return false;
    }

    return true;
}

function soloNumerosConDecimalesDirective(input) {
    var valor = input.value;

    // Verificar si hay más de un punto decimal
    var tieneMasDeUnPunto = valor.split('.').length > 2;

    // Patrón para permitir solo números con hasta dos decimales
    var pattern = /^\d+(\.\d{0,2})?$/;

    // Si el valor no coincide con el patrón o tiene más de un punto, corrige el valor
    if (!pattern.test(valor) || tieneMasDeUnPunto) {
        input.value = valor
            .replace(/[^\d.]/g, '')          // Elimina caracteres que no son dígitos o puntos
            .replace(/^(\d*\.\d{0,2}).*$/, '$1') // Permite solo hasta dos decimales
            .replace(/^(\d*\.\d{0,2})\..*$/, '$1'); // Elimina puntos adicionales
    }
}

function noEscribe(e){
  var key = window.Event ? e.which : e.keyCode
  return (key==null);
}

function EscribeLetras(e,ele){
  var text=$(ele).val();
  text=text.toUpperCase();
   var pos=posicionCursor(ele);
  $(ele).val(text);

  ponCursorEnPos(pos,ele);
}


function ponCursorEnPos(pos,laCaja){  
    if(typeof document.selection != 'undefined' && document.selection){        //método IE 
        var tex=laCaja.value; 
        laCaja.value='';  
        laCaja.focus(); 
        var str = document.selection.createRange();  
        laCaja.value=tex; 
        str.move("character", pos);  
        str.moveEnd("character", 0);  
        str.select(); 
    } 
    else if(typeof laCaja.selectionStart != 'undefined'){                    //método estándar 
        laCaja.setSelectionRange(pos,pos);  
        //forzar_focus();            //debería ser focus(), pero nos salta el evento y no queremos 
    } 
}  

function posicionCursor(element)
{
       var tb = element;
        var cursor = -1;

        // IE
        if (document.selection && (document.selection != 'undefined'))
        {
            var _range = document.selection.createRange();
            var contador = 0;
            while (_range.move('character', -1))
                contador++;
            cursor = contador;
        }
       // FF
        else if (tb.selectionStart >= 0)
            cursor = tb.selectionStart;

       return cursor;
}

function pad (n, length) {
    var  n = n.toString();
    while(n.length < length)
         n = "0" + n;
    return n;
}