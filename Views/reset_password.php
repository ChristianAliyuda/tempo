<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/login.css">

<body>
    <section class="container">
        <div class="l_content">
            <div class="logo">
                <img src="assets/web/images/logo.png" style="margin-top:110px; ;">
            </div>

            <?php foreach ($errors as $error) { ?>
                <p style="color:red"><?= $error ?></p> <?php
                                                    } ?>
            <form action="reset_password" method="POST">
                <?= csrf() ?>
                <input type="hidden"  name="email" value="<?=$_SESSION['email']?>">
                <label for="email">Opt Code</label>
                <input type="text" name="otp" required />
                <label for="email">Password</label>
                <input type="password" name="password" required />
                <label for="email">Confrim Password</label>
                <input type="password" name="password_confirmation" required />
                <button type="submit" class="login">Update Password</button>
                <!-- <a href="signup" style="color:green">Create Account</a> -->
            </form>
        </div>
    </section>
</body>

</html>