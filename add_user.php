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
$errors = [];
        if (isset($_POST['register'])) {
   
            
        
            $database->firstname = $database->escape(Validation::helper_uc($_POST['firstname']));
            $database->lastname = $database->escape(Validation::helper_uc($_POST['lastname']));
            $database->age = $database->escape($_POST['age']);
            $database->gender = $database->escape($_POST['gender']);
            $database->username = $database->escape($_POST['username']);
            $database->password = $database->escape(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $database->email = $database->escape($_POST['email']);
            $database->user_type = $database->escape($_POST['user_type']);
            $database->user_status = $database->escape('pending');



            $msg = $validation->check_empty(
                $_POST,
                ['firstname', 'lastname', 'age', 'gender', 'username', 'password', 'confirm_password', 'email', 'user_type']
            );




            if ($msg != null) {
            $errors[] =  '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
                            <strong>' . $msg . 'should not be empty</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
            } elseif($validation->check_username($_POST['username'])) {
                    $errors[]  = '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
                                                <strong> Username is already taken </strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
            } elseif($validation->check_email($_POST['email'])) {
                $errors[] = '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
                                                <strong> Email is already taken </strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
            } elseif($validation->compare_password($_POST['password'],$_POST['confirm_password'])) {
                    $errors[] = '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
                                                            <strong> Password is not matched </strong>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>';
            } else {

                    $database->add_user();
                        $errors[]    = '<div class="alert alert-success alert-dismissable fade show text-center" role="alert">
                                    <strong> User has been added successfully </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';

                    unset($_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['age'],
                    $_POST['gender'],
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['confirm_password'],
                    $_POST['email'],
                    $_POST['user_type']);
                
                }
    
            }
        ?>

        <div class="container">
            <div class="text-center">
                <?php foreach($errors as $error):?>
                    <?php echo $error; ?>
                <?php endforeach; ?>
            </div>

            <h1 class="text-center mt-3">Add New User</h1>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="" method="post" if="form">

                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" value="<?= (isset($_POST['firstname']) ? Validation::helper_he($_POST['firstname']) : '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" value="<?= (isset($_POST['lastname']) ? Validation::helper_he($_POST['lastname']) : '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="age">Age</label>
                            <select name="age" id="age" class="form-control" value="<?= (isset($_POST['age']) ? Validation::helper_he($_POST['age']) : '') ?>">
                                <option value="">Select Age</option>
                                <?php for ($i = 18; $i <= 100; $i++) : ?>
                                    <?php if ($_POST['age'] == $i) : ?>
                                        <option value="<?= $_POST['age']; ?>" selected><?= $i; ?></option>
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
                        </div>


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= (isset($_POST['username']) ? Validation::helper_he($_POST['username']) : ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?= (isset($_POST['password']) ? Validation::helper_he($_POST['password']) : ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?= (isset($_POST['confirm_password']) ? Validation::helper_he($_POST['confirm_password']) : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= (isset($_POST['email']) ? Validation::helper_he($_POST['email']) : ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select name="user_type" id="user_type" class="form-control">
                                <option value="">Select Value</option>
                                <?php if (isset($_POST['user_type']) == 'user' || isset($_POST['user_type']) == 'administrator') : ?>
                                    <option value="user" <?= $_POST['user_type'] == 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="administrator" <?= $_POST['user_type'] == 'administrator' ? 'selected' : '' ?>>Administrator</option>
                                <?php else : ?>
                                    <option value="user">User</option>
                                    <option value="administrator">Administrator</option>
                                <?php endif; ?>
                            </select>
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