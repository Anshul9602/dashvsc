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
                <button class="btn btn-danger btn-rounded" onclick="history.back();">
    <i class="fa fa-arrow-left"></i> <!-- Use <i> instead of <li> -->
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
                                                <label for="">Type</label>
                                                <select class="form-control form-control-lg" name="type">
                                                    <option value="" selected>Select an option</option>
                                                    
                                                    <option value="Empanel" <?= ($cat->type == "Empanel") ? "selected" : "" ?>>Empanel</option>
                                                    <option value="WO" <?= ($cat->type == "WO") ? "selected" : "" ?>>WO</option>
                                                </select>
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
                                                <label for="">Bill Type</label>
                                                <select class="form-control form-control-lg" name="bill_type" id="bill_type">
                                                    <option value="">Select date</option>
                                                    <option value="monthly" <?= ($cat->bill_type == "monthly") ? "selected" : "" ?>>Monthly</option>
                                                    <option value="quarterly" <?= ($cat->bill_type == "quarterly") ? "selected" : "" ?>>Quarterly</option>
                                                    <option value="half"<?= ($cat->bill_type == "half") ? "selected" : "" ?>>Half Yearly</option>
                                                    <option value="yearly" <?= ($cat->bill_type == "yearly") ? "selected" : "" ?>>Yearly</option>
                                                </select>
                                            </div>
                                            <div id="auditDatesContainer1" class="col-md-4 row ">
                                                <!-- Dynamic date fields will be appended here -->
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Frequency Of Audit</label>
                                                <select class="form-control form-control-lg" name="audit" id="auditFrequency">
                                                    <option value="">Select Frequency</option>
                                                    <option value="monthly" <?= ($cat->audit == "monthly") ? "selected" : "" ?>>Monthly</option>
                                                    <option value="quarterly" <?= ($cat->audit == "quarterly") ? "selected" : "" ?>>Quarterly</option>
                                                    <option value="half"<?= ($cat->audit == "half") ? "selected" : "" ?>>Half Yearly</option>
                                                    <option value="yearly" <?= ($cat->audit == "yearly") ? "selected" : "" ?>>Yearly</option>
                                                </select>
                                            </div>
                                            <div id="auditDatesContainer" class="col-md-8 row ">
                                                <!-- Dynamic date fields will be appended here -->
                                            </div>
                                            <!-- Submit Date Fields -->
                                            
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        let BillDates = "<?= $cat->bill_date ?>".split(',');
       
        let frequency1 = "<?= $cat->bill_type ?>"; // Get selected frequency from PHP

        $("#bill_type").val(frequency1); // Set selected audit frequency
        let container1 = $("#auditDatesContainer1");
        container1.empty(); // Clear previous fields

        let count = 0;
        if (frequency1 === "monthly") {
            count = 12;
        } else if (frequency1 === "quarterly") {
            count = 4;
        } else if (frequency1 === "half") {
            count = 2;
        } else if (frequency1 === "yearly") {
            count = 1;
        }

        for (let i = 0; i < count; i++) {
            let BillDatesValue = BillDates[i] ? BillDates[i] : "";
           

            let dateFields = `
                <div class="col-md-12 mt-3">
                    <label>Bill Date ${i + 1}</label>
                    <input type="date" class="form-control" name="bill_date[]" value="${BillDatesValue}" >
                </div>
               `;
            container1.append(dateFields);
        }

        $("#bill_type").change(function () {
            let newFrequency1 = $(this).val();
            container1.empty(); // Clear previous fields

            let newCount = 0;
            if (newFrequency1 === "monthly") {
                newCount = 12;
            } else if (newFrequency1 === "quarterly") {
                newCount = 4;
            } else if (newFrequency1 === "half") {
                newCount = 2;
            } else if (newFrequency1 === "yearly") {
                newCount = 1;
            }

            for (let i = 0; i < newCount; i++) {
                let dateFields = `
                    <div class="col-md-12 mt-3">
                        <label>Bill Date ${i + 1}</label>
                        <input type="date" class="form-control" name="bill_date[]" >
                    </div>
                    `;
                container1.append(dateFields);
            }
        });
    });
    $(document).ready(function () {
        let submitDates = "<?= $cat->submit_date ?>".split(',');
        let reportSubmitDates = "<?= $cat->report_submit_date ?>".split(',');
        let frequency = "<?= $cat->audit ?>"; // Get selected frequency from PHP

        $("#auditFrequency").val(frequency); // Set selected audit frequency
        let container = $("#auditDatesContainer");
        container.empty(); // Clear previous fields

        let count = 0;
        if (frequency === "monthly") {
            count = 12;
        } else if (frequency === "quarterly") {
            count = 4;
        } else if (frequency === "half") {
            count = 2;
        } else if (frequency === "yearly") {
            count = 1;
        }

        for (let i = 0; i < count; i++) {
            let submitDateValue = submitDates[i] ? submitDates[i] : "";
            let reportSubmitDateValue = reportSubmitDates[i] ? reportSubmitDates[i] : "";

            let dateFields = `
                <div class="col-md-6 mt-3">
                    <label>Last Date of Submission ${i + 1}</label>
                    <input type="date" class="form-control" name="submit_date[]" value="${submitDateValue}" >
                </div>
                <div class="col-md-6 mt-3">
                    <label>Report Date of Submission ${i + 1}</label>
                    <input type="date" class="form-control" name="report_submit_date[]" value="${reportSubmitDateValue}" >
                </div>`;
            container.append(dateFields);
        }

        $("#auditFrequency").change(function () {
            let newFrequency = $(this).val();
            container.empty(); // Clear previous fields

            let newCount = 0;
            if (newFrequency === "monthly") {
                newCount = 12;
            } else if (newFrequency === "quarterly") {
                newCount = 4;
            } else if (newFrequency === "half") {
                newCount = 2;
            } else if (newFrequency === "yearly") {
                newCount = 1;
            }

            for (let i = 0; i < newCount; i++) {
                let dateFields = `
                    <div class="col-md-6 mt-3">
                        <label>Last Date of Submission ${i + 1}</label>
                        <input type="date" class="form-control" name="submit_date[]" >
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Report Date of Submission ${i + 1}</label>
                        <input type="date" class="form-control" name="report_submit_date[]" >
                    </div>`;
                container.append(dateFields);
            }
        });
    });
</script>
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