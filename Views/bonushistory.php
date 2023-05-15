<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/wallet.css">

<body>
  <?php include 'layouts/sidebar.php' ?>
  <hr />
  <section class="container">
    <div class="btns">
      <div class="alert">
        <p>
          Your Payment Request Is Already Pending
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>
      <div class="msalert">
        <p>
          Your Payment Request Send Successfuly
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="message1alert">
        <p>
          You can Not Exchange Less Than 0.5 $
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="message2alert">
        <p>
          You can Not Exchange Less Than 1 $
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="message3alert">
        <p>
          You can Not Exchange Less Than 2 $
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="message4alert">
        <p>
          You can Not Exchange Less Than 3 $
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <a href="/" class="btn">Home</a>
      <a href="work" class="btn">Work</a>
      <a href="amazon" class="btn">Amazon</a>
    </div>
  </section>

  <main class="container">
   
    <table>
      <tr>
        <th colspan="4">Bonus Withdraw History</th>
      </tr>
      <tr>
        <th></th>
        <th>Date</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
      <?php $i=0;foreach ($payments as $payment) {  ?>
        <tr>
          <th><?=++$i;?></th>
          <?php if ($payment->updated_at) { ?>
            <td><?= $payment->updated_at ?></td>
          <?php } else { ?>
            <td><?= $payment->created_at ?></td>
          <?php } ?>
          <td><?= $payment->amount ?></td>
          <?php if ($payment->payment_approved == 0) { ?>
            <td>Pending</td>
          <?php } ?>
          <?php if ($payment->payment_approved == 1) { ?>
            <td>Approved</td>
          <?php } ?>
          <?php if ($payment->payment_approved == 2) { ?>
            <td>Rejected</td>
          <?php } ?>
        </tr>
      <?php } ?>

    </table>
  </main>

</body>

</html>

<script>
  <?php include 'layouts/app.js' ?>

  
  function convertToPkr() {

    fetch('/convertToPkr')
      .then(data => data.json())
      .then(res => {
        if (res.message == "limit1") {
          showmessage1Alert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
          
        }
        
        else if (res.message == "limit2") {
          showmessage2Alert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        }

        else if (res.message == "limit3") {
          showmessage3Alert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        }

        else if (res.message == "limit4") {
          showmessage4Alert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        }

      });
  }

  function sendrequest() {

    fetch('/payment_request')
      .then(data => data.json())
      .then(res => {
        console.log(res.message)

        if (res.message == "Already") {
          showAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        } else {
          showSuccessfulyAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);

        }

      });
  }
</script>