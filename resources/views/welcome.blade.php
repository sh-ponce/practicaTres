<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Practica3</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- import CSS -->
        <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

  <!-- Styles -->
  <style>
      .contenedor{
          width: 95%;
          max-width: 120rem;

      }
  </style>
      
     
    </head>


    <div class="contenedor" id="App">
           <el-button @click="visible = true" type="primary" style="margin:30px">Registrar</el-button>
                <el-dialog :visible.sync="visible" title=Registro>
                      <span class="demo-input-label">Nombre:</span>
                           <el-input placeholder="Escribe tu nombre" v-model="usuario.nombre"></el-input> <br><br>
                      <span class="demo-input-label">Apellido:</span>
                           <el-input placeholder="Escribe tu Apellido" v-model="usuario.apellido"></el-input> <br><br>
                      <span class="demo-input-label">Edad:</span>
                           <el-input placeholder="Escribe tu Edad" type="number" v-model="usuario.edad"></el-input> <br><br>
                      <span class="demo-input-label" type="tel">Teléfono:</span>
                           <el-input placeholder="Escribe tu numero de teléfono" v-model="usuario.telefono"></el-input> 
                                     
                               <el-button style="margin-top:1em" round @click="registrarUsuario"  type="success">Guardar</el-button>
                </el-dialog>   
                
                
                <el-table
                :data="relaciones"
                border
                style="width: 100%">

                    <el-table-column   
                    prop="nombre"                               
                    label="Nombre">
                    </el-table-column>

                    <el-table-column
                    prop="apellido"
                    label="Apellido">
                    </el-table-column>

                    <el-table-column
                        prop="edad"
                        label="Edad">
                    </el-table-column>

                    <el-table-column
                        prop="telefono"
                        label="Teléfono">
                    </el-table-column>

                     <el-table-column
                        label="Acción">
                        <template slot-scope="object">
                           <el-button
                            size="mini"
                            type="warning"
                            @click="editarUsuario(object.row.id)">Editar</el-button>
                            <el-button
                            size="mini"
                            type="danger"
                            @click="eliminarUsuario(object.row.id)">Eliminar</el-button>
                        </template>
                    </el-table-column>
                            
                </el-table> 
     </div>

       
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script>
        var vue = new Vue({
            el: '#App',
            data: {
                    visible: false,
                    usuario:{
                        nombre: null,
                        apellido: null,
                        edad: null,
                        telefono: null,
                    },
                    relaciones:[]
            },
            mounted() {
                this.obtenerRegistros();

                
            },
            methods: {
                registrarUsuario() {
                    $.post(
                        'registrarUsuario',
                        {
                            'usuario': this.usuario
                        }
                    ).done(res=>{
                        console.log('la respuesta es: ', res);
                        if(res == 1){
                            this.$message({
                                message: 'Usuario registrado exitosamente',
                                type:'success'

                            });
                            this.obtenerRegistros();
                        } else {
                            this.$message.error('No se puede registrar');
                        }
                      
                    });                    
                },
                obtenerRegistros(){
                    $.get('obtenerRegistros')
                    .done(res=>{
                        this.relaciones = res;
                        
                    });
                },
                eliminarUsuario(usuario_id)
                 {
                    $.get( 'eliminarUsuario/' + usuario_id
                    ).done(response => {
                        if(response){
                            this.$message({
                                showClose: true,
                                message: 'Usuario eliminado.',
                                type: 'warning'
                            });
                            this.obtenerRegistros();
                        }
                    });
                },
                editarUsuario(usuario_id)
                {   
                    $.get( 'editarUsuario'/ + usuario_id
                    ).done(res=>{
                        this.usuario = res;
                        console.log('usuario editado', this.usuario);
                        this.visible = true;

                    });
                },
                pasandoUsuario()
                {
                    if(this.usuario.id != null)
                    {
                        $.post('editarUsuario')
                    }
                }
                
            },
            delimiters: ['${','}']
        });
            

    </script>


    </body>
</html>
 