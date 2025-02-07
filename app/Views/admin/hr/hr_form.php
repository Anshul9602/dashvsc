<?= $this->include('admin/common/header') ?>
<div class="content-body">

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6">
                <div class="welcome-text">
                    <h4>Hr Policies</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Hr Policie</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Hr Policie</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Policie</a></li>

                    </ol>
                </div>
            </div>
            <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">

                <button class="btn btn-primary btn-rounded" id="save_btn2">
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
                        <form action="<?php echo base_url('admin/hr_policies/hr_form/' . $token); ?>" method="post"enctype="multipart/form-data">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home1"><i class="la la-home mr-2"></i> General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#profile1"><i class="la la-file mr-2"></i> Media</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                        <div class="row pt-2">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-contro d-none l" name="id" value="">
                                                <input type="text" class="form-control" name="name" placeholder="Hr Policie name">
                                            </div>

                                            <div class="col-sm-4">
                                                <select class="form-control form-control-lg" name="status">
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 pt-4">
                                                <p class="mb-0"> Description</p>
                                                <div class="summernote pt-0"></div>
                                                <!-- Hidden input to store Summernote value -->
                                                <input type="hidden" name="dis" id="description">
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="profile1">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4>Images</h4>
                                                        <hr />
                                                    </div>
                                                    <div class="col-2">
                                                        <img id="previewImage" src="<?php echo base_url('assets/images/card/2.png'); ?>" alt="Selected Image" class="img-thumbnail">
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="file" name="profile_pic" id="imageInput" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <button type="submit" value="submit" class="btn d-none" id="s_btnn2">submit</button>
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
    // Select the input and the image element
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');

    // Add an event listener for file input changes
    imageInput.addEventListener('change', function() {
        const file = this.files[0]; // Get the first file from the input
        if (file) {
            const reader = new FileReader(); // Create a FileReader to read the file
            reader.onload = function(e) {
                previewImage.src = e.target.result; // Set the image src to the file's data URL
            }
            reader.readAsDataURL(file); // Read the file as a data URL
        }
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
        const catMenu = document.getElementById("hr-menu");
        const cat = document.getElementById("hrr");
        if (catMenu) {
            catMenu.classList.add("active");
        }
        if (cat) {
            cat.classList.add("show");
            cat.classList.add("active");
        }
    });
</script>
<script>
    // Attach a click event to the first button
    document.getElementById('save_btn2').addEventListener('click', function() {
        // Trigger a click on the second button
        const noteEditableContent = document.querySelector('.note-editable').innerHTML;
        document.getElementById('description').value = noteEditableContent;
        document.getElementById('s_btnn2').click();
    });
</script>

<?= $this->include('admin/common/footer') ?>