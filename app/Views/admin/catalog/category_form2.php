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
                                                <label for="">Status</label>
                                                <select class="form-control form-control-lg" name="status">
                                                    <option value="1" <?= ($cat->status == "1") ? "selected" : "" ?>>Enable</option>
                                                    <option value="0" <?= ($cat->status == "0") ? "selected" : "" ?>>Disable</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Frequency Of Audit</label>
                                                <select class="form-control form-control-lg" name="audit" id="auditFrequency">
                                                    <option value="">Select Frequency</option>
                                                    <option value="monthly" <?= ($cat->audit == "monthly") ? "selected" : "" ?>>Monthly</option>
                                                    <option value="quarterly" <?= ($cat->audit == "quarterly") ? "selected" : "" ?>>Quarterly</option>
                                                    <option value="half" <?= ($cat->audit == "half") ? "selected" : "" ?>>Half Yearly</option>
                                                    <option value="yearly" <?= ($cat->audit == "yearly") ? "selected" : "" ?>>Yearly</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 row m-0">
                                                <div id="auditDatesContainer" class="row col-md-12 mt-3 pl-0 m-0"></div>
                                                <div id="bill_date" class=" row col-md-12 mt-1 pl-0 m-0"></div>
                                                <div id="recovery_status" class=" row col-md-12 mt-1 pl-0 m-0"></div>
                                                <div id="completion" class="col-md-4 mt-3 pl-0 "></div>
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
                                            </div>






                                            <!-- UDIN -->





                                            <!-- Frequency of Audit -->



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
    $(document).ready(function() {
        let fee = "<?= $cat->fee ?>".split(',');
        let submitDates = "<?= $cat->submit_date ?>".split(',');
        let reportSubmitDates = "<?= $cat->report_submit_date ?>".split(',');
        let BillDates = "<?= $cat->bill_date ?>".split(',');
        let invoice_no = "<?= $cat->invoice_no ?>".split(',');
        let invoice_amount = "<?= $cat->invoice_amount ?>".split(',');
        let recovery_status = "<?= $cat->security_deposit ?>".split(',');
        let security_deposit = "<?= $cat->security_deposit ?>".split(',');
        let working = "<?= $cat->working ?>".split(',');
        let completion = "<?= $cat->completion ?>".split(',');

        let frequency = "<?= $cat->audit ?>"; // Get selected frequency from PHP

        $("#auditFrequency").val(frequency); // Set selected audit frequency
        let container = $("#auditDatesContainer");
        container.empty(); // Clear previous fields
        // let fees = $("#fees");  fees.empty(); // Clear previous fields
        let bill_date = $("#bill_date");
        bill_date.empty(); // Clear previous fields

        let recovery_status1 = $("#recovery_status");
        recovery_status1.empty(); // Clear previous fields

        let completion1 = $("#completion");
        completion1.empty(); // Clear previous fields

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
            let feeValue = fee[i] ? fee[i] : "";
            let submitDateValue = submitDates[i] ? submitDates[i] : "";
            let reportSubmitDateValue = reportSubmitDates[i] ? reportSubmitDates[i] : "";
            let bill_dateValue = bill_date[i] ? bill_date[i] : "";
            let dateFields = `
                <div class="col-md-4 mt-3 pl-0">
                    <label for="">Professinal Fees ${i + 1}</label>
                    <input type="text" class="form-control" name="fee[]"  value="${feeValue}">
                </div>
           
                <div class="col-md-4 mt-3 ">
                    <label>Last Date of Submission ${i + 1}</label>
                    <input type="date" class="form-control" name="submit_date[]" value="${submitDateValue}" >
                </div>
                <div class="col-md-4 mt-3 ">
                    <label>Report Date of Submission ${i + 1}</label>
                    <input type="date" class="form-control" name="report_submit_date[]" value="${reportSubmitDateValue}" >
                </div>
                
                `;
            container.append(dateFields);
        }
        for (let i = 0; i < count; i++) {
            let bill_dateValue = bill_date[i] ? bill_date[i] : "";
            let invoice_noValue = invoice_no[i] ? invoice_no[i] : "";
            let invoice_amountValue = invoice_amount[i] ? invoice_amount[i] : "";
            let dateFields = `
             <div class="col-md-4 mt-3 pl-0">
            
                    <label>Bill Date  ${i + 1}</label>
                    <input type="date" class="form-control" name="bill_date[]" value="${bill_dateValue}" >
                </div>
             <div class="col-md-4 mt-3 ">
                    <label>Invoice Number  ${i + 1}</label>
                   <input type="text" class="form-control" name="invoice_no[]"  value="${invoice_noValue}">
                </div>
             <div class="col-md-4 mt-3 ">
                    <label>Invoice Amount  ${i + 1}</label>
                   <input type="text" class="form-control" name="iinvoice_amount[]"  value="${invoice_amountValue}">
                </div>
            
                `;
            bill_date.append(dateFields);
        }

        for (let i = 0; i < count; i++) {
            let recovery_statusValue = recovery_status[i] ? recovery_status[i] : "";
            let security_depositValue = security_deposit[i] ? security_deposit[i] : "";
            let workingValue = working[i] ? working[i] : "";
            let dateFields = `
                <div class="col-md-4 mt-3 pl-0">
                
                        <label>Recovery Status  ${i + 1}</label>
                        <input type="text" class="form-control" name="recovery_status[]" value="${recovery_statusValue}" >
                    </div>
                <div class="col-md-4 mt-3 ">
                        <label>Security Deposit  ${i + 1}</label>
                        <input type="text" class="form-control" name="security_deposit[]" value="${security_depositValue}" >
                    </div>
                <div class="col-md-4 mt-3 ">
                        <label>Working Environment  ${i + 1}</label>
                        <input type="text" class="form-control" name="working[]" value="${workingValue}" >
                    </div>
            
                `;
                recovery_status1.append(dateFields);
        }

        for (let i = 0; i < count; i++) {
            let completionValue = completion[i] ? completion[i] : "";
            let dateFields = `
                <div class="col-md-12 mt-3 pl-0">
                
                        <label>Completion Certificate Received  ${i + 1}</label>
                        <input type="text" class="form-control" name="completion[]" value="${completionValue}" >
                    </div>
                `;
                completion1.append(dateFields);
        }


        $("#auditFrequency").change(function() {
            let newFrequency = $(this).val();
            container.empty(); // Clear previous fields
            bill_date.empty(); // Clear previous fields
            recovery_status1.empty(); // Clear previous fields
            completion1.empty(); // Clear previous fields

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

            for (let i = 1; i <= newCount; i++) {
                let dateFields = `<div class="col-md-4 mt-3 pl-0">
                                        <label for=""> Professinal Fees ${i}</label>
                                        <input type="text" class="form-control" name="fee[]" placeholder="Professinal Fees">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="submit_date">Last Date of Submission ${i} </label>
                                        <input type="date" class="form-control" name="submit_date[]">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="report_submit_date">Report Date of Submission ${i} </label>
                                        <input type="date" class="form-control" name="report_submit_date[]">
                                    </div>`;

                container.append(dateFields);

            }
            for (let i = 1; i <= newCount; i++) {

                let dateFields2 = `<div class="col-md-4 mt-3 pl-0">
                                        <label for="bill_date">Bill Date ${i}</label>
                                        <input type="date" class="form-control" name="bill_date[]">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="">Invoice Number ${i}</label>
                                        <input type="text" class="form-control" name="invoice_no[]" placeholder="Invoice Number">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="">Invoice Amount ${i}</label>
                                        <input type="text" class="form-control" name="invoice_amount[]" placeholder="Invoice amount">
                                    </div>`;

                bill_date.append(dateFields2);

            }
            for (let i = 1; i <= newCount; i++) {

                let dateFields3 = `<div class="col-md-4 mt-3 ">
                                        <label for="">Recovery status ${i}</label>
                                        <input type="text" class="form-control" name="recovery_status[]" placeholder="Recovery status">
                                    </div>
                                    <div class="col-md-4 mt-3 ">
                                        <label for="">Security Deposit ${i}</label>
                                        <input type="text" class="form-control" name="security_deposit[]" placeholder="Security Deposit">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="">Working Environment ${i}</label>
                                        <input type="text" class="form-control" name="working[]" placeholder="Working Environment">
                                    </div>`;

                recovery_status1.append(dateFields3);

            }
            for (let i = 1; i <= newCount; i++) {

                let dateFields4 = ` <div class="col-md-12 mt-3 pl-0">
                                                    <label for="">Completion Certificate Received ${i}</label>
                                                    <input type="text" class="form-control" name="completion[]" placeholder="Completion Certificate Received">
                                                </div>`;

                completion1.append(dateFields4);
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