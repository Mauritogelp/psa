var receta = new Vue({
    el:"#recetas",
    data:{
        recetas_publicadas: [],
    },
    created:function(){
        this.$http.get("php_core/receta/traer_recetas.php").then(function(respuesta){
            if (typeof(respuesta.body.correcto) != 'undefined'){
                this.recetas_publicadas = respuesta.body.recetas;
            }else if(typeof(respuesta.body.error) != 'undefined'){
                alerta.cuidado(respuesta.body.error);             
            }
        })
    },methods:{
        eliminar_receta:function(id,titulo){
            Swal.fire({
                title: 'Estás seguro de eliminar esto?',
                text: "eliminar: "+titulo,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
              }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('id',id);
                    this.$http.post("php_core/receta/eliminar_receta.php",formData).then(function(respuesta){
                        console.log(respuesta);
                        if (typeof(respuesta.body.correcto) != 'undefined'){
                            this.recetas_publicadas = respuesta.body.recetas;
                            alerta.correcto("se eliminó "+titulo+" con éxito");
                        }else if(typeof(respuesta.body.cuidado) != 'undefined'){
                            this.recetas_publicadas = respuesta.body.recetas;
                            alerta.cuidado(respuesta.body.cuidado);
                        }else if (typeof(respuesta.body.error) != 'undefined'){
                            alerta.error(respuesta.body.error);
                        }
                    })
                    alerta.correcto("se eliminó "+titulo+" exitosamente");
                }else{
                    alerta.correcto("no se eliminó nada");    
                }
              })           
        }
    }
})