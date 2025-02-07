<?= $this->include('admin/common/header') ?>
<div class="content-body">
   <style>
      .dropdown.bootstrap-select.show-tick,
      .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
         width: 100%;
      }

      .role-f {
         display: none !important;
      }
   </style>
   <div class="container-fluid">
      <div class="row page-titles mx-0">
         <div class="col-sm-6">
            <div class="welcome-text">
               <h4>Add Unit Product</h4>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0)">Sheets</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Sheet</a></li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <button class="btn btn-primary btn-rounded" id="save_btn3">
               Save
            </button>
            &nbsp;

            <button class="btn btn-danger btn-rounded" onclick="window.history.back();">
               <i class="fa fa-arrow-left"></i>
            </button>

         </div>
      </div>
      <!-- row -->
      <style>
         #persel .bootstrap-select {
            width: 100%;
         }

         .tt .tab-pane.fade {
            display: none;
         }

         .tt .tab-pane.fade.show {
            display: block;
         }
      </style>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <!-- Nav tabs -->
                  <div class="custom-tab-1">
                     <ul class="nav nav-tabs">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#home1">
                              <i class="la la-home mr-2"></i> General
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " data-toggle="tab" href="#home2">
                              <i class="la la-home mr-2"></i> Permission
                           </a>
                        </li>
                     </ul>
                     <div class="tab-content tt">
                        <form action="<?php echo base_url('admin/sheet_form_update/' . $token); ?>" method="post" enctype="multipart/form-data">
                           <div class="tab-pane fade show active" id="home1" role="tabpanel">
                              <input type="text" name="dis" class="form-control d-none" value="<?php echo htmlspecialchars($user['dis']); ?>" placeholder="Sheet name">

                              <div class="row pt-2">
                                 <div class="col-sm-4">
                                    <p class="mb-0">Sheet Name</p>
                                    <input type="text" class="form-contro d-none l" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" placeholder="Sheet name">
                                 </div>
                                 <div class="col-sm-4">
                                    <p class="mb-0">Sheet Category</p>
                                    <select id="workSelection" name="sheet_cat" style="width: 100%;">
                                       <option value="sheet" <?php echo $user['sheet_cat'] == 'sheet' ? 'selected' : ''; ?>>Sheet</option>
                                       <option value="forms" <?php echo $user['sheet_cat'] == 'forms' ? 'selected' : ''; ?>>Forms</option>
                                       <option value="dashboard" <?php echo $user['sheet_cat'] == 'dashboard' ? 'selected' : ''; ?>>Dashboard</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-4">
                                    <p class="mb-0">Status</p>
                                    <select class="form-control form-control-lg" name="status">
                                       <option value="1" <?php echo $user['status'] == 1 ? 'selected' : ''; ?>>Enable</option>
                                       <option value="0" <?php echo $user['status'] == 0 ? 'selected' : ''; ?>>Disable</option>
                                    </select>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-sm-4 pt-4">
                                    <p class="mb-0">Category List</p>
                                    <select id="workSelection" name="cat[]" multiple style="width: 100%;">
                                       <?php if (!empty($cat)): ?>
                                          <?php foreach ($cat as $category): ?>
                                             <option value="<?php echo htmlspecialchars($category->name); ?>"
                                                <?php echo in_array($category->name, explode(',', $user['cat'] ?? '')) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category->name); ?>
                                             </option>
                                          <?php endforeach; ?>
                                       <?php else: ?>
                                          <option value="writer">Writer</option>
                                       <?php endif; ?>
                                    </select>
                                 </div>
                                 <div class="col-sm-4 pt-4">
                                    <p class="mb-0">Sheet Url</p>
                                    <input type="text" name="sheet_url" value="<?php echo htmlspecialchars($user['sheet_url']); ?>" class="form-control" placeholder="Existing Sheet Url">
                                 </div>
                                 <div class="col-sm-4 pt-4">
                                    <p class="mb-0">Cover Image</p>
                                    <input type="file" name="cover_pic" id="cover_pic" class="form-control">
                                    <small id="error-msg" style="color: red;">Image size must be 200x200 pixels.</small>
                                 </div>
                              </div>
                           </div>

                           <div class="tab-pane fade" id="home2">
                              <div class="table-responsive">
                                 <table class="table table-responsive-md">
                                    <thead>
                                       <tr>
                                          <th><strong>User Name</strong></th>
                                          <th><strong>Email</strong></th>
                                          <th><strong>Edit Access</strong></th>
                                          <th><strong>View Access</strong></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php if (!empty($users)): ?>
                                          <?php foreach ($users as $user): ?>
                                             <?php
                                             // Initialize permissions for the user
                                             $user->permissions = [];

                                             // Match user email with the parsed permissions data
                                             foreach ($permissionsData as $perm) {
                                                if ($perm['email'] === $user->admin_email) {
                                                   $user->permissions = $perm['permissions'];
                                                   break;
                                                }
                                             }
                                             ?>
                                             <tr>
                                                <!-- Checkbox for selecting the user -->
                                                <td>
                                                   <input class="form-check-input"
                                                      type="checkbox"
                                                      name="selected_users[<?php echo $user->admin_id; ?>]"
                                                      value="1"
                                                      <?php echo !empty($user->permissions) ? 'checked' : ''; ?>>
                                                   <strong><?php echo htmlspecialchars($user->admin_name); ?></strong>
                                                   <input type="hidden" name="permissions[<?php echo $user->admin_id; ?>][user_name]" value="<?php echo htmlspecialchars($user->admin_name); ?>">

                                                </td>

                                                <!-- Email Display -->
                                                <td>
                                                   <strong><?php echo htmlspecialchars($user->admin_email); ?></strong>
                                                   <input type="hidden" name="permissions[<?php echo $user->admin_id; ?>][user_email]" value="<?php echo htmlspecialchars($user->admin_email); ?>">

                                                </td>

                                                <!-- Permission Checkboxes -->
                                                <?php foreach (['sheets_view', 'sheets_edit'] as $sheetPermission): ?>
                                                   <td>
                                                      <div class="form-check">
                                                         <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="permissions[<?php echo $user->admin_id; ?>][<?php echo $sheetPermission; ?>]"
                                                            value="1"
                                                            id="flexCheckDefault-<?php echo $user->admin_id . '-' . $sheetPermission; ?>"
                                                            <?php echo in_array($sheetPermission, $user->permissions) ? 'checked' : ''; ?>>
                                                         <label class="form-check-label" for="flexCheckDefault-<?php echo $user->admin_id . '-' . $sheetPermission; ?>">
                                                            Allow
                                                         </label>
                                                      </div>
                                                   </td>
                                                <?php endforeach; ?>
                                             </tr>
                                          <?php endforeach; ?>
                                       <?php endif; ?>

                                    </tbody>
                                 </table>
                              </div>
                           </div>

                           <button type="submit" id="s_btnn3" class="btn btn-primary d-none">Submit</button>
                        </form>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   //  $(document).ready(function () {
   //     // Listen for changes in the Sheet URL field
   //     $('input[name="sheet_url"]').on('change', function () {
   //         let sheetUrl = $(this).val(); // Get the entered URL
   //         let token = '<?php echo $token; ?>'; // Token from PHP variable

   //         // Check if the URL is not empty
   //         if (sheetUrl.trim() !== '') {
   //             $.ajax({
   //                 url: "<?php echo base_url('admin/category/sheet_permission/'); ?>" + token, // API endpoint
   //                 type: "POST", // Method type
   //                 data: { sheet_url: sheetUrl }, // Send the URL as data
   //                 dataType: "json",
   //                 beforeSend: function () {
   //                     // Show a loading spinner or message (optional)
   //                     console.log("Fetching permissions...");
   //                 },
   //                 success: function (response) {
   //                     if (response.success) {
   //                         let permissions = response.permissions;
   // console.log("Permissions", permissions );
   //                         // Populate the permissions table dynamically
   //                         let tbody = $('.tab-content .table tbody');
   //                         tbody.empty(); // Clear existing rows


   //                     } else {
   //                         console.error("Error fetching permissions:", response.message);
   //                         alert("Unable to fetch permissions. Please check the sheet URL.");
   //                     }
   //                 },
   //                 error: function (xhr, status, error) {
   //                     console.log("AJAX error:", error);
   //                     alert("An error occurred while fetching permissions.");
   //                 }
   //             });
   //         } else {
   //             alert("Please enter a valid Google Sheet URL.");
   //         }
   //     });
   // });
   // Attach a click event to the first button
   document.getElementById('save_btn3').addEventListener('click', function() {
      // Trigger a click on the second button

      document.getElementById('s_btnn3').click();
   });
</script>
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