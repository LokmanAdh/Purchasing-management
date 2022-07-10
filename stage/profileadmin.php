<?php
    session_start();
    require_once('include/admin.php');
    require_once('include/user.php');
    require_once('include/fournisseur.php');
    if(!isset($_SESSION['email'])){
        header('location: login.php');
      }else if($_SESSION['role'] != "admin"){
        header('location: 404.html');
      }
      $ad = Admin::getOneid($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="homead.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-archive"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Stock <sup>management</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="homead.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="stocktable.php">
                    <i class="fa fa-archive"></i>
                    <span>Stock</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="usertable.php">
                    <i class="fa fa-users"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="fournisseurtable.php">
                    <i class="fa fa-users"></i>
                    <span>Fournisseurs</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nom']." ".$_SESSION['prenom']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo $_SESSION['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profileadmin.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                    </div>

                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Personal information</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="form-group centerrow">
                                    <div class="imagemargin">
                                    <img class="img-profile rounded-circle" src="<?php echo $_SESSION['image']; ?>" height='150px' width='150px'>
                                    </div>
                                </div>
                                <style>
                                    .centerrow{
                                        display: flex;
                                        justify-content: center;
                                    }
                                    .imagemargin{
                                        margin-bottom: 10px;
                                    }
                                    .inputdisable {
                                        display: block;
                                        width: 100%;
                                        height: calc(1.5em + 0.75rem + 2px);
                                        padding: 0.375rem 0.75rem;
                                        font-size: 1rem;
                                        font-weight: 400;
                                        line-height: 1.5;
                                        color: #6e707e;
                                        background-clip: padding-box;
                                        border: 0;
                                        border-bottom: 1px solid #4e73df;
                                    }
                                    .inputdisable1 {
                                        display: block;
                                        width: 100%;
                                        height: calc(1.5em + 0.75rem + 2px);
                                        padding: 0.375rem 0.75rem;
                                        font-size: 1rem;
                                        font-weight: 400;
                                        line-height: 1.5;
                                        color: #6e707e;
                                        background-clip: padding-box;
                                        border: 0;
                                    }
                                    .inputdisable:disabled{
                                        background-color: white;
                                        opacity: 1;
                                    }
                                    .passwordinput{
                                        display: flex;
                                        border-bottom: 1px solid #4e73df;
                                    }
                                </style>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h6 class='inputtitle'>First Name<h6>
                                        <input type="text" class="inputdisable" id="exampleFirstName"
                                            placeholder="<?php echo $ad->nom;?>"  disabled>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class='inputtitle'>Last Name<h6>
                                        <input type="text" class="inputdisable" id="exampleLastName"
                                            placeholder="<?php echo $ad->prenom;?>"  disabled>
                                    </div>
                                </div>
                                <div class="form-group row">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <h6 class='inputtitle'>Address<h6>
                                        <input type="text" class="inputdisable" id="exampleFirstName"
                                            placeholder="<?php echo $ad->address;?>"  disabled>
                                    </div>
                                    <div class="col-sm-6">
                                    <h6 class='inputtitle'>Email<h6>
                                        <input type="text" class="inputdisable" id="exampleLastName"
                                            placeholder="<?php echo $ad->email;?>"  disabled>
                                    </div>
                                </div>
                                <div class="form-group row">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h6 class='inputtitle'>Phone number<h6>
                                        <input type="text" class="inputdisable" id="exampleFirstName"
                                            placeholder="<?php echo $ad->tele;?>"  disabled>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class='inputtitle'>Password<h6>
                                        <div class ="passwordinput">
                                            <input type="password" class="inputdisable1" id="id_password" placeholder=""  value="<?php echo $ad->password;?>" disabled>
                                            <i class="far fa-eye" id="togglePassword" style="margin-right: 10px;margin-top: 10px; cursor: pointer;"></i>
                                        </div>
                                        <script>
                                            const togglePassword = document.querySelector('#togglePassword');
                                            const password = document.querySelector('#id_password');
                                            
                                            togglePassword.addEventListener('click', function (e) {
                                                // toggle the type attribute
                                                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                                password.setAttribute('type', type);
                                                // toggle the eye slash icon
                                                this.classList.toggle('fa-eye-slash');
                                            });
                                        </script>
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
                        <span>Copyright &copy; Your Website 2021</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="include/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>