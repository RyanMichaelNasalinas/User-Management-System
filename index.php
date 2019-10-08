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

        <!-- Table -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <a href="add_user.php" class="btn btn-primary mb-2">
                        <i class="fa fa-plus text-white" title="Add User"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center text-white">
                            <thead>
                                <th>ID</th>
                                <th>Firstname</th>
                            <th>Lastname</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th colspan="2">Action</th>
                            </thead>
                            <tbody>
                                <?php
                                    //Fetch All User
                                    $result = $database->display_user();

                                    foreach ($result as $res):
                                ?>
                                    <tr>
                                        <td><?= $res['id']; ?></td>
                                        <td><?= $res['firstname']; ?></td>
                                        <td><?= $res['lastname']; ?></td>
                                        <td><?= $res['age']; ?></td>
                                        <td><?= $res['gender']; ?></td>
                                        <td><?= $res['username']; ?></td>
                                        <td><?= $res['email']; ?></td>
                                        <td><span class="badge badge-primary"><?= $res['user_type']; ?></span></td>
                                        <td>
                                            <a href="update_user.php?edit&id=<?= $res['id']; ?>">
                                                <i class="fa fa-edit text-white" title="Edit User"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="index.php?delete&id=<?= $res['id']; ?>" onclick="return confirm('Are you sure you want to delete this data')">
                                                <i class="fa fa-trash text-danger" title="Delete User"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- //Table -->
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->




<?php include "inc/footer.php"; ?>