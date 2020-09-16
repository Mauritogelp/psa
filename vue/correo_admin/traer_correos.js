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
        eliminar_correo:function(correo){
            Swal.fire({
                title: 'Estás seguro?',
                text: "Estás por eliminar a "+correo,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
            })            
        }
    }

})