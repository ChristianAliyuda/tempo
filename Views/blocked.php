<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
    <header class="container">
        <nav>
            <div class="left-nav">
                <ul class="links">
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="wallet.html">Wallet</a></li>
                    <li><a href="team.html">Team</a></li>
                    <li><a href="invite.html">Invite</a></li>
                </ul>
            </div>
            <div class="logo">
                <img src="assets/web/images/logo.png" style="margin-bottom:30px;">
            </div>
            <div class="right-nav">
                <ul class="links">
                    <li>
                        <a href="notifications.html"><i class="fa-solid fa-bell"></i></a>
                    </li>
                    <li>
                        <a href="setting.html"><i class="fa-solid fa-gear"></i></a>
                    </li>
                    <li>
                        <a href="contact.html"><i class="fa-solid fa-phone"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <hr />
    <hr />
    <section class="container">
        <div class="btns">
            <div class="messagelevelalert">
                <p>
                    Your account has been blocked due to illegal activity. After verification, legal action will be taken against you. </p>
            </div>
            <a href="index.html" class="btn">Home</a>
            <a href="product.html" class="btn">Work</a>
            <a href="" class="btn">Amazon</a>
        </div>
    </section>

    <section class="container content">
        <h2 class="sub_heading">Bonus</h2>
        <h1 class="main_heading">40 Pound</h1>

        <button onclick="sendrequest()" class="btn">Withdraw</button>


        <a href="history" class="btnss" style="margin-top: 10px;">History</a>
        <button onclick="collectBonus()" class="btn" style="margin-top: 8px;">Collect</button>
    </section>
    <div class="overlay">

    </div>
</body>

</html>