<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/notification.css">

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
    <h2>Notifications <i class="fa-solid fa-bell"></i></h2>
    <?php foreach ($notifications as $notification) { ?>
      <div class="notification active">
      
        <p>
        
          <?= $notification->description ?>
        </p>
      </div>

    <?php } ?>

  </main>
</body>

</html>