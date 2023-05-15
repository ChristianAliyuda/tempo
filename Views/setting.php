<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/setting.css">

<body>
  <?php include 'layouts/sidebar.php' ?>
  <hr />
  <section class="container">
    <div class="btns">
      <a href="/" class="btn">Home</a>
      <a href="work" class="btn">Work</a>
      <a href="amazon" class="btn">Amazon</a>
    </div>
  </section>
  
  <?php if ($message) { ?> <p  style="color:red;margin-top:25px;text-align:center"><?= $message ?></p> <?php } ?>

  <?php foreach ($errors as $error) { ?>
    <p class="text-center mt-3" style="color:red;margin-top:25px;"><?= $error ?></p> <?php
                                                                                    } ?>
  <main class="container">
    <form action="updateAccount" method="POST">
      <h2>Update Account Information</h2>

      <h2>Put Here Your Account Details For Withdraw</h2>

      <select name="account_name" id="account">
        <option <?php if ($setting->account_no == 'easyPaisa') echo "selected" ?>value="easyPaisa">EasyPaisa</option>
      </select>
      <input type="number" name="account_no" value="<?= $setting->account_no ?>" placeholder="Account Number" required />
      <input type="text" name="account_title" value="<?= $setting->account_title ?>" placeholder="Account Holder Name" required />
      <button type="submit" style=" background-color: #c47300;" class="btn">Save</button>
    </form>

    <form action="updatepassword" method="POST">
      <h2>Update Password</h2>
      <input type="password" name="old_password" placeholder="Old Password" />
      <input type="password" name="password" placeholder="New Password" />
      <input type="password" name="confirm_password" placeholder="Retype Password" />
      <button type="submit" style=" background-color: #c47300;" class="btn">Save</button>
    </form>
  </main>
</body>

</html>