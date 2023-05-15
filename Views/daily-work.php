<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/product.css">

<body>
  <?php include 'layouts/sidebar.php' ?>
  <hr />
  <section class="container">
    <div class="btns">

      <div class="workalert">
        <p>
          You Have Already Your This Reward!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <a href="/" class="btn">Home</a>
      <a href="work" class="btn">Work</a>
      <a href="amazon" class="btn">Amazon</a>
    </div>
  </section>
  <main class="container">
    <?php if (isset($data->logo) and $user->backend_wallet > 0.001) { ?>
      <div class="desc">

        <a href="<?= $data->link ?>"><img id="product_img" src="<?= $data->logo ?>" width="300"></a>
      <?php } ?>
      </div>
      <input type="hidden" value="<?php if (isset($data->link)) echo $data->link;
                                  else echo ""; ?>" id="myInput">
      <?php if (isset($data->logo) and $user->backend_wallet > 0.001) { ?>
        <div class="product_actions">
          <button id="reward" onclick="collectReward()" class="btn">BUY</button>
          <button id="sharebutton" onclick="sharelink()" class="btn">sHARE</a>
        </div>
      <?php  } else if ($user->backend_wallet < 0.001) { ?>
        <h2 style="text-align: center;">Dear Customer, Your product has been stopped due to your laziness. You need to build a team of more people to get more done</h2>
      <?php } else { ?>
        <center id="collected_msg" style="display:<?= $data ? 'none' : '' ?>;font-size:20px;font-weight:bold;color:#C47300">Today work from web is completed next work will provide tomorrow if you want increase daily income so add members in your team Thanks.</center>
      <?php } ?>
  </main>
</body>

</html>

<script>
  let currentProductId = <?= $data->id ?? $sid ?>;
  var workalert = document.querySelector(".workalert");
  workalert.style.display = "none";

  function showworkAlert() {
    workalert.style.display = "flex";
  }

  function collectReward() {

    var link = document.getElementById("myInput").value;
    window.location.href = link;
  }

  function sharelink() {
    if (currentProductId == 10000000) {
      document.getElementById("sharebutton").disabled = true;
    } else {
      var link = document.getElementById("myInput").value;
      var copyText = document.getElementById("myInput").value;
      const shareData = {
        title: 'Share',
        text: '',
        url: copyText
      }

      const btn = document.getElementById('sharebutton');
      navigator.share(shareData);

      btn.addEventListener('click', async () => {
        try {
          await navigator.share(shareData);
        } catch (err) {

        }
      });

      fetch('/collectReward?id=' + currentProductId)
        .then(data => {
          return data.json();
        })
        .then(resp => {
          console.log(resp);
          if (!resp.data) {
            document.getElementById('collected_msg').style.display = '';
            document.getElementById('product_img').style.display = 'none';
          } else {
            document.getElementById('product_img').setAttribute('src', resp.data.logo);
            currentProductId = resp.data.id;
          }
        });
    }
  }
</script>