var crear_receta = new Vue({
    el:"#agregar_receta",
    data:{
        imagen:"assets/img/defecto/pepe.png",
        titulo:"",
        contenido:"",
    },
    methods:{
        cambiar_imagen:function(event){
            let formData = new FormData();
            formData.append('imagen',event.target.files[0]);
            this.$http.post("php_core/receta/imagen_receta.php",formData).then(function(respuesta){
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
            if (this.imagen != 'assets/img/defecto/pepe.png' && this.titulo != ''){
                let formData = new FormData();
                formData.append('imagen_ubicacion',this.imagen);
                formData.append('titulo',this.titulo);
                formData.append('contenido',this.contenido);
                this.$http.post("php_core/receta/agregar_receta.php",formData).then(function(respuesta){
                    if (typeof(respuesta.body.correcto) != 'undefined'){
                        let titulo_publicar = this.titulo;
                        this.imagen = "assets/img/defecto/pepe.png";
                        this.titulo = "";
                        this.contenido = "";
                        receta.recetas_publicadas = respuesta.body.recetas;
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
                            icon: 'success',
                            title: titulo_publicar+" <b>se agregó correctamente</b>",
                        })  
                    }else if(typeof(respuesta.body.error) != 'undefined'){
                        this.imagen = "assets/img/defecto/pepe.png";
                        this.titulo = "";
                        this.contenido = "";
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
                    title: 'La imagen y título sin obligatorios',
                })            
            }
        }
    }
})