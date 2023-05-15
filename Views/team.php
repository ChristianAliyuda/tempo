<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<body>
<?php include 'layouts/sidebar.php' ?>
<link rel="stylesheet" href="assets/web/css/team.css">
    <hr />
    <section class="container">
      <div class="btns">
        <a href="/" class="btn">Home</a>
        <a href="work" class="btn">Work</a>
        <a href="amazon" class="btn">Amazon</a>
      </div>
    </section>

    <main class="container">
      <div class="t_content">
        <div class="leader">
          <h1 class="main_heading">Leader</h1>
          <img src="./assests/profile.jpeg" alt="" />
          <h3 class="name"><?=$leader->name?></h3>
        </div>
        <div class="team">
          <?php foreach($users as $user) { ?>
          <div class="t_card">
            <img src="<?=$user->profile?>" alt="" />
            <h3 class="name"><?=$user->name?></h3>
          </div>
          <?php } ?>
        
        </div>
      </div>
    </main>
  </body>
</html>
