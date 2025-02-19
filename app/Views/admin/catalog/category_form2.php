<?= $this->include('admin/common/header') ?>
<div class="content-body">

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6">
                <div class="welcome-text">
                    <h4>Add Sheets</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Sheets</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sheets</a></li>

                    </ol>
                </div>
            </div>
            <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">

                <button class="btn btn-primary btn-rounded" id="save_btn">
                    Save
                </button>
                &nbsp;
                <button class="btn btn-danger btn-rounded">
                    <li class="fa fa-arrow-left"></li>
                </button>

            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/catalog/category_form_save/' . $token); ?>" method="post">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home1"><i class="la la-home mr-2"></i> General</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                        <?php
                                        // Convert comma-separated values back to arrays
                                        $submit_dates = explode(',', $cat->submit_date);
                                        $report_submit_dates = explode(',', $cat->report_submit_date);
                                        ?>

                                        <div class="row pt-2">
                                            <input type="hidden" name="id" value="<?= $cat->id ?>">

                                            <div class="col-md-4 mt-3">
                                                <label for="">Organization Name</label>
                                                <input type="text" class="form-control" name="name" value="<?= $cat->name ?>" placeholder="Organization Name">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Branch Name</label>
                                                <input type="text" class="form-control" name="branch" value="<?= $cat->branch ?>" placeholder="Branch Name">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Assignment Name</label>
                                                <input type="text" class="form-control" name="assignment" value="<?= $cat->assignment ?>" placeholder="Assignment Name">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Professional Fees</label>
                                                <input type="text" class="form-control" name="fee" value="<?= $cat->fee ?>" placeholder="Professional Fees">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Bill Date</label>
                                                <input type="text" class="form-control" name="bill_date" value="<?= $cat->bill_date ?>" placeholder="Bill Date">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Invoice Number</label>
                                                <input type="text" class="form-control" name="invoice_no" value="<?= $cat->invoice_no ?>" placeholder="Invoice Number">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Recovery Status</label>
                                                <input type="text" class="form-control" name="recovery_status" value="<?= $cat->recovery_status ?>" placeholder="Recovery Status">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Security Deposit</label>
                                                <input type="text" class="form-control" name="security_deposit" value="<?= $cat->security_deposit ?>" placeholder="Security Deposit">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Working Environment</label>
                                                <input type="text" class="form-control" name="working" value="<?= $cat->working ?>" placeholder="Working Environment">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Completion Certificate Received</label>
                                                <input type="text" class="form-control" name="completion" value="<?= $cat->completion ?>" placeholder="Completion Certificate Received">
                                            </div>

                                            <!-- UDIN -->
                                            <div class="col-md-4 mt-3">
                                                <label for="">UDIN</label>
                                                <select class="form-control form-control-lg" name="udin">
                                                    <option value="">Select an option</option>
                                                    <option value="yes" <?= ($cat->udin == "yes") ? "selected" : "" ?>>Yes</option>
                                                    <option value="no" <?= ($cat->udin == "no") ? "selected" : "" ?>>No</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">UDIN No</label>
                                                <input type="text" class="form-control" name="udin_no" value="<?= $cat->udin_no ?>" placeholder="UDIN No">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">UDIN Turnover</label>
                                                <input type="text" class="form-control" name="udin_trun" value="<?= $cat->udin_trun ?>" placeholder="UDIN Turnover">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Status</label>
                                                <select class="form-control form-control-lg" name="status">
                                                    <option value="1" <?= ($cat->status == "1") ? "selected" : "" ?>>Enable</option>
                                                    <option value="0" <?= ($cat->status == "0") ? "selected" : "" ?>>Disable</option>
                                                </select>
                                            </div>

                                            <!-- Frequency of Audit -->
                                            <div class="col-md-4 mt-3">
                                                <label for="">Frequency Of Audit</label>
                                                <select class="form-control form-control-lg" name="audit" id="auditFrequency">
                                                    <option value="">Select Frequency</option>
                                                    <option value="monthly" <?= ($cat->audit == "monthly") ? "selected" : "" ?>>Monthly</option>
                                                    <option value="quarterly" <?= ($cat->audit == "quarterly") ? "selected" : "" ?>>Quarterly</option>
                                                    <option value="yearly" <?= ($cat->audit == "yearly") ? "selected" : "" ?>>Yearly</option>
                                                </select>
                                            </div>

                                            <!-- Submit Date Fields -->
                                            <div class="col-md-4 mt-3">
                                                <label>Last Date of Submission</label>
                                                <?php foreach ($submit_dates as $index => $date) : ?>
                                                    <input type="text" class="form-control mt-2" name="submit_date[]" value="<?= trim($date) ?>">
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- Report Submit Date Fields -->
                                            <div class="col-md-4 mt-3">
                                                <label>Report Date of Submission</label>
                                                <?php foreach ($report_submit_dates as $index => $date) : ?>
                                                    <input type="text" class="form-control mt-2" name="report_submit_date[]" value="<?= trim($date) ?>">
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <button type="submit" value="submit" class="btn d-none" id="s_btnn">Submit</button>


                                    </div>
                                </div>
                            </div>
                        </form><!-- Nav tabs -->
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
<script>
    document.getElementById('save_btn').addEventListener('click', function() {
        // Trigger a click on the second button
        const noteEditableContent = document.querySelector('.note-editable').innerHTML;
        document.getElementById('description').value = noteEditableContent;
        document.getElementById('s_btnn').click();
    });
    // Attach a click event to the first button
    document.getElementById('save_btn').addEventListener('click', function() {
        // Trigger a click on the second button
        document.getElementById('s_btnn').click();
    });
    document.addEventListener("DOMContentLoaded", function() {
        // Remove the 'active' class from the 'des-menu' item
        const desMenu = document.getElementById("des-menu");
        const des = document.getElementById("dashboard");
        if (desMenu) {
            desMenu.classList.remove("active");
        }
        if (des) {
            des.classList.remove("show");
            des.classList.remove("active");
        }

        // Add the 'active' class to the 'cat-menu' item
        const catMenu = document.getElementById("cat-menu");
        const cat = document.getElementById("forms");
        if (catMenu) {
            catMenu.classList.add("active");
        }
        if (cat) {
            cat.classList.add("show");
            cat.classList.add("active");
        }
    });
</script>

<?= $this->include('admin/common/footer') ?>