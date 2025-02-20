<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->include('admin/common/header') ?>


<div class="content-body">
<style>
        .role-f {
            display: none !important;
        }
        </style>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Users</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <?php
                $permission = session()->get('admin_permission');

                $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
                ?>
                <?php if (in_array('users_create', $permissionsArray)): ?><a href="<?php echo base_url('admin/candidates/candidates_form/' . $token); ?>">
                        <button type="button" class="btn btn-rounded btn-primary open-add-form">
                            <span class="btn-icon-left text-primary">
                                <i class="fa fa-plus"></i>
                            </span>Add New User
                        </button>
                    </a><?php endif; ?>
            </div>
        </div>
        <!-- Filter Row -->

        <!-- Filter Row End -->

        <!-- Candidate List Start -->
        <div class="col-12 mx-0 mtm-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                            <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($roles !== null && !empty($roles)): ?>
                                    <?php foreach ($roles as $index => $user): ?>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                    <label class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </td>

                                            <td><?= $user->name ?></td>

                                            <td>Mobile :<?= $user->mobile_number ?>



                                            </td>
                                            <td><?= $user->role ?></td>
                                            <td><?= $user->email ?></td>

                                            <td>

                                                <label class="switch">
                                                    <input type="checkbox" data-id="<?= $user->id ?>"
                                                        id="switch<?= $user->id ?>" <?= $user->status == 'Enable' ? 'checked' : '' ?> <?php
                                                                                                                                        $permission = session()->get('admin_permission');

                                                                                                                                        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
                                                                                                                                        ?>
                                                        <?php if (in_array('users_edit', $permissionsArray)): ?>class="status_update" <?php endif; ?> value="<?= $user->status ?>">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td><a href="javascript:void(0);"><strong>
                                                        <?= $user->created_at ?>
                                                </a></strong></td>
                                            <td>
                                                <div class="d-flex">
                                                    <?php
                                                    $permission = session()->get('admin_permission');

                                                    $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
                                                    ?>
                                                    <?php if (in_array('users_edit', $permissionsArray)): ?><a href="<?php echo base_url('admin/candidates/candidates_form_value/' . $user->id); ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a><?php endif; ?><?php $permission = session()->get('admin_permission');$permissionsArray = explode(',', $permission);  ?>
                                                        <?php if (in_array('users_delete', $permissionsArray)): ?>
                                                            <a href="javascript:void(0);"
                                                                class="btn delete-user btn-danger shadow btn-xs sharp"
                                                                data-bs-toggle="modal"
                                                                data-id="<?php echo $user->id; ?>"
                                                                data-bs-target="#deleteModal"
                                                                data-url="<?php echo base_url('admin/candidates/view/delete/' . $user->id); ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </a><?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>

                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Candidate List End -->

    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this admin?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger confirm-delete">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal End -->

<!-- Overlay -->
<div class="overlay"></div>

<!-- Add New Candidate Form -->
<div class="right-sidebar big d-none" id="addCandidateForm">
    <div class="sliding-form">
        <?= $this->include('admin/candidates/candidate_form') ?>
    </div>
</div>
<!-- Overlay -->
<div class="overlay"></div>

<!-- Add New Candidate Form -->
<div class="right-sidebar big d-none" id="userInfo">
    <div class="sliding-form">
        <?= $this->include('admin/candidates/user_info_slider') ?>
    </div>
