<?php

    session_start();
    if (!isset($_SESSION['id'])){
        setcookie("error","No tenés permiso para acceder a esta sección",time()+1,"/");
        header("Location:index.php");
    }

?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>administración</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Green Guial</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Recetas</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="admin_correo.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Correos</span></a>
      </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="php_core/cerrar_sesion.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Cerrar sesión</span>
                <img class="img-profile rounded-circle" src="assets/img/logo.svg">
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-6" id="agregar_receta">
              <h4 class="col-12 text-center">Crear recetas</h4>
              <div class="card" style="width:100%">
                <div style="text-align:center">
                  <input style="visibility:hidden;position:absolute" type="file" id="imagen" @change="cambiar_imagen">
                  <label for="imagen">
                    <img class="card-img-top" :src="imagen" alt="Card image cap">
                  </label>
                </div>
                <div class="card-body">
                  <div class="card-title">
                    <input v-model="titulo" class="form-control text-center" type="text" placeholder="titulo">
                  </div>
                  <div>
                    <textarea v-model="contenido" class="form-control" placeholder="contenido"></textarea>
                  </div>
                  <br>
                  <div v-if="boton == 'agregar'">
                    <button @click="agregar_receta_ahora" class="btn btn-success col-12">agregar</button>
                  </div>
                  <div class="row" v-if="boton == 'modificar'">
                    <input type="hidden" v-model="id">
                    <button @click="realizar_cambio" class="btn btn-success col-6">realizar cambio</button>
                    <button @click="cancelar_modificar" class="btn btn-danger col-6">cancelar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6" id="recetas">
              <h4 class="col-12 text-center">Recetas</h4>
              <div class="row">
                <div v-for="r in recetas_publicadas" class="col-6">
                  <div class="card" style="width:100%">
                    <img class="card-img-top" :src="r.imagen" alt="Card image cap" style="height:150px">
                    <div class="card-body">
                      <h5 class="card-title text-truncate">{{r.titulo}}</h5>
                      <pre class="card-text text-truncate">{{r.contenido}}</pre>
                      <div class="row">
                        <button @click="eliminar_receta(r.id,r.titulo)" class="btn btn-danger col-6">eliminar</button>
                        <button @click="modificar_receta(r.id,r.imagen,r.titulo,r.contenido)" class="btn btn-warning col-6">modificar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- sweet alert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Vue cdn -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <!--alertas-->
  <script src="vue/alertas/alertas.js"></script>
  <!--vue recetas-->
  <script src="vue/receta/agregar_receta.js"></script>
  <script src="vue/receta/recetas.js"></script>

</body>

</html>
