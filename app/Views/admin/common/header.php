<?= $this->include('admin/common/top_bar') ?>
<?= $this->include('admin/common/right_bar') ?>


<style>
.fc-time{
   display: none !important;
}
.ppb p{
   margin-bottom: 0 !important;
}
.btnpen{
   color: #fff;
    font-weight: 600;
    font-size: 10px;
    z-index: 3;
    width: 100%;
    top: 0%;
    right: 3%;
    border-radius: 4.497px;
   
    background-color: #2C223B;
    width: 67.346px;
 
    padding: 3.597px 14.39px;
    float: inline-end;
}    



</style>

<div class="fixed-content-box">
   <div class="head-name">
      VSC CRM
      <span class="close-fixed-content fa-left d-lg-none">
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
               <polygon points="0 0 24 0 24 24 0 24" />
               <rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1" />
               <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) " />
            </g>
         </svg>
      </span>
   </div>
   <div class="fixed-content-body dz-scroll" id="DZ_W_Fixed_Contant">
      <div class="tab-content" id="menu">
         <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
            <ul class="metismenu tab-nav-menu">
               <li class="nav-label">DASHBOARD</li>
               <li>
                  <a class="has-arrow" href="<?= base_url('admin/dashboard/' . $token) ?>" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24" />
                           <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                           <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                        </g>
                     </svg>
                     Dashboard
                  </a>
               </li>

           
            </ul>
         </div>
         <div class="tab-pane fade " id="calendar1" role="tabpanel">
            <ul class="metismenu tab-nav-menu">
               <li class="nav-label">CALENDAR</li>

               <?php
               $permission = session()->get('admin_permission');

               $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
               ?>
               <?php if (in_array('tasks_view', $permissionsArray)): ?>
                  <li>
                     <a class="has-arrow" href="<?php echo base_url('admin/dashboard/calendar/' . $token); ?>" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920211 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                              <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920211 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
                           </g>
                        </svg>
                        Task Calendar
                     </a>
                  </li>
                  <li>
                     <a class="has-arrow" href="<?php echo base_url('admin/dashboard/calendar_table/' . $token); ?>" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000" />
                              <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                        Task Sheet
                     </a>
                  </li>
               <?php endif; ?>

            </ul>
         </div>
         <div class="tab-pane fade" id="apps">
            <ul class="metismenu tab-nav-menu">
               <li class="nav-label">Users & Permissions</li>
               <?php
               $permission = session()->get('admin_permission');

               $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
               ?>
               <?php if (in_array('users_view', $permissionsArray)): ?>
                  <li>
                     <a class="has-arrow" href="<?php echo base_url('admin/candidates/' . $token); ?>" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920211 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                              <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920211 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
                           </g>
                        </svg>
                        Users
                     </a>
                  </li>
               <?php endif; ?>
               <?php
               $permission = session()->get('role');

               // Convert the string to an array for easier checking
               ?>
               <?php if ('DATA MINER' == $permission): ?>

                  <li>
                     <a class="has-arrow" href="<?php echo base_url('admin/roles/' . $token); ?>" aria-expanded="false">
                        <svg id="icon-apps" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                           <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                           <circle cx="9" cy="7" r="4"></circle>
                           <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                           <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Users Roles
                     </a>
                  </li> <?php endif; ?>

            </ul>
         </div>
         <div class="tab-pane fade " id="forms">
            <ul class="metismenu tab-nav-menu">
            <?php 
                      $role = session()->get('role'); 
                      if ($role == 'DATA MINER'): ?>
               <li class="nav-label">Sheets</li>
               <li>
                  <a class="has-arrow" href="<?php echo base_url('admin/category/' . $token); ?>" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24" />
                           <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                           <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                        </g>
                     </svg>
                    Sheets
                  </a>
               </li>
              
               <?php endif; ?>
               

            </ul>
         </div>
         <div class="tab-pane fade" id="hrr">
            <ul class="metismenu tab-nav-menu">
               <li class="nav-label">Hr Page</li>
               <?php
               $permission = session()->get('admin_permission');

               $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
               ?>
               <?php if (in_array('hr_policies_view', $permissionsArray)): ?>
                  <li>
                     <a class="has-arrow" href="<?php echo base_url('admin/hr_policies/' . $token); ?>" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <path d="M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z M14,9 L14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 L10,9 L8,9 L8,8 C8,5.790861 9.790861,4 12,4 C14.209139,4 16,5.790861 16,8 L16,9 L14,9 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                              <path d="M6.84712709,9 L17.1528729,9 C17.6417121,9 18.0589022,9.35341304 18.1392668,9.83560101 L19.611867,18.671202 C19.7934571,19.7607427 19.0574178,20.7911977 17.9678771,20.9727878 C17.8592143,20.9908983 17.7492409,21 17.6390792,21 L6.36092084,21 C5.25635134,21 4.36092084,20.1045695 4.36092084,19 C4.36092084,18.8898383 4.37002252,18.7798649 4.388133,18.671202 L5.86073316,9.83560101 C5.94109783,9.35341304 6.35828794,9 6.84712709,9 Z" fill="#000000" />
                           </g>
                        </svg>
                        HR Policies
                     </a>
                  </li> <?php endif; ?>
                  <li>
                  <a class="has-arrow" href="<?php echo base_url('admin/hr_notice/' . $token); ?>" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24" />
                           <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                           <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                        </g>
                     </svg>
                        HR Notices
                     </a>
                  </li>

            </ul>
         </div>
         <div class="tab-pane fade" id="settings">
            <ul class="metismenu tab-nav-menu">
               <li class="nav-label">Settings</li>
            </ul>
         </div>
      </div>
      <div class="tab-pane chart-sidebar fade show active" role="tabpanel">
         <div class="card role-f">
            <div class="card-header align-items-start">
               <div>
                  <h6>Daily Sales</h6>
                  <p>Check out each colum for more details</p>
               </div>
               <span class="btn btn-primary light sharp ml-2">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5" />
                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5" />
                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
                        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
                     </g>
                  </svg>
               </span>
            </div>
            <div class="card-body">
               <canvas id="daily-sales-chart" height="85" style="height:85px;"></canvas>
            </div>
         </div>
         <div class="card bg-warning-light">
            <div class="card-header align-items-start mb-3">
               <div>
                  <h6>Task Status</h6>

               </div>
               <span class="btn btn-warning light sharp ml-2">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3" />
                        <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000" />
                     </g>
                  </svg>
               </span>
            </div>
            <div class="card-body">
               <div class="chart-point">
                  <div class="check-point-area">
                     <canvas id="ShareProfit"></canvas>
                  </div>
                  <ul class="chart-point-list">
                     <li><i class="fa fa-circle text-primary mr-1"></i> 65% Task assigned</li>
                     <li><i class="fa fa-circle text-success mr-1"></i> 35% Task Completed</li>

                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="header">
   <div class="header-content">
      <nav class="navbar navbar-expand">
         <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
               <div class="search_bar dropdown">
                 
                  <div class="dropdown-menu p-0 m-0">
                    
                  </div>
               </div>
            </div>
            <ul class="navbar-nav header-right">
               <li class="nav-item dropdown notification_dropdown">
                  <a class="nav-link bell dz-fullscreen" href="#">
                     <svg id="icon-full" viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                     </svg>
                     <svg id="icon-minimize" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize">
                        <path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"></path>
                     </svg>
                  </a>
               </li>
               <li class="nav-item dropdown notification_dropdown">
                  <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                     <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                     </svg>
                     <div class="pulse-css"></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                     <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
                     <ul class="timeline">
    <?php 
    $tasks = session()->get('admin_task');
    if (!empty($tasks)) {
   
        foreach ($tasks as $task) { 

            if ($task->status == 'progress') {
    ?>
        <li>
            <div class="timeline-panel ppb">
                <div class="media mr-2">
                    <img alt="image" width="50" src="<?php echo base_url('assets/images/avatar/1.jpg'); ?>">
                </div>
                <div class="media-body">
                    <h6 class="mb-1"><?php echo htmlspecialchars($task->title); ?> <span class="btnpen">Pending</span></h6>
                    <?php echo $task->des; ?>
                    <small class="d-block"><?php echo $task->created_at; ?></small>
                </div>
            </div>
        </li>
    <?php }} } else { ?>
        <li>
            <div class="timeline-panel">
                <div class="media-body">
                    <h6 class="mb-1">No tasks available</h6>
                </div>
            </div>
        </li>
    <?php } ?>
