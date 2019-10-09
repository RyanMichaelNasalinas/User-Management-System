<?php include "inc/header.php"; ?>

<?php
    $login->is_loggedin($_SESSION['id'],'login.php');
        
    if (isset($_GET['delete'])) {
        $id = $_GET['id'];
        $database->delete_user($id);
        header("location:index.php");
    }
?>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <?php include "inc/sidenav.php"; ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <!-- Navbar -->
            <?php include "inc/navbar.php"; ?>
        <!-- /Navbar -->

       
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->




<?php include "inc/footer.php"; ?>