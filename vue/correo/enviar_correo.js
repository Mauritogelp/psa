var correoo = new Vue({
    el:"#correo",
    data:{
        nombre:"",
        email:"",
        telefono:"",
        mensaje:"",
    },
    methods:{
        enviar_correo_ahora:function(){
            if (this.nombre != '' && this.email != '' && this.mensaje != ''){
                if (Number.isInteger(parseInt(this.telefono))){
                    let formData = new FormData();
                    formData.append('nombre',this.nombre);
                    formData.append('email',this.email);
                    formData.append('telefono',this.telefono);
                    formData.append('mensaje',this.mensaje);
                    this.$http.post("php_core/correo/agregar_correo.php",formData).then(function(respuesta){
                        console.log(respuesta);
                        if (typeof(respuesta.body.correcto) != 'undefined') {
                            this.nombre = "";
                            this.email = "";
                            this.telefono = "";
                            this.mensaje = "";
                            alerta.correcto(respuesta.body.correcto)
                        }else if(typeof(respuesta.body.error) != 'undefined'){
                            alerta.error(respuesta.body.error);
                        }
                    })
                }else{
                    alerta.error("En teléfono solo se admiten números.");
                }
            }else{
                alerta.error("Nombre, Email y Mensaje son obligatorios.")
            }
        }    
    }
})