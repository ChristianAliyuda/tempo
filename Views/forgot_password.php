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
            <form action="SendForgotEmail" method="POST">
                <?= csrf() ?>
                <label for="email">Email</label>
                <input type="email" name="email" required />
                <button type="submit" class="login">Send Email</button>
                <!-- <a href="signup" style="color:green">Create Account</a> -->
            </form>
        </div>
    </section>
</body>

</html>