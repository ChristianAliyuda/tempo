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
                                        <h3 class="content-title pull-left">Setting</h3>
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
                                        <h4><i class="fa fa-table"></i>Accounts</h4>
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
                                        <?php if ($message) { ?> <h4><?= $message ?></h4> <?php } ?>
                                        <p style="font-size: 20px; font-weight: 500;">Current Account: <?= $settings->last_account_no ?></p>
                                        <form role="form" method="POST" action="updateaccounts" enctype="multipart/form-data">

                                            <input type="hidden" name="id" value="<?= $accounts->id ?>">

                                            <div class="row">
                                                <div class="form-group col-md-4 col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 1</label>
                                                    <input type="text" class="form-control" required name="account_name_one" value="<?= $accounts->account_name_one ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4 col-md-4">
                                                    <label for="exampleInputPassword1">Account No 1</label>
                                                    <input type="text" class="form-control" required name="account_no_one" value="<?= $accounts->account_no_one ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4 col-md-4">
                                                    <label for="exampleInputPassword1">Status 1</label>
                                                    <select name="account_status_one" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_one == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_one == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 2</label>
                                                    <input type="text" class="form-control" required name="account_name_two" value="<?= $accounts->account_name_two ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 2</label>
                                                    <input type="text" class="form-control" required name="account_no_two" value="<?= $accounts->account_no_two ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 2</label>
                                                    <select name="account_status_two" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_two == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_two == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 3</label>
                                                    <input type="text" class="form-control" required name="account_name_three" value="<?= $accounts->account_name_three ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 3</label>
                                                    <input type="text" class="form-control" required name="account_no_three" value="<?= $accounts->account_no_three ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 3</label>
                                                    <select name="account_status_three" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_three == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_three == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 4</label>
                                                    <input type="text" class="form-control" required name="account_name_four" value="<?= $accounts->account_name_four ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 4</label>
                                                    <input type="text" class="form-control" required name="account_no_four" value="<?= $accounts->account_no_four ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 4</label>
                                                    <select name="account_status_four" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_four == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_four == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 5</label>
                                                    <input type="text" class="form-control" required name="account_name_five" value="<?= $accounts->account_name_five ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 5</label>
                                                    <input type="text" class="form-control" required name="account_no_five" value="<?= $accounts->account_no_five ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 5</label>
                                                    <select name="account_status_five" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_five == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_five == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 6</label>
                                                    <input type="text" class="form-control" required name="account_name_six" value="<?= $accounts->account_name_six ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 6</label>
                                                    <input type="text" class="form-control" required name="account_no_six" value="<?= $accounts->account_no_six ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 6</label>
                                                    <select name="account_status_six" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_six == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_six == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 7</label>
                                                    <input type="text" class="form-control" required name="account_name_seven" value="<?= $accounts->account_name_seven ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 7</label>
                                                    <input type="text" class="form-control" required name="account_no_seven" value="<?= $accounts->account_no_seven ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 7</label>
                                                    <select name="account_status_seven" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_seven == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_seven == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 8</label>
                                                    <input type="text" class="form-control" required name="account_name_eight" value="<?= $accounts->account_name_eight ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 8</label>
                                                    <input type="text" class="form-control" required name="account_no_eight" value="<?= $accounts->account_no_eight ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 8</label>
                                                    <select name="account_status_eight" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_eight == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_eight == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 9</label>
                                                    <input type="text" class="form-control" required name="account_name_nine" value="<?= $accounts->account_name_nine ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 9</label>
                                                    <input type="text" class="form-control" required name="account_no_nine" value="<?= $accounts->account_no_nine ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 9</label>
                                                    <select name="account_status_nine" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_nine == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_nine == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account Title 10</label>
                                                    <input type="text" class="form-control" required name="account_name_ten" value="<?= $accounts->account_name_ten ?>" id="exampleInputPassword1" placeholder="Account Ttile">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Account No 10</label>
                                                    <input type="text" class="form-control" required name="account_no_ten" value="<?= $accounts->account_no_ten ?>" id="exampleInputPassword1" placeholder="Account No">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputPassword1">Status 10</label>
                                                    <select name="account_status_ten" class="form-control" required>
                                                        <option value="0" <?php if ($accounts->account_status_ten == 0) {
                                                                                echo ('selected');
                                                                            } ?>>OFF</option>
                                                        <option value="1" <?php if ($accounts->account_status_ten == 1) {
                                                                                echo ('selected');
                                                                            } ?>>ON</option>
                                                    </select>
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

</html>