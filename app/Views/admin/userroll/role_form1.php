<?= $this->include('admin/common/header') ?>


<div class="content-body">

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6">
                <div class="welcome-text">
                    <h4>Add Role</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Roles</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Role</a></li>

                    </ol>
                </div>
            </div>
            <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">

                <button class="btn btn-primary btn-rounded" id="save_btn1">
                    Save
                </button>
                &nbsp;
                <button class="btn btn-danger btn-rounded">
                    <li class="fa fa-arrow-left"></li>
                </button>

            </div>
        </div>
        <!-- row -->
        <style>
            #persel .bootstrap-select {
                width: 100%;
            }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/role/role_form/' . $token); ?>" method="post">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home1">
                                            <i class="la la-home mr-2"></i> General
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                        <div class="row pt-2">
                                            <input type="hidden" name="id" value="<?= isset($role->id) ? $role->id : '' ?>">
                                            <div class="col-sm-5 mt-3">
                                                <label for="roleName" style="color:#000;">Name Of Role</label>
                                                <input type="text" class="form-control" name="name" id="roleName"
                                                    value="<?= isset($role->name) ? $role->name : '' ?>"
                                                    placeholder="Enter role" required>
                                            </div>

                                            <div class="col-sm-5 mt-3">
                                                <label for="roleStatus" style="color:#000;">Status</label>
                                                <select class="form-control form-control-lg" name="status" id="roleStatus" required>
                                                    <option value="1" <?= isset($role->status) && $role->status == 1 ? 'selected' : '' ?>>Enable</option>
                                                    <option value="0" <?= isset($role->status) && $role->status == 0 ? 'selected' : '' ?>>Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Set Permission</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-md">
                                                                <thead>
                                                                    <tr>
                                                                        <th><strong>Module</strong></th>
                                                                        <th><strong>Create</strong></th>
                                                                        <th><strong>View</strong></th>
                                                                        <th><strong>Edit</strong></th>
                                                                        <th><strong>Delete</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    // Define modules and their labels
                                                                    $modules = [
                                                                        'users' => 'Users',
                                                                        'tasks' => 'Tasks',
                                                                        'sheets' => 'Sheets',
                                                                        'hr_policies' => 'HR Policies',
                                                                    ];
                                                                    // Split permissions from the role, if available
                                                                    $permissions = isset($role->permission) ? explode(',', $role->permission) : [];

                                                                    // Loop through each module to generate rows
                                                                    foreach ($modules as $key => $label): ?>
                                                                        <tr>
                                                                            <td><strong><?= $label ?></strong></td>
                                                                            <?php
                                                                            // Loop through actions (create, view, edit, delete)
                                                                            foreach (['create', 'view', 'edit', 'delete'] as $action):
                                                                                $permissionValue = "{$key}_{$action}";
                                                                                $isChecked = in_array($permissionValue, $permissions) ? 'checked' : '';
                                                                            ?>
                                                                                <td>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" name="permission[]" value="<?= $permissionValue ?>" id="<?= $permissionValue ?>" <?= $isChecked ?>>
                                                                                        <label class="form-check-label" for="<?= $permissionValue ?>">Allow</label>
                                                                                    </div>
                                                                                </td>
                                                                            <?php endforeach; ?>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" value="submit" class="btn d-none" id="s_btnn1">submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>

                </div>
            </div>

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
    // Attach a click event to the first button
    document.getElementById('save_btn1').addEventListener('click', function() {
        // Trigger a click on the second button
        document.getElementById('s_btnn1').click();
    });
</script>

<?= $this->include('admin/common/footer') ?>