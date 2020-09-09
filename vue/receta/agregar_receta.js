var crear_receta = new Vue({
    el:"#agregar_receta",
    data:{
        imagen:"assets/img/ensalada.jpg",
        imagen_tmp: "",
        titulo:"",
        contenido:"",
    },
    methods:{
        cambiar_imagen:function(event){
            let formData = new FormData();
            formData.append('imagen',event.target.files[0]);
            this.$http.post("php_core/receta/imagen_receta.php",formData).then(function(respuesta){
                console.log(respuesta);
                if (typeof(respuesta.body.correcto) != 'undefined'){
                    this.imagen = respuesta.body.url;
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
                        icon: 'error',
                        title: respuesta.body.error,
                    })
                }
            })
        },
        agregar_receta_ahora:function(){
            if (this.imagen != 'assets/img/ensalada.jpg' && this.titulo != '') {
                //let formData = new FormData();
                //formData.append('')
                //this.$http.post
            }else{
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
                    icon: 'error',
                    title: 'La imagen y título son obligatorios',
                })
            }
        }
    }
})