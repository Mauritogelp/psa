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
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'warning',
                    title: respuesta.body.error,
                })                 
            }

        })
    }
})