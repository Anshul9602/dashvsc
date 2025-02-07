<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .role-f {
    display: none !important;
  }

  .header-left .search_bar .search_icon {
    margin-top: 13px;
  }
</style>


<?= $this->include('admin/common/header') ?>
<div class="content-body">
  <style>
    /* The switch - the box around the slider */
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
  <div class="container-fluid">
    <div class="row page-titles mx-0">
      <div class="col-sm-6">
        <div class="welcome-text">
          <h4>HR Notices</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">HR Notice</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">HR Notice</a></li>
          </ol>
        </div>
      </div>
      <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <?php
        $permission = session()->get('admin_permission');

        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
        ?>
        <?php if (in_array('hr_policies_create', $permissionsArray)): ?>

          <a href="<?php echo base_url('admin/hr_notice/hr_form/' . $token); ?>">
            <button class="btn btn-primary btn-rounded">
              <li class="fa fa-plus"></li>
            </button>
          </a>
          &nbsp; <?php endif; ?>

        <button class="btn btn-danger btn-rounded d-none">
          <li class="fa fa-trash"></li>
        </button>
        &nbsp;
        <button class="btn btn-warning btn-rounded d-none">
          <li class="fa fa-download"></li>
        </button>
        &nbsp;
        <button class="btn btn-info btn-rounded d-none">
          <li class="fa fa-upload"></li>
        </button>
        &nbsp;
        <button class="btn btn-success btn-rounded d-none">
          <li class="fa fa-copy"></li>
        </button>

      </div>
    </div>
    <!-- row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
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
                    <th>Cover</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th>Date added</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if ($users !== null && !empty($users)):
                  ?>

                    <?php foreach ($users as $index => $user): ?>
                      <tr>

                        <td>
                          <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                            <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                            <label class="custom-control-label" for="checkAll"></label>
                          </div>
                        </td>
                        <td>
                          <img width="100" class="img-thumbnail" src="<?php echo base_url(''); ?><?= $user->profile_pic ?>" alt="" />
                        </td>
                        <td>
                          <?= $user->name ?>
                        </td>
                        <td>
                          <?= $user->dis ?></td>
                        <td> <?= $user->id ?></td>

                        <td>
                          <label class="switch">
                            <input type="checkbox" data-id="<?= $user->id ?>"
                              id="switch<?= $user->id ?>" <?= $user->status == '1' ? 'checked' : '' ?> <?php
                                                                                                        $permission = session()->get('admin_permission');

                                                                                                        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
                                                                                                        ?>
                              <?php if (in_array('hr_policies_edit', $permissionsArray)): ?>class="status_update" <?php endif; ?> value="<?= $user->status ?>">
                            <span class="slider round"></span>
                          </label>
                        </td>

                        <td><a href="javascript:void(0);"><strong> <?= $user->created_at ?></a></strong></td>
                        <td>
                          <div class="d-flex">
                            <?php
                            $permission = session()->get('admin_permission');

                            $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
                            ?>
                            <?php if (in_array('hr_policies_edit', $permissionsArray)): ?>
                              <a href="<?php echo base_url('admin/hr_notice/hr_form_value/' . $user->id); ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a><?php endif; ?><?php
                                                                                                                                                                                                        $permission = session()->get('admin_permission');

                                                                                                                                                                                                        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
                                                                                                                                                                                                        ?>
                              <?php if (in_array('hr_policies_delete', $permissionsArray)): ?>
                                <a href="javascript:void(0);"
                                  class="btn btn-danger shadow btn-xs sharp"
                                  data-bs-toggle="modal"
                                  data-bs-target="#deleteModal"
                                  data-url="<?php echo base_url('admin/hr_notice/hr_delete/' . $user->id); ?>">
                                  <i class="fa fa-trash"></i>
                                </a> <?php endif; ?>
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
    </div>

  </div>

</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this HR Notice?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $('.status_update').click(function() {
    var deptId = $(this).data('id'); // Get the data-id attribute of the clicked checkbox
    // var status = $(this).value('data'); // Get the data-id attribute of the clicked checkbox

    $.ajax({
      type: 'POST',
      url: `<?= base_url('/admin/hr_policies/status_update') ?>/${deptId}`,
      success: function(response) {
        location.reload(); // Reload the page upon successful AJAX request
      },
      error: function(xhr, status, error) {
        // Handle any errors here
        console.error('Error:', error);
      }
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    // Ensure the script runs after the DOM is fully loaded
    document.querySelectorAll('[data-bs-target="#deleteModal"]').forEach(button => {
      button.addEventListener('click', function() {
        // Get the URL from the button's data-url attribute
        const url = this.getAttribute('data-url');
        // Set the href of the confirmation button in the modal
        document.getElementById('confirmDeleteBtn').setAttribute('href', url);
      });
    });
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

</div> <?= $this->include('admin/common/footer') ?>