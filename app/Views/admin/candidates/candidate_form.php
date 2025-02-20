<?= $this->include('admin/common/header') ?>
<div class="content-body">
<div class="container-fluid">
   <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
         <div class="welcome-text">
            <h4>Add New Admin</h4>
         </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
         
         <button type="button" class="btn btn-rounded btn-primary open-add-form"id="save_btn2">
         <span class="btn-icon-left text-primary">
         <i class="fa fa-plus"></i>
         </span>Save
         </button>
      
      </div>
   </div>
   <div class="row page-titles mx-0">
      <div class="col-12 mx-0 mtm-10">
         
            <form  action="<?php echo base_url('admin/candidates/candidates_form/' . $token); ?>" method="post" enctype="multipart/form-data" >
              
               <div class="custom-tab-1">
                  <ul class="nav nav-tabs">
                     <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1"><i class="la la-home me-2"></i> Personal</a>
                     </li>
                    
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane fade show active" id="home1" role="tabpanel">
                        <div class="pt-4 row">
                           <div class="col-6">
                              <div class="form-group">
                                 <label for="first_name">Branch Name</label>
                                 <input type="text" name="name" id="name" class="form-control" required>
                              </div>
                           </div>
                         
                           <div class="col-6">
                              <div class="form-group">
                                 <label for="phone_number">Branch Phone Number</label>
                                 <input type="text" name="mobile_number" id="mobile_number" class="form-control" required>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="form-group">
                                 <label for="email">Branch Email</label>
                                 <input type="email" name="email" id="email" class="form-control" required>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="form-group">
                                 <label for="last_name">Password</label>
                                 <input type="text" name="pass" id="pass" class="form-control" required>
                              </div>
                           </div>
                          
                           
                           <div class="col-6">
                              <div class="form-group">
                                 <label for="gender">Role</label>
                                 <select name="role" id="role" class="form-control" required>
                                 <?php if ($roles !== null && !empty($roles)): ?>
                                    <?php foreach ($roles as $index => $user): 
                                       if($user->status == "1"){
                                       ?>
                                    <option value="<?= $user->name ?>"><?= $user->name ?></option>
                                    <?php } endforeach; ?>
                                    <?php else: ?>
                                       <option value="Admin">Admin</option>
                                       <?php endif; ?>
                                 </select>
                              </div>
                           </div>
                           
                           <button type="submit" value="submit" class="btn d-none" id="s_btnn2">submit</button>
                          
                        </div>
                     </div>
                   
                  </div>
                 
               </div>
            </form>
           
      
      </div>
   </div>
</div>
            </div>
<?= $this->include('admin/common/footer') ?>

<script>

document.getElementById('save_btn2').addEventListener('click', function() {
        // Trigger a click on the second button
        document.getElementById('s_btnn2').click();
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
