<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/login.css">
<body>
    <section class="container">
        <div class="l_content">
            <div class="logo">
                <img src="assets/web/images/logo.png" style="margin-top:110px; ;" >
            </div>

            <?php foreach ($errors as $error) { ?>
                <p style="color:red"><?= $error ?></p> <?php
                                                    } ?>
            <form action="login" method="POST">
                <?= csrf() ?>
                <label for="email">Email</label>
                <input type="email" name="email" required />
                <label for="password">Password</label>
                <input type="password" name="password" required />
                <button type="submit" class="login">LOGIN</button>
                <a href="forgot_password">FORGET PASSWORD</a>
                <a href="forget-email" style="color:green">FORGET EMAIL</a>
            </form>
        </div>
    </section>
</body>

</html>