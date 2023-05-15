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


                                </div>
                            </div>
                        </div>
                        <h2 style="color:red;" id="message"></h2>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BOX -->
                                <div class="box border green">
                                    <div class="box-title">
                                        <?php if ($message) { ?> <h4><?= $message ?></h4> <?php } ?>
                                        <h4 id="message"></h4>
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
                                    <div class="box-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Total Team</th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Balance</th>
                                                    <th>Credit</th>
                                                    <th>Enter Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($totalteams as $totalteam) { ?>
                                                    <tr>
                                                        <td class="center"><?= $totalteam->totateam ?></td>
                                                        <td class="center"><?= $totalteam->id ?></td>
                                                        <td class="center"><?= $totalteam->name ?></td>
                                                        <td class="center"><?= $totalteam->current_amount ?></td>
                                                        <td class="center"><?= $totalteam->total_credit ?></td>
                                                        <td>
                                                            <div class="form-group">

                                                                <input type="text" id="amount_<?= $totalteam->id ?>" class="form-control">
                                                            </div>
                                                        </td>
                                                        <td><button onclick="AddBalance(<?= $totalteam->id ?>)" type="button" class="btn btn-primary">Bonus</button></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total Team</th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Balance</th>
                                                    <th>Credit</th>
                                                    <th>Enter Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /BOX -->
                            </div>
                        </div>
                        <!-- /DASHBOARD CONTENT -->
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
    <!-- JAVASCRIPTS -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include 'layouts/scripts.php' ?>
</body>

</html>

<script>
    function AddBalance(id) {

        let input = document.getElementById("amount_" + id)
        let amount = input.value

        fetch("/dashboard/AddBalance", {

            // Adding method type
            method: "POST",

            // Adding body or contents to send
            body: JSON.stringify({
                user_id: id,
                amount: amount,
            }),

            // Adding headers to the request
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        })

        document.getElementById('message').innerHTML = "Amount Added Successfully";
        window.setTimeout(function() {
            location.reload()
        }, 2000)


    }
</script>