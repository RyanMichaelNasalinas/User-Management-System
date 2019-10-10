<?php
include "inc/header.php";

if (!$validation->is_admin($_SESSION['user_type'])) {
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
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <a href="index.php" class="btn btn-primary mb-2 mt-2">
                        <i class="fa fa-backward text-white" title="Add User"></i>&nbsp;Back
                    </a>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['update'])) {

            $database->firstname = $database->escape(Validation::helper_uc($_POST['firstname']));
            $database->lastname = $database->escape(Validation::helper_uc($_POST['lastname']));
            $database->age = $database->escape($_POST['age']);
            $database->gender = $database->escape($_POST['gender']);
            $database->username = $database->escape($_POST['username']);
            $database->email = $database->escape($_POST['email']);
            $database->user_type = $database->escape($_POST['user_type']);
            $database->user_status = $database->escape($_POST['user_status']);

            //Message
            $msg = $validation->check_empty($_POST, ['firstname', 'lastname', 'age', 'gender', 'username', 'email', 'user_type','user_status']);
            if ($msg != null) {
                $msg =  '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
                                        <strong>' . $msg . 'should not be empty</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
            } else {
                $database->update_user($_GET['id']);
                $msg_succ = $_SESSION['message']  = '<div class="alert alert-success alert-dismissable fade show text-center" role="alert">
                                        <strong> User has been Updated successfully </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
            }
        }
        ?>
        <?php


        if (isset($_GET['id'])) :
            ?>
            <?php
                $database->escape($id = $_GET['id']);

                $result = $database->query($database->display_userby_id($id));
                while ($row = $result->fetch_assoc()) :
                    ?>
                <div class="container">
                    <div class="text-center">
                        <?= isset($msg_succ) ? $msg_succ : ''; ?>
                        <?= isset($msg) ? $msg : ''; ?>
                    </div>

                    <h1 class="text-center mt-3">Update User</h1>
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" value="<?= (isset($row['firstname']) ? $row['firstname'] : $_POST['firstname']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" value="<?= (isset($row['lastname']) ? $row['lastname'] : $_POST['lastname']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <select name="age" id="age" class="form-control" value="<?= (isset($_POST['age']) ? Validation::helper_he($_POST['age']) : '') ?>">
                                        <option value="">Select Age</option>
                                        <?php for ($i = 18; $i <= 100; $i++) : ?>
                                            <?php if ($i == $row['age']) : ?>
                                                <option value="<?= $row['age']; ?>" selected><?= $row['age']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="gender" value="undefined" class="custom-control-input" <?= $row['gender'] == 'undefined' ? 'checked=""' : ''; ?>>
                                            <label class="custom-control-label" for="customRadio1">Undefined</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="gender" value="Male" class="custom-control-input" <?= $row['gender'] == 'Male' ? 'checked=""' : ''; ?>>
                                            <label class="custom-control-label" for="customRadio2">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="gender" value="Female" class="custom-control-input" <?= $row['gender'] == 'Female' ? 'checked=""' : ''; ?>>
                                            <label class="custom-control-label" for="customRadio3">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= (isset($row['username']) ? $row['username'] : $_POST['username']); ?>" <?= $validation->is_admin($_SESSION['user_type']) ? '' : 'readonly'; ?>>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= (isset($row['email']) ? $row['email'] : $_POST['email']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select name="user_type" id="user_type" class="form-control">
                                        <option value="">Select Value</option>
                                        <option value="user" <?= $row['user_type'] == 'user'  ? 'selected' : ''; ?>>User</option>
                                        <option value="administrator" <?= $row['user_type'] == 'administrator'  ? 'selected' : ''; ?>>Administrator</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="user_status">User Status</label>
                                    <select name="user_status" class='form-control'>
                                        <option value="">Select Value</option>
                                        <option value="approved" <?= $row['user_status'] == 'approved'  ? 'selected' : ''; ?>>Approved</option>
                                        <option value="pending" <?= $row['user_status'] == 'pending'  ? 'selected' : ''; ?>>Pending</option>
                                        <option value="rejected" <?= $row['user_status'] == 'rejeceted'  ? 'selected' : ''; ?>>Rejected</option>
                                    </select>
                                </div>

                            <?php endwhile; ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-success" name="update">
                            <input type="submit" value="Cancel" class="btn btn-danger">
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
<!-- /#wrapper -->
<?php include "inc/footer.php"; ?>