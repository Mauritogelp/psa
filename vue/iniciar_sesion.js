var ingresar = new Vue({
    el:"#login",
    data:{
        usuario:"",
        clave:"",
    },
    methods:{
        iniciar_sesion:function(){
            let formData = new FormData();
            formData.append('usuario',this.usuario);
            formData.append('clave',this.clave);
            this.$http.post("php_core/iniciar_sesion.php",formData).then(function(respuesta){
                if (typeof(respuesta.body.correcto) != 'undefined') {
                    window.location.replace(respuesta.body.correcto);
                }else if (typeof(respuesta.body.error) != 'undefined'){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                      
                    Toast.fire({
                        icon: 'error',
                        title: respuesta.body.error,
                    })
                }
            }, respuesta=>{
                alert("500");
            })
        }
    }
})