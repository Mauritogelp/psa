var crear_receta = new Vue({
    el:"#agregar_receta",
    data:{
        imagen:"assets/img/defecto/pepe.png",
        id:"",
        titulo:"",
        contenido:"",
        boton:"agregar",
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
                    alerta.error(respuesta.body.error);
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
                        alerta.correcto(titulo_publicar+" <b>se agregó correctamente</b>");
                    }else if(typeof(respuesta.body.error) != 'undefined'){
                        this.imagen = "assets/img/defecto/pepe.png";
                        this.titulo = "";
                        this.contenido = "";
                        alerta.error(respuesta.body.error);
                    }
                })
            }else{
                alerta.error("la imágen y título son obligatorios");           
            }
        },
        cancelar_modificar:function(){
            this.id = null;
            this.imagen = "assets/img/defecto/pepe.png";
            this.titulo = "";
            this.contenido = "";
            this.boton = "agregar";
        },
        realizar_cambio:function(){
            if (this.imagen != 'assets/img/defecto/pepe.png' && this.titulo != ''){
                let formData = new FormData();
                formData.append('id',this.id);
                formData.append('imagen',this.imagen);
                formData.append('titulo',this.titulo);
                formData.append('contenido',this.contenido);
                this.$http.post("php_core/receta/modificar_receta.php",formData).then(function(respuesta){
                    console.log(respuesta);
                    if (typeof(respuesta.body.correcto) != 'undefined'){
                        let titulo_publicar = this.titulo;
                        this.imagen = "assets/img/defecto/pepe.png";
                        this.titulo = "";
                        this.contenido = "";
                        receta.recetas_publicadas = respuesta.body.recetas;
                        alerta.correcto(titulo_publicar+" <b>se modificó correctamente</b>");
                    }else if(typeof(respuesta.body.error) != 'undefined'){
                        this.imagen = "assets/img/defecto/pepe.png";
                        this.titulo = "";
                        this.contenido = "";
                        alerta.error(respuesta.body.error);
                    }
                })
            }else{
                alerta.error("la imágen y título son obligatorios");           
            }
        }
    }
})