<?php
include "inc/header.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = $login->login_user($username, $password);

    if ($login) {
        header("location:index.php");
    } elseif (empty($username) && empty($password)) {
        Login::$msg = 'Username and Password should not be empty';
    } elseif (empty($username)) {
        Login::$msg = 'Username is required';
    } elseif (empty($password)) {
        Login::$msg = "Password is required";
    }  else {
        Login::$msg = 'Incorrect Credentials';
    }
}
?>
<div class="library_bg">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto col-md-12 mt-5">
                <div class="card border-info mb-3">
                    <div class="card-header">Log In</div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Input Credentials</h4>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?= (isset($_POST['username']) ? $_POST['username'] : '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login" class="btn btn-success" name="login" id="login">
                            </div>
                        </form>
                        <?php if (isset($_POST['login'])) : ?>
                            <div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
                                <strong><?= Login::$msg; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "inc/footer.php";
?>