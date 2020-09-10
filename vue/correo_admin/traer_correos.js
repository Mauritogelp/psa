var correo = new Vue({
    el:"#correos",
    data:{
        todos_correos:[],
    },
    created:function(){
        this.$http.get("php_core/correo_admin/traer_correos.php").then(function(respuesta){
            console.log(respuesta);
            if(typeof(respuesta.body.cuidado) != 'undefined'){
                alerta.cuidado(respuesta.body.cuidado);
            }else if(typeof(respuesta.body.correcto) != 'undefined'){
                this.todos_correos = respuesta.body.correos;
            }
        })
    }

})