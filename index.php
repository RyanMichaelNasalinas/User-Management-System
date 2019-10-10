<?php
include "inc/header.php";

$login->is_loggedin($_SESSION['id'], 'login.php');


if(isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
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
            <?php if ($validation->is_admin($_SESSION['user_type'])) : ?>
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <a href="add_user.php" class="btn btn-primary mb-2">
                            <i class="fa fa-plus text-white" title="Add User"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="table-responsive">
                        <?php if ($validation->is_admin($_SESSION['user_type'])) : ?>
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
                                    <th>User Status</th>
                                    <th colspan="3">Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        //Fetch All User
                                        $result = $database->display_user();

                                        foreach ($result as $res) :
                                        ?>
                                        <tr>
                                            <td><?= $res['id']; ?></td>
                                            <td><?= $res['firstname']; ?></td>
                                            <td><?= $res['lastname']; ?></td>
                                            <td><?= $res['age']; ?></td>
                                            <td><?= $res['gender']; ?></td>
                                            <td><?= $res['username']; ?></td>
                                            <td><?= $res['email']; ?></td>
                                            <td><span class="badge <?= display_badge($res['user_type']); ?>"><?= $res['user_type']; ?></span></td>
                                            <td><span class="badge <?= display_badge($res['user_status']); ?>"><?= $res['user_status'];?></span></td>
                                            <td>
                                                <a href="update_user.php?id=<?= $res['id']; ?>">
                                                    <i class="fa fa-edit text-white" title="Edit User"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="delete_id" value="<?= $res['id']; ?>">
                                                    <button name="delete" onclick="return confirm('Are you sure you want to delete this user')" class="del_btn">
                                                        <i class="fa fa-trash text-danger" title="Delete User"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
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