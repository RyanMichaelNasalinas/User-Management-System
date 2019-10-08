<?php include "inc/header.php"; ?>

<?php 

    if(!isset($_GET['edit']) && !isset($_GET['id'])) {
        header("Location: index.php");
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
            $database->user_type = $database->escape('user');

            //Message
            $msg = $validation->check_empty($_POST, ['firstname', 'lastname', 'age', 'gender', 'username', 'email']);
            if ($msg != null) {
                echo "<div class='alert alert-danger text-left w-25 mt-5 mx-auto'>" . $msg . "</div>";
            } else {
                $database->update_user($_GET['id']);
                header('location: update_user.php?edit&id=' . $_GET['id']);
            }
        }
        ?>
        <?php if (isset($_GET['edit'])) : ?>
            <?php
                $database->escape($id = $_GET['id']);

                $result = $database->query($database->display_userby_id($id));
                while ($row = $result->fetch_assoc()) :

            ?>
                <div class="container">
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
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= (isset($row['username']) ? $row['username'] : $_POST['username']); ?>" readonly>
                                </div>

                                <div class=" form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= (isset($row['email']) ? $row['email'] : $_POST['email']); ?>">
                                </div>

                            <?php endwhile; ?>
                <?php else: ?>
                        <?php header("location:index.php"); ?>
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