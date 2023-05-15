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
            
            <?php if(isset($user))
            {
                echo "Your Email is ".$user[0]->email;
            }
            ?>

            <?php foreach ($errors as $error) { ?>
                <p style="color:red"><?= $error ?></p> <?php
                                                    } ?>
            <form action="forgetEmail" method="POST">
                <?= csrf() ?>
                <label for="email">Put TRX ID</label>
                <input type="text" name="trx_id" required />
                <button type="submit" class="login">GET Email</button>
                <!-- <a href="signup" style="color:green">Create Account</a> -->
            </form>
        </div>
    </section>
</body>

</html>