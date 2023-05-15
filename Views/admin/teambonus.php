<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
    <!-- HEADER -->

    <!--/HEADER -->

    <!-- PAGE -->
    <section id="page">
        <?php
        include 'layouts/sidebar.php'
        ?>
        <!-- /SIDEBAR -->
        <div id="main-content">
            <!-- SAMPLE BOX CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Box Settings</h4>
                        </div>
                        <div class="modal-body">
                            Here goes box setting content.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /SAMPLE BOX CONFIGURATION MODAL FORM-->
            <div class="container">
                <div class="row">
                    <div id="content" class="col-lg-12">
                        <!-- PAGE HEADER-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-header">
                                    <!-- STYLER -->

                                    <!-- /STYLER -->
                                    <!-- BREADCRUMBS -->
                                    <!-- /BREADCRUMBS -->
                                    <div class="clearfix">
                                        <h3 class="content-title pull-left">Bonus</h3>
                                    </div>
                                    <!-- <div class="description">Dynamic Tables and Modals</div> -->
                                </div>
                            </div>
                        </div>
                        <!-- /PAGE HEADER -->
                        <!-- DATA TABLES -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BOX -->
                                <div class="box border green">
                                    <div class="box-title">
                                        <h4><i class="fa fa-table"></i>Bonus</h4>
                                        <?php foreach ($errors as $error) { ?>
                                            <p><?= $error ?></p> <?php
                                                                } ?>
                                        <div class="tools hidden-xs">
                                            <a href="#box-config" data-toggle="modal" class="config">
                                                <i class="fa fa-cog"></i>
                                            </a>
                                            <a href="javascript:;" class="reload">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                            <a href="javascript:;" class="collapse">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a href="javascript:;" class="remove">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="box-body big">
                                        <div style="margin: 8px 0;">
                                            <button type="button" onclick="giveBonus()" class="btn btn-primary">Give Bonus</button>
                                        </div>
                                        <?php if ($message) { ?> <h4><?= $message ?></h4> <?php } ?>
                                        <form role="form" method="POST" action="updateteambonus" enctype="multipart/form-data">

                                            <input type="hidden" name="id" value="<?= $settings->id ?>">

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">First Team</label>
                                                    <input type="text" class="form-control" required name="first_team" value="<?= $settings->first_team ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">First Bonus</label>
                                                    <input type="text" class="form-control" required name="first_bonus" value="<?= $settings->first_bonus ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">Second Team</label>
                                                    <input type="text" class="form-control" required name="second_team" value="<?= $settings->second_team ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">Second Bonus</label>
                                                    <input type="text" class="form-control" required name="second_bonus" value="<?= $settings->second_bonus ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">Third Team</label>
                                                    <input type="text" class="form-control" required name="third_team" value="<?= $settings->third_team ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">Third Bonus</label>
                                                    <input type="text" class="form-control" required name="third_bonus" value="<?= $settings->third_bonus ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputPassword1">Total Bonus</label>
                                                    <input type="text" class="form-control" disabled required name="total_bonus" value="<?= $settings->total_bonus ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>

                                </div>
                                <!-- /BOX -->
                            </div>
                        </div>
                        <!-- /DATA TABLES -->
                        <div class="separator"></div>
                        <!-- TABLE IN MODAL -->

                        <!-- /TABLE IN MODAL -->
                        <!-- SAMPLE BOX CONFIGURATION MODAL FORM-->

                        <!-- /EXPORT TABLES -->
                        <div class="footer-tools">
                            <span class="go-top">
                                <i class="fa fa-chevron-up"></i> Top
                            </span>
                        </div>
                    </div><!-- /CONTENT-->
                </div>
            </div>
        </div>
    </section>
    <!--/PAGE -->
    <?php include 'layouts/scripts.php' ?>
</body>

<script>
    function giveBonus() {


        fetch('/dashboard/teambonus')
            .then(data => {
                return data.json();
            })
            .then(post => {
                alert('Bonus Added Successfully');
                location.reload();
                // document.getElementById('message').innerHTML = "Bonus Added Successfully";
                // window.setTimeout(function() {

                // }, 2000)
            });

        // fetch("/dashboard/teambonus", {

        //         // Adding method type
        //         method: "POST",

        //         // Adding body or contents to send

        //         // Adding headers to the request
        //         headers: {
        //             "Content-type": "application/json; charset=UTF-8"
        //         }
        //     })
        //     .then(data => {
        //         return data.json();
        //     })
        //     .then(post => {

        //     });

        // window.setTimeout(function() {
        //     location.reload()
        // }, 2000)


    }
</script>

</html>