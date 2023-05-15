<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/profile.css">
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

    <main class="container">
      <div class="p_content">
        <form action="">
          <div class="row">
            <label for="picture">Picture</label>
            <img src="assets/web/images/img_avatar.png" alt="" />
          </div>
          <div class="row">
            <label for="username">Username</label>
            <input type="text" id="username" value="<?=$user->name?>" readonly name="username" />
          </div>
          <div class="row">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?=$user->email?>" readonly id="email" />
          </div>
          <div class="row">
            <label for="phone">Phone No</label>
            <input type="number" id="phone" value="<?=$user->account_no?>" readonly name="phone" />
          </div>
          <div class="row">
            <label for="address">Address</label>
            <textarea
              name="address"
              id="address"
              cols="20"
              rows="4"
            ><?=$user->address?></textarea>
          </div>
          <div class="row">
            <label for="level">Level</label>
            <input type="text" value="<?=$user->title?>" readonly />
          </div>
        </form>
      </div>
    </main>
  </body>
</html>