</ul>   
                     <ul class="timeline d-none">
                           <li>
                              <div class="timeline-panel">
                                 <div class="media mr-2">
                                    <img alt="image" width="50" src="<?php echo base_url('assets/images/avatar/1.jpg'); ?>">
                                 </div>
                                 <div class="media-body">
                                    <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                    <p></p>
                                    <small class="d-block">29 July 2020 - 02:26 PM</small>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="timeline-panel">
                                 <div class="media mr-2 media-info">
                                    KG
                                 </div>
                                 <div class="media-body">
                                    <h6 class="mb-1">Resport created successfully</h6>
                                    <small class="d-block">29 July 2020 - 02:26 PM</small>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="timeline-panel">
                                 <div class="media mr-2 media-success">
                                    <i class="fa fa-home"></i>
                                 </div>
                                 <div class="media-body">
                                    <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                    <small class="d-block">29 July 2020 - 02:26 PM</small>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="timeline-panel">
                                 <div class="media mr-2">
                                    <img alt="image" width="50" src="<?php echo base_url('assets/images/avatar/1.jpg'); ?>">
                                 </div>
                                 <div class="media-body">
                                    <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                    <small class="d-block">29 July 2020 - 02:26 PM</small>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="timeline-panel">
                                 <div class="media mr-2 media-danger">
                                    KG
                                 </div>
                                 <div class="media-body">
                                    <h6 class="mb-1">Resport created successfully</h6>
                                    <small class="d-block">29 July 2020 - 02:26 PM</small>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="timeline-panel">
                                 <div class="media mr-2 media-primary">
                                    <i class="fa fa-home"></i>
                                 </div>
                                 <div class="media-body">
                                    <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                    <small class="d-block">29 July 2020 - 02:26 PM</small>
                                 </div>
                              </div>
                           </li>
                        </ul>
                       
                     </div>
                     <a class="all-notification" href="#">See all notifications <i
                           class="ti-arrow-right"></i></a>
                  </div>
               </li>
               <li class="nav-item dropdown header-profile">
                  <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                     <img src="<?php echo base_url('assets/images/profile/pic1.jpg'); ?>" width="20" alt="" />
                     <div class="header-info">
                        <span>Hey, <strong id="adminName" style="text-transform: capitalize;"><?php echo session()->get('admin_name') ?: 'Admin'; ?></strong></span>
                        <small></small>
                     </div>
                  </a>
               </li>
            </ul>
         </div>
      </nav>
   </div>

</div>

<?= $this->include('admin/common/left_bar') ?>