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
    },
    methods:{
        eliminar_correo:function(id,correo){
            Swal.fire({
                title: 'Estás seguro?',
                text: "Estás por eliminar a "+correo,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                let formData = new FormData();
                formData.append('id',id);
                this.$http.post("php_core/correo_admin/eliminar_correo.php",formData).then(function(respuesta){
                    console.log(respuesta);
                    if (typeof(respuesta.body.correcto) != 'undefined'){
                        this.todos_correos = respuesta.body.correos;
                        alerta.correcto(respuesta.body.correcto);
                    }
                })
            })
        }
    }
})