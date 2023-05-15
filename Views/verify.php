<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<link rel="stylesheet" href="assets/web/css/membership.css">


<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
  <section class="container">
    <div class="logo">
      <img src="assets/web/images/logo.png">
    </div>
    <div class="detail">

      <?php if (empty($user->txt_id)) { ?>
        <h2>amadox Membership card Fees</h2>
        <h1 style="color:black"><?= $data->register_fees ?> Pound</h1>
        <h2>today 1 Pound in your country</h2>
        <h1 style="color:black"><?= $dollar ?> PKR</h1>
        <h2>TOTAL AMOUNT YOU WILL PAY IN PKR</h2>
        <h1 style="color:black">RS : <?= $dollar * $data->register_fees ?></h1>
        <h2>YOU WILL SEND THIS AMOUNT ON GIVEN EASYPAISA ACCOUNT NUMBER</h2>
        <h1>EASYPAISA ACCOUNT</h1>
        <h1 style="color:black">ACC NO : <?= $account['account_no'] ?></h1>
        <h1 style="color:black">ACC NAME : <?= $account['account_name'] ?></h1>
        <h2>AFTER SENDING AMOUNT PUT TRX ID AND SENDER NUMBER</h2>

        <center><?php if ($message) { ?> <p style="color:red;margin-top:12px;"><?= $message ?></p> <?php } ?></center>
        <form action="updateverify" method="POST">
          <div>
            <label for="sender_number">PUT SENDER NUMBER</label>
            <input type="text" id="sender_number" required name="sender_no" />

            <label for="txd_id">PUT TRX ID</label>
            <input type="number" id="txd_id" required name="txt_id" />
          </div>
          <button type="submit" class="btn">SUBMIT</button>
        </form>
      <?php } else if (!empty($user->txt_id) and $user->txtid_rejected == 1) { ?>
        <h2>amadox Membership card Fees</h2>
        <h1 style="color:black"><?= $data->register_fees ?> USD</h1>
        <h2>today 1 usd in your country</h2>
        <h1 style="color:black"><?= $dollar ?> PKR</h1>
        <h2>TOTAL AMOUNT YOU WILL PAY IN PKR</h2>
        <h1 style="color:black">RS : <?= $dollar * $data->register_fees ?></h1>
        <h2>YOU WILL SEND THIS AMOUNT ON GIVEN EASYPAISA ACCOUNT NUMBER</h2>
        <h1>EASYPAISA ACCOUNT</h1>
        <h1 style="color:black">ACC NO : <?= $account['account_no'] ?></h1>
        <h1 style="color:black">ACC NAME : <?= $account['account_name'] ?></h1>
        <h2>AFTER SENDING AMOUNT PUT TRX ID AND SENDER NUMBER</h2>

        <center>
          <h3 class="mt-3" style="color:red;">You Have Put Wrong Trxt Id Please Put Correct Txt Id.Then You Can Work On This Website.</h3>
        </center>
        <center><?php if ($message) { ?> <p style="color:red;margin-top:12px;"><?= $message ?></p> <?php } ?></center>
        <form action="updateverify" method="POST">
          <div>
            <label for="sender_number">PUT SENDER NUMBER</label>
            <input type="tel" required name="sender_no" id="sender_number" />

            <label for="txd_id">PUT TRX ID</label>
            <input type="number" required id="txd_id" name="txt_id" />
          </div>
          <button type="submit" class="btn">SUBMIT</button>
        </form>
      <?php } else { ?>
        <center>
          <div class="alertverify">
            <p>
              Your information is saved in Amadox. Your remittance is being verified Your account will be opened after verification Please wait for the amount to be verified Thank you.
            </p>
          </div>
        </center>
      <?php } ?>
    </div>
  </section>
</body>

</html>