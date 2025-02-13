<?= $this->include('admin/common/header') ?>
<div class="content-body">

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6">
                <div class="welcome-text">
                    <h4>Add Category</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Categories</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Category</a></li>

                    </ol>
                </div>
            </div>
            <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
               
                    <button class="btn btn-primary btn-rounded"id="save_btn11">
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
                        <form action="<?php echo base_url('admin/catalog/category_form/'. $token); ?>" method="post">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home1"><i class="la la-home mr-2"></i> General</a>
                                    </li>
                                  
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                        <div class="row pt-2">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="name" placeholder="Organizaion name">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="branch" placeholder="Branch name">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="assignment" placeholder="Assignment name">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="audit" placeholder="Frequency Of Audit">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="fee" placeholder="Professinal Fees">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="submit_date" placeholder="Last Date of Submission">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="report_submit_date" placeholder="Report Date of Submission">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="bill_date" placeholder="Bill Date ">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="invoice_no" placeholder="Invoice Number">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="recovery_status" placeholder="Recovery Status">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="security_deposit" placeholder="Security Deposit">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="working" placeholder="Working Environment">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="completion" placeholder="Completion Certificate Received">
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control form-control-lg" name="status">
                                                    <option value="Enable">Enable</option>
                                                    <option value="Disable">Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 pt-4">
                                                <p class="mb-0">Category Cover</p>
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
    // Attach a click event to the first button
    document.getElementById('save_btn11').addEventListener('click', function() {
        // Trigger a click on the second button
        document.getElementById('s_btnn5').click();
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