</div>
<div class="right-sidebar big d-none" id="userref">
    <div class="sliding-form">
        <?= $this->include('admin/candidates/user_info_slider1') ?>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Operation completed successfully.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
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
        const catMenu = document.getElementById("user-menu");
        const cat = document.getElementById("apps");
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




    $('.open-edit-form').click(function() {
        var deptId = $(this).data('id');
        $.get(`<?= base_url('admin/candidates/view/getbyid') ?>/${deptId}`, function(data) {

            var userData = data[0];

            console.log(userData);
            // Populate form fields with userData
            $('#phone_number').val(userData.phone_number);
            $('#points').val(userData.points);
            $('#first_name').val(userData.user.name);
            $('#last_name').val(userData.user.last_name);
            $('#email').val(userData.user.email);
            $('#gender').val(userData.user.gender);
            $('#address').val(userData.user.address);
            $('#pin_code').val(userData.user.pin_code);
            $('#state').val(userData.user.state);
            $('#dob').val(userData.user.dob);
            $('#profile_pic').val(userData.user.user_img);
            $('#profile_pic_preview').attr('src', userData.user_img);
            // $('#profile_img').attr('src', userData.user_img);

            // Populate job preference fields
            if (userData.job_pref) {
                var jobPref = userData.job_pref[0];
                console.log(jobPref);
                $('#job_type').val(jobPref.job_type);
                $('#preferred_state').val(jobPref.pref_state);
                $('#preferred_city').val(jobPref.pref_city);
                $('#salary_range').val(jobPref.salary);
            }

            // Populate education fields
            if (userData.user_edu) {
                var edu = userData.user_edu[0];
                if (edu.ten_th === "on") {
                    $('#tenth_pass').prop('checked', true);
                } else if (edu.ten_th === "false") {
                    $('#tenth_pass').prop('checked', false);
                }
                $('#ten_school').val(edu.ten_school);
                $('#ten_year').val(edu.ten_year);
                if (edu.to_th === "on") {
                    $('#twelfth_pass').prop('checked', true);
                } else if (edu.to_th === "false") {
                    $('#twelfth_pass').prop('checked', false);
                }

                $('#to_th_school').val(edu.to_th_school);
                $('#to_th_year').val(edu.to_th_year);
                $('#graduate').prop('checked', edu.gra_dip === "true");
                $('#gr_degree').val(edu.gr_degree);
                $('#gr_university').val(edu.gr_university);
                $('#gr_year').val(edu.gr_year);
                $('#post_graduate').prop('checked', edu.post_gra === "true");
                $('#pg_degree').val(edu.pg_degree);
                $('#pg_university').val(edu.pg_university);
                $('#pg_year').val(edu.pg_year);
                $('#doctorate').prop('checked', edu.doc === "true");
                $('#doc_degree').val(edu.doc_degree);
                $('#doc_university').val(edu.doc_university);
                $('#doc_year').val(edu.doc_year);
                $('#hotel_management').prop('checked', edu.hotel_de === "true");
                $('#h_college').val(edu.h_college);
                $('#h_year').val(edu.h_year);
            }


            $('#formTitle').text('Edit User Data');
            $('#addCandidateForm').addClass('show');
            $('.overlay').addClass('show');
        });
    });

    $('.delete-user').click(function() {
        var deptId = $(this).data('id');

        console.log(deptId);
        $('.confirm-delete').attr('data-id', deptId);
    });

    $('.confirm-delete').click(function() {
        var deptId = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: `<?= base_url('/admin/candidates/view/delete') ?>/${deptId}`,
            success: function(response) {
                location.reload();
            }
        });
    });
    $('.status_update').click(function() {
        var deptId = $(this).data('id'); // Get the data-id attribute of the clicked checkbox
        // var status = $(this).value('data'); // Get the data-id attribute of the clicked checkbox

        $.ajax({
            type: 'POST',
            url: `<?= base_url('/admin/candidates/view/status_update') ?>/${deptId}`,
            success: function(response) {
                location.reload(); // Reload the page upon successful AJAX request
            },
            error: function(xhr, status, error) {
                // Handle any errors here
                console.error('Error:', error);
            }
        });
    });

    $(document).ready(function() {
        $('.open-add-form').click(function() {
            $('#addCandidateForm').addClass('show');
            $('.overlay').addClass('show');
        });
        $('.close-form, .overlay').click(function() {
            $('.right-sidebar').removeClass('show');
            $('.overlay').removeClass('show');
        });

    });
</script>

<?= $this->include('admin/common/footer') ?>