<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/invite.css">

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
    <div class="i_content">
      <div class="upper_content">
        <img src="assets/web/images/img_avatar.png" alt="" />
        <h2><?=$leader->name?></h2>
      </div>
      <div class="lower_content">
        <h1 class="main_heading">Make Your Team</h1>
        <p id="message" style="color:#59b200;"></p>
        <input type="hidden" readonly style="background-color:black;color:white;border: 1px solid white;" id="myInput" class="form-control" value="<?= $data ?>" placeholder="Username" required>
        <a  class="btn" onclick="myFunction()">Copy Link</a>
        <a  id="sharebutton" onclick="sharelink()" class="btn">Share Link</a>
      </div>
    </div>
  </main>
</body>

</html>

<script>
  function myFunction() {

    /* Get the text field */
    var copyText = document.getElementById("myInput");
    copyText.select();
    navigator.clipboard
      .writeText(copyText.value)
      .then(() => {
        document.getElementById('message').innerHTML = 'Link Copy Successfully';
      })
      .catch(() => {
        alert("something went wrong");
      });

    /* Alert the copied text */

  }

  function sharelink() {

    var copyText = document.getElementById("myInput").value;

    const shareData = {
      title: 'Invite',
      text: 'Invitation Link For Amadox',
      url: copyText
    }

    const btn = document.getElementById('sharebutton');
    const resultPara = document.querySelector('.result');

    // Share must be triggered by "user activation"
    btn.addEventListener('click', async () => {
      try {
        await navigator.share(shareData)
        resultPara.textContent = ''
      } catch (err) {
        resultPara.textContent = ''
      }
    });
  }
</script>