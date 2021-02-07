<?php
include '../../config/koneksi.php';
session_start();
$email = $_SESSION['email'];
$query = mysqli_query($koneksi, "SELECT id,email,nama,role FROM user WHERE email = '$email'");
$user_info = mysqli_fetch_assoc($query);
if (!isset($email)) {
    header('login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - Let's Explore Jawa Timur</title>
    <!-- Custom fonts for this template-->
    <link href="/assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../../layouts/sidebar.php' ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Navbar -->
                <?php include '../../layouts/navbar.php' ?>
                <!-- End of Navbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    $page = @$_GET['page'];
                    $act = @$_GET['act'];
                    $route = 'dashboard.php';
                    $title = 'Dashboard';
                    if ($page == '') {
                        $title = 'Dashboard';
                        $route = 'dashboard.php';
                    } elseif ($page == 'artikel') {
                        if ($act == '') {
                            $title = 'Daftar Artikel';
                            $route = 'artikel/index.php';
                        } elseif ($act == 'tambah') {
                            $title = 'Tambah Artikel';
                            $route = 'artikel/tambah.php';
                        } elseif ($act == 'ubah') {
                            $title = 'Ubah Artikel';
                            $route = 'artikel/ubah.php';
                        } elseif ($act == 'hapus') {
                            $title = 'Hapus Artikel';
                            $route = 'artikel/hapus.php';
                        }
                    } elseif ($page == 'users') {
                        if ($act == '') {
                            $title = 'Daftar User';
                            $route = 'users/index.php';
                        } elseif ($act == 'tambah') {
                            $title = 'Tambah User';
                            $route = 'users/tambah.php';
                        } elseif ($act == 'ubah') {
                            $title = 'Ubah User';
                            $route = 'users/ubah.php';
                        } elseif ($act == 'hapus') {
                            $title = 'Hapus User';
                            $route = 'users/hapus.php';
                        }
                    } else {
                        $route = '404.php';
                        $title = '404 Not Found';
                    }
                    include $route;
                    echo "<script>document.title='$title - Let\'s Explore Jawa Timur'</script>"
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php include '../../layouts/footer.php' ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="/assets/sbadmin2/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/assets/sbadmin2/js/sb-admin-2.min.js"></script>
    <script>
        function deleteArtikel(type, id) {
            $("#deleteModal").modal("show");
            let btn = document.querySelector('#btnDelete');
            btn.href = `?page=${type}&act=hapus&id=${id}`
        }
    </script>
</body>

</html>