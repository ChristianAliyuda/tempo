<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/CTA.css">

<body>
  <?php include 'layouts/sidebar.php' ?>
  <hr />
  <section class="container">
    <div class="btns">

      <div class="message">
        <p>
         Coming Soon
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <a href="/" class="btn">Home</a>
      <a href="work" class="btn">Work</a>
      <a href="amazon" class="btn">Amazon</a>
    </div>
  </section>

  <section class="container CTA">
    <a onclick="showmessage()" class="btn">DropShipping</a>
    <a  onclick="showmessage()" class="btn">PrivateLabel</a>
    <a  onclick="showmessage()" class="btn">WholeSale</a>
  </section>
</body>

</html>

<script>
  var message = document.querySelector(".message");
  message.style.display = "none";

  function showbonusmessagAlert() {

    message.style.display = "flex";
  }

  function showmessage() {
    showbonusmessagAlert();
    setTimeout(function() {
            location.reload(1);
          }, 2000);

  }
</script>