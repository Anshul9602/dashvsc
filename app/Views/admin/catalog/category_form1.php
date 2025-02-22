<?= $this->include('admin/common/header') ?>
<div class="content-body">

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6">
                <div class="welcome-text">
                    <h4>Add Sheet</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Sheets</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sheets</a></li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <button class="btn btn-primary btn-rounded" id="save_btn33">
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
                                        <div class="row pt-2">
                                            <input type="text" class="d-none" name="id" value="">
                                            <div class="col-md-4 mt-3">
                                                <label for="">Organizaion name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Organizaion name">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Branch name</label>
                                                
                                                <select name="branch" id="role" class="form-control">
    <?php if ($roles !== null && !empty($roles)): ?>
        <?php foreach ($roles as $index => $user): ?>
            <option value="<?= $user->name ?>" >
                <?= $user->name ?>
            </option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="Jaipur">Jaipur</option>
    <?php endif; ?>
</select>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Assignment name</label>
                                                <input type="text" class="form-control" name="assignment" placeholder="Assignment name">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for=""> Professinal Fees</label>
                                                <input type="text" class="form-control" name="fee" placeholder="Professinal Fees">
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <label for="">Bill Date </label>
                                                <input type="text" class="form-control" name="bill_date" placeholder="Bill Date ">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Invoice Number</label>
                                                <input type="text" class="form-control" name="invoice_no" placeholder="Invoice Number">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Recovery status</label>
                                                <input type="text" class="form-control" name="recovery_status" placeholder="Recovery status">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Security Deposit</label>
                                                <input type="text" class="form-control" name="security_deposit" placeholder="Security Deposit">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Working Environment</label>
                                                <input type="text" class="form-control" name="working" placeholder="Working Environment">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Completion Certificate Received</label>
                                                <input type="text" class="form-control" name="completion" placeholder="Completion Certificate Received">
                                            </div>
                                           
                                            <div class="col-md-4 mt-3">
                                                <label for="">UDIN</label>
                                                <select class="form-control form-control-lg" name="udin">
                                                    <option value="" selected>Select an option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Udin No</label>
                                                <input type="text" class="form-control" name="udin_no" placeholder="Udin No">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Udin Turnover</label>
                                                <input type="text" class="form-control" name="udin_trun" placeholder="Udin Turnover">
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for=""> Status</label>
                                                <select class="form-control form-control-lg" name="status">
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label for="">Frequency Of Audit</label>
                                                <select class="form-control form-control-lg" name="audit" id="auditFrequency">
                                                    <option value="" selected>Select Frequency</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="quarterly">Quarterly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>
                                            <div id="auditDatesContainer" class="col-md-8 row mt-3">
                                                <!-- Dynamic date fields will be appended here -->
                                            </div>
                                        </div>
                                        <button type="submit" id="s_btnn5" class="btn btn-primary d-none">Submit</button>
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
        $("#auditFrequency").change(function () {
            let frequency = $(this).val();
            let container = $("#auditDatesContainer");
            container.empty(); // Clear previous fields

            let count = 0;
            if (frequency === "monthly") {
                count = 12;
            } else if (frequency === "quarterly") {
                count = 4;
            } else if (frequency === "yearly") {
                count = 1;
            }

            for (let i = 1; i <= count; i++) {
                let dateFields = `
                    <div class="col-md-6 mt-3">
                        <label for="submit_date_${i}">Last Date of Submission ${i} </label>
                        <input type="date" class="form-control" name="submit_date[]" required>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="report_submit_date_${i}">Report Date of Submission ${i} </label>
                        <input type="date" class="form-control" name="report_submit_date[]" required>
                    </div>`;
                container.append(dateFields);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Initially hide the fields
        $('input[name="udin_no"], input[name="udin_trun"]').closest('.col-md-4').hide();

        $('select[name="udin"]').change(function() {
            if ($(this).val() === "yes") {
                $('input[name="udin_no"], input[name="udin_trun"]').closest('.col-md-4').show();
            } else {
                $('input[name="udin_no"], input[name="udin_trun"]').closest('.col-md-4').hide();
            }
        });
    });
</script>
<script>
    document.getElementById('save_btn33').addEventListener('click', function() {
        // Trigger a click on the second button
        document.getElementById('s_btnn5').click();
    });
    // Attach a click event to the first button

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