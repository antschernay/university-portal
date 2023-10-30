<?php include_once '_partials/header.php';
    if (isset($_SESSION["userid"])) {
        header("Location: home.php");
        exit();
    }
?>

<section class='d-flex justify-content-center extra-margin-top'>
    <form class='card' action='login.php' method='post'>        
        <div class='login-form'>
            <h2>Sign In</h2>
            <?php
                //login error handlers
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'emptyinput') {
                        echo '<p class="text-danger small">Fill in all fields</p>';
                    }
                    else if ($_GET['error'] == 'wronglogin') {
                        echo '<p class="text-danger small">User ID and password do not match</p>';
                    }
                    else if ($_GET['error'] == 'stmtfailed') {
                        echo '<p class="text-danger small">Something went wrong</p>';
                    }
                }
            ?>
            <div class="form-group my-4">
                <label for="user_id">User ID</label>
                <input type="text" class="form-control p-2" name="user_id">            
            </div>
            <div class="form-group my-4">
                <label for="user_password">Password</label>
                <input type="password" class="form-control p-2" name="user_password">
            </div>
            <button type="submit" name="submit" class="btn btn-secondary mt-4">Sign In</button>
        </div>        
    </form>
</section>

<?php include '_partials/footer.php';





