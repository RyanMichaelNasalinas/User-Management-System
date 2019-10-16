<?php
include "inc/header.php";

if (!$validation->is_admin($_SESSION['user_type'])) {
    $validation->redirect('index.php');
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
      
        //Form Validation
        include "inc/registration_validation.php";

        ?>

        <div class="container">

            <h1 class="text-center mt-3">Add New User</h1>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="" method="post" if="form">

                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control <?= !empty($data['firstname_err']) ? 'is-invalid' : '' ?>" placeholder="Firstname" value="<?= (isset($_POST['firstname']) ? Validation::helper_he($_POST['firstname']) : '') ?>">
                            <div class="invalid-feedback text-center"><?=  !empty($data['firstname_err']) ? $data['firstname_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control <?= !empty($data['lastname_err']) ? 'is-invalid' : '' ?>" placeholder="Lastname" value="<?= (isset($_POST['lastname']) ? Validation::helper_he($_POST['lastname']) : '') ?>">
                            <div class="invalid-feedback text-center"><?=  !empty($data['lastname_err']) ? $data['lastname_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="age">Age</label>
                            <select name="age" id="age" class="form-control <?= !empty($data['age_err']) ? 'is-invalid' : '' ?>" value="<?= (isset($_POST['age']) ? Validation::helper_he($_POST['age']) : '') ?>">
                                <option value="">Select Age</option>
                                <?php for ($i = 18; $i <= 100; $i++) : ?>
                                    <?php if ($_POST['age'] == $i) : ?>
                                        <option value="<?= $_POST['age']; ?>" selected><?= $i; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                            <div class="invalid-feedback text-center"><?=  !empty($data['age_err']) ? $data['age_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="sex">Sex</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="gender" value="undefined" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio1">Undefined</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="gender" value="Male" class="custom-control-input" <?= (isset($_POST['gender']) && $_POST['gender'] == "Male" ? 'checked' : '') ?>>
                                    <label class="custom-control-label" for="customRadio2">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="gender" value="Female" class="custom-control-input" <?= (isset($_POST['gender']) && $_POST['gender'] == "Female" ? 'checked' : '') ?>>
                                    <label class="custom-control-label" for="customRadio3">Female</label>
                                </div>
                            </div>
                            <div class="invalid-feedback text-center"><?=  !empty($data['gender_err']) ? $data['gender_err'] : '' ; ?></div>
                        </div>


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control <?= !empty($data['username_err']) ? 'is-invalid' : '' ?>" name="username" id="username" placeholder="Username" value="<?= (isset($_POST['username']) ? Validation::helper_he($_POST['username']) : ''); ?>">
                            <div class="invalid-feedback text-center"><?=  !empty($data['username_err']) ? $data['username_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control <?= !empty($data['password_err']) ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Password" value="<?= (isset($_POST['password']) ? Validation::helper_he($_POST['password']) : ''); ?>">
                            <div class="invalid-feedback text-center"><?=  !empty($data['password_err']) ? $data['password_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control <?= !empty($data['confirm_password_err']) ? 'is-invalid' : '' ?>" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?= (isset($_POST['confirm_password']) ? Validation::helper_he($_POST['confirm_password']) : ''); ?>">
                             <div class="invalid-feedback text-center"><?=  !empty($data['confirm_password_err']) ? $data['confirm_password_err'] : '' ; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?= !empty($data['email_err']) ? 'is-invalid' : '' ?>" name="email" id="email" placeholder="Email" value="<?= (isset($_POST['email']) ? Validation::helper_he($_POST['email']) : ''); ?>">
                            <div class="invalid-feedback text-center"><?=  !empty($data['email_err']) ? $data['email_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select name="user_type" id="user_type" class="form-control <?= !empty($data['user_type_err']) ? 'is-invalid' : '' ?>">
                                <option value="">Select Value</option>
                                <?php if (isset($_POST['user_type']) == 'user' || isset($_POST['user_type']) == 'administrator') : ?>
                                    <option value="user" <?= $_POST['user_type'] == 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="administrator" <?= $_POST['user_type'] == 'administrator' ? 'selected' : '' ?>>Administrator</option>
                                <?php else : ?>
                                    <option value="user">User</option>
                                    <option value="administrator">Administrator</option>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback text-center"><?=  !empty($data['user_type_err']) ? $data['user_type_err'] : '' ; ?></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Create" class="btn btn-success" name="register">
                            <input type="submit" value="Cancel" class="btn btn-danger">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->





<?php include "inc/footer.php"; ?>