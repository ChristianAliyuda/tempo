<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
  <?php include 'layouts/sidebar.php' ?>
  <hr />
  <section class="container">
    <div class="btns">

      <div class="messagelevelalert">
        <p>
          Next Bous You Can Get On Level 12
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="showbonusmessageAlert">
        <p>
          Your Bonus Request Received Successfuly!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="showBonusCollectAlert">
        <p>
          You Can Collect Bonus On Level 2!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="showCollectAlert">
        <p>
          You Have Collect Bonus Successfuly!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="showalreadyAlert">
        <p>
          You Have Already Collect Today Bonus!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="showwithdrawAlert">
        <p>
          Please Take First WithDraw And Then You Can Collect More Bonus!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="already">
        <p style="color:white">
          Your Payment Request Already Pending
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="showtodaywithdrawAlert">
        <p style="color:white">
         only 50 Pound limit WithDraw in One Day And Reaming WithDraw You Can Take Tommorow
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>


      <div class="showLevel15Alert">
        <p>
          Now You Can Take WithDraw At Level15!
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>

      <div class="message2alert">
        <p>
        you can get bounce withdraw at lavel 6
        </p>
        <button class="alertHide" onclick="hideAlert()">Ok</button>
      </div>





      <a href="/" class="btn">Home</a>
      <a href="work" class="btn">Work</a>
      <a href="amazon" class="btn">Amazon</a>
    </div>
  </section>

  <section class="container content">
    <h2 class="sub_heading">Bonus</h2>
    <h1 class="main_heading"><?= round($user->user_bonus, 4) ?> Pound</h1>

    <button onclick="sendrequest()" class="btn">Withdraw</button>


    <a href="history" class="btnss" style="margin-top: 10px;">History</a>
    <button onclick="collectBonus()" class="btn" style="margin-top: 8px;">Collect</button>
    <img src="assets/web/images/graph.png" style="width:100%;margin-top:12px;" alt="" />
  </section>
</body>

</html>
<script>
  var messagelevelalert = document.querySelector(".messagelevelalert");
  var showbonusmessageAlert = document.querySelector(".showbonusmessageAlert");
  messagelevelalert.style.display = "none";
  showbonusmessageAlert.style.display = "none";


  var showBonusCollectAlert = document.querySelector(".showBonusCollectAlert");
  showBonusCollectAlert.style.display = "none";

  var showCollectAlert = document.querySelector(".showCollectAlert");
  showCollectAlert.style.display = "none";

  var showalreadyAlert = document.querySelector(".showalreadyAlert");
  showalreadyAlert.style.display = "none";

  var showwithdrawAlert = document.querySelector(".showwithdrawAlert");
  showwithdrawAlert.style.display = "none";

  var already = document.querySelector(".already");
  already.style.display = "none";

  var showtodaywithdrawAlert = document.querySelector(".showtodaywithdrawAlert");
  showtodaywithdrawAlert.style.display = "none";

  var showLevel15Alert = document.querySelector(".showLevel15Alert");
  showLevel15Alert.style.display = "none";

  var message2alert = document.querySelector(".message2alert");
  message2alert.style.display = "none";







  function showLevelAlert() {
    messagelevelalert.style.display = "flex";
  }

  function showbonusmessagAlert() {

    showbonusmessageAlert.style.display = "flex";
  }

  function showBonuCollectAlert() {

    showBonusCollectAlert.style.display = "flex";
  }

  function showCollectMessageAlert() {

    showCollectAlert.style.display = "flex";
  }

  function showAlreadysAlert() {

    showalreadyAlert.style.display = "flex";
  }

  function showWithdrawAlert() {

    showwithdrawAlert.style.display = "flex";
  }

  function showalreadysAlert() {

already.style.display = "flex";
}

  function showtodayWithdrawsAlert() {

showtodaywithdrawAlert.style.display = "flex";
}

  

  function showLevels15Alert() {

    showLevel15Alert.style.display = "flex";
  }

  function showmessage2Alert() {
    message2alert.style.display = "flex";
  }

  function sendrequest() {

    fetch('/bonuspayment_request')
      .then(data => data.json())
      .then(res => {
        console.log(res.message)

        if (res.message == "level15") {
          showLevelAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        }

        else if (res.message == "account2") {
          window.location.replace("/setting");
        }
        
        else if (res.message == "limit") {
          showmessage2Alert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        }
        
        else if (res.message == "already") {
          showalreadysAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        } 

        else if (res.message == "todaylevel12") {
          showtodayWithdrawsAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        }
        else {

          showbonusmessagAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);

        }

      });
  }

  function collectBonus() {
    fetch('/collectBonus')
      .then(data => data.json())
      .then(res => {
        console.log(res.message)

        if (res.message == "level2") {

          showBonuCollectAlert();

          setTimeout(function() {
            location.reload(1);
          }, 2000);
        } else if (res.message == "Already") {
          showAlreadyAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        } else if (res.message == "withdraw") {
          showWithdrawAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);
        } 

        else {

          showCollectMessageAlert();
          setTimeout(function() {
            location.reload(1);
          }, 2000);

        }

      });

  }
</script>