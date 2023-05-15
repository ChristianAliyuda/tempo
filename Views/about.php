<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>
<style>
    #example1 {
        border: 2px solid #59b200;
        padding: 10px;
        border-radius: 25px;
    }

    #example2 {
        border: 2px solid #59b200;
        padding: 10px;
        border-radius: 50px 20px;
    }
</style>

<body>
    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->

        <!--/#sidebar-wrapper -->
        <?php include 'layouts/sidebar.php' ?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger animated fadeInRight is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="container">

                <div class="row justify-content-center">
                    <div class=" col-12  logo text-center">
                        <a href="/"> <img src="assets/web/images/logo.png" style="width:350px;height:auto;margin-top:-70px;margin-bottom:-70px;"></a>
                    </div>
                    <h3 class="text-center mt-3" style="font-weight:bold;color:#59b200">About Us</h3>
                    <div class="col-lg-8 mt-3 text-center">

                    
                        <div class="row justify-content-center mt-2">
                            <div class="col-md-8 col-lg-8 col-xs-8  ml-auto mr-auto mb-4">
                                <div id="example1">
                                    <h6 style="color:#59b200">Amadox is a best platform for making money online. There is no need of any skill or experience just do the task and make money. You just need to level up your account and increase your daily income</h6>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row justify-content-center ">
                                <div class="copy-link mb-4">
                                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p>
                                </div>
                            </div> -->

                    </div>
                </div>
            </div>
        </div>
        <p class="result"></p>
        <footer style=" position: fixed; bottom: 0; left: 0; right: 0;">
                <div class="container">
                    <div class="row justify-content-center" style="height:10px;">
                        <div class="copyright">
                            <p class="text-center" style="margin-top: -5px;">Copyright Reserved 2018</p>
                        </div>
                    </div>
                </div>
            </footer>
    </div>
</body>

</html>
<?php include 'layouts/scripts.php' ?>