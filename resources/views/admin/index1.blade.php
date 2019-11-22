<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrador</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.php -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php">
            <img src="../assets/images/logo.svg" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="index.php">
            <img src="../assets/images/logo-mini.svg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">Ajuda : +258 849229751</li>
            <li class="nav-item dropdown language-dropdown">

                <div class="d-inline-flex mr-0 mr-md-3">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-mz"></i>
                  </div>
                </div>

            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count">7</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left">Você tem xxxx mensages não lidas </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Mónica Olga</p>
                    <p class="font-weight-light small-text"> buscar da DB </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Salmento Chiltango</p>
                    <p class="font-weight-light small-text"> buscar da DB </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Delfim Uqueio </p>
                    <p class="font-weight-light small-text"> buscar da DB </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">

                @foreach ($users as $user )
                    <p class="mb-1 mt-3 font-weight-semibold">{{$user->nome}} &nbsp; {{ $user->apelido}}</p>
                    <p class="font-weight-light text-muted mb-0">{{$user->email}}</p>
                @endforeach

                </div>
                <a class="dropdown-item">Meu Perfil <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a class="dropdown-item">Mensagens<i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a class="dropdown-item">Actividades<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a>
                <a class="dropdown-item" href="login.php">Sair<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.php -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                @foreach ($users as $user )
                    <p class="profile-name">{{$user->nome}} &nbsp; {{ $user->apelido}}</p>
                    <p class="designation">Administrador</p>
                @endforeach
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Menu Principal</li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="inicio">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Inicio</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="showAluno" id="listar">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Alunos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Inscrição</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="#" id="preinscricao">Pré-Inscrição</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" id="inscricao">Inscrição</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="estatistica">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Estatísticas</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#" id="turmas">
                <i class="menu-icon typcn typcn-th-large-outline"></i>
                <span class="menu-title">Turmas</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="pagamentos">
                <i class="menu-icon typcn typcn-bell"></i>
                <span class="menu-title">Pagamentos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="eventos">
                <i class="menu-icon typcn typcn-user-outline"></i>
                <span class="menu-title">Eventos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="relatorios">
                <i class="menu-icon typcn typcn-user-outline"></i>
                <span class="menu-title">Relatorios</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../assets/js/shared/off-canvas.js"></script>
    <script src="../assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
      <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#estatistica").click(function(){
          $(".main-panel").load("estatistica.php");
        });
        $("#inscricao").click(function(){
          $(".main-panel").load("../formularios/formulario.blade.php");
        });
        $("#turmas").click(function(){
          $(".main-panel").load("turmas.php");
        });
        $("#pagamentos").click(function(){
          $(".main-panel").load("pagamentos.php");
        });
        $("#eventos").click(function(){
          $(".main-panel").load("eventos.php");
        });
        $("#listar").click(function(){
          $(".main-panel").load("listarAlunos");
        });
        $("#relatorios").click(function(){
          $(".main-panel").load("relatorios.php");
        });
      });
    </script>
  </body>
</html>
