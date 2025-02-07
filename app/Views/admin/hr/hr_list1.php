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
          <h4>HR Policies</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">HR Policie</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">HR Policie</a></li>
          </ol>
        </div>
      </div>
      <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
      <?php 
$permission = session()->get('admin_permission'); 

$permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
?>
<?php if (in_array('hr_policies_create', $permissionsArray)): ?>
        <a href="<?php echo base_url('admin/hr_policies/hr_form/' . $token); ?>">
          <button class="btn btn-primary btn-rounded">
            <li class="fa fa-plus"></li>
          </button>
        </a>
        &nbsp;     <?php endif; ?>


      </div>
    </div>
    <!-- row -->
    <div class="row">
      <?php if ($users !== null && !empty($users)):
        ?>

      <?php foreach ($users as $index => $user): ?>
      <div class="col-md-3 mt-3">

        <div class="card">
          <img width="100%" class="img-thumbnail" src="<?php echo base_url(''); ?><?= $user->profile_pic ?>" alt="" />
          <div class="card-body p-3">

            <div class="contentt">
              <h4>
                <?= $user->name ?>
              </h4>
              <p>
                <?= $user->dis ?>
              </p>
              <p>
                <?= $user->created_at ?>
              </p>
            </div>



          </div>

        </div>
      </div>
        <?php endforeach; ?>
        <?php else: ?>

        <?php endif; ?>
     

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
          Are you sure you want to delete this Hr Policie?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Ensure the script runs after the DOM is fully loaded
      document.querySelectorAll('[data-bs-target="#deleteModal"]').forEach(button => {
        button.addEventListener('click', function () {
          // Get the URL from the button's data-url attribute
          const url = this.getAttribute('data-url');
          // Set the href of the confirmation button in the modal
          document.getElementById('confirmDeleteBtn').setAttribute('href', url);
        });
      });
    });
  </script>

</div>
<?= $this->include('admin/common/footer') ?>