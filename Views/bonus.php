<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php include 'layouts/sidebar.php' ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger animated fadeInRight is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-6 text-center">
                        <a href="/"><img src="assets/web/images/logo.png" style="width:350px;height:auto;margin-top:-70px;margin-bottom:-50px;"></a>
                    </div>
                    <div class="col-lg-8 ">
                        <div class="row text-center mt-1">
                            <p id="message" style="color:#59b200"></p>
                            <div class="col-lg-12 ">
                                <?php if (!$bonus1) { ?>
                                    <button type="button" id="bonus" onclick="collectBonus()" class="btn" style="background-color:#59b200;color:white">Collect Bonus</button></a>
                                <?php } else { ?>
                                    <button type="button" onclick="showmessage()" class="btn" style="background-color:green;color:white">Collect Bonus</button></a>
                                <?php } ?>

                            </div>

                        </div>
                        <div class="row justify-content-center text-center mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Collect Amount</th>
                                        <th>Collect Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bonus as $bonus) { ?>
                                        <tr>
                                            <td><?= $bonus->amount ?></td>
                                            <td><?= $bonus->date ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include 'layouts/scripts.php' ?>
</body>

</html>

<script>
    function collectBonus() {
        document.getElementById("bonus").disabled = true;

        fetch('/collectBonus')
            .then(data => {
                return data.json();
            })
            .then(post => {

                if (post == "Already Collect") {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'You Have Already  Collect Today Your Payment!',
                        closeButtonColor: "#00967d",
                    })
                } else {
                    document.getElementById('message').innerHTML = 'You Have Collect Bonus Successfully';
                    location.reload();
                }

            });
    }

    function showmessage()
    {
        document.getElementById('message').innerHTML = 'You Have Alraedy  Collect Today Bonus';
    }
</script>