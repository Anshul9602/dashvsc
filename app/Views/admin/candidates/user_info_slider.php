<h4 class="form-heading">Candidates Details</h4>
<div class="custom-tab-1">
   <ul class="nav nav-tabs">
      <li class="nav-item">
         <a class="nav-link active " data-bs-toggle="tab" href="#experience11"><i class="la la-clipboard me-2"></i> Posted Details</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-bs-toggle="tab" href="#profile11"><i class="la la-user me-2"></i> Applied Jobs</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-bs-toggle="tab" href="#job11"><i class="la la-briefcase me-2"></i> Earn Referal Points</a>
      </li>
   </ul>
   <br />
   <div class="tab-content">
      <div class="tab-pane fade active show" id="experience11">
         <?= $this->include('admin/candidates/user_info_table') ?>
      </div>
      <div class="tab-pane fade" id="profile11">
        <?= $this->include('admin/candidates/user_info_applied') ?>
      </div>
      <div class="tab-pane fade" id="job11">
        <?= $this->include('admin/candidates/user_ref_info') ?>
      </div>
   </div>
</div>