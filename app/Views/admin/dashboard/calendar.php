<?= $this->include('admin/common/header') ?>


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <p class="mb-0">Your Calendar</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Calerdar</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar" class="app-fullcalendar"></div>
                    </div>
                </div>
            </div>
            <!-- BEGIN MODAL -->
            <?php
            $permission = session()->get('admin_permission');
            $admin_id = session()->get('admin_id');
            $admin_name = session()->get('admin_name');
            $allUsers = $users;
            // echo "<pre>"; print_r($all_users_json);
            // echo "</pre>";
            $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
            ?>
            <script>
                var currentUser = "<?php echo session()->get('admin_name') ?: 'Admin'; ?>";
                var usersList = <?php echo ($all_users_json); ?>;
                var events = <?php echo ($events); ?>;
                var url = "<?php echo base_url('admin/dashboard/calendar_task_save/' . $token); ?>";
                var updateurl = "<?php echo base_url('admin/dashboard/calendar_task_update/' . $token); ?>";
                var updateurldelete = "<?php echo base_url('admin/dashboard/calendar_task_delete/' . $token); ?>";
                var comurl = "<?php echo base_url('admin/dashboard/calendar_task_complte/' . $token); ?>";
                var commenturl = "<?php echo base_url('admin/dashboard/calendar_task_comment/' . $token); ?>";
                var token = "<?php echo $token; ?>";
                // console.log("event", events);
                // Assume $users is an array of user names
            </script>
            <?php if (in_array('tasks_create', $permissionsArray)): ?>
                <div class="modal fade none-border" id="event-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add New Task</strong></h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button"  class="btn btn-success save-event waves-effect waves-light">Create
                                    Task</button>

                                <button type="button"  class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>


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

<script src="public/assets/js/plugins-init/fullcalendar-init.js"></script>
<?= $this->include('admin/common/footer') ?>