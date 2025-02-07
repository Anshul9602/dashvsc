
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<style>
   .role-f{
        display: none !important;
    }
    .header-left .search_bar .search_icon {
      margin-top: 13px;}
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
          <h4>Tasks</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Tasks</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tasks</a></li>
          </ol>
        </div>
      </div>
      <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
      

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
                   
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Created_by</th>
                    <th>Assign</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>Date</th>
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
                          <?= $user->title ?>
                        </td>
                        <td>
                          <?= $user->des ?></td>
                        <td> <?= $user->category ?></td>
                        <td> <?= $user->created_by ?></td>
                        <td> <?= $user->assign ?></td>
                        <td> <?= $user->comment ?></td>
                        <td> <?= $user->status ?></td>
<td>  <a href="javascript:void(0);"><strong> <?= $user->created_at; ?></strong></a>
</td>
                     
                      
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>

                      <td>
                        <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                          <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                          <label class="custom-control-label" for="checkAll"></label>
                        </div>
                      </td>
                      <td>
                        <img width="100" class="img-thumbnail" src="<?php echo base_url('assets/images/card/2.png'); ?>" alt="" />
                      </td>
                      <td>
                        Checkbox
                      </td>
                      <td>
                        consectetur adipisicing elit. Dolorum, laudantium et magni rerum fuga id nulla libero. Quibusdam, alias et?</td>
                      <td>1</td>

                      <td>
                        <label class="switch">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>
                      </td>

                      <td><a href="javascript:void(0);"><strong>22/10/2022</a></strong></td>
                      <td>
                        <div class="d-flex">
                          <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                          <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
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
        Are you sure you want to delete this Tasks?
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
    const catMenu = document.getElementById("cal-menu");
    const cat = document.getElementById("calendar1");
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