<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>VSC Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">

</head>
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form text-center">
                                 <img style="max-width:100px; margin:auto" src="<?php echo base_url('assets/logo.png');?>" alt="" />  
                                 <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="<?= base_url('admin/login') ?>" method="post">
                                        <div class="form-group text-left">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control"  name="email" value=""placeholder="username">
                                        </div>
                                        <div class="form-group text-left">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="pass" value=""placeholder="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                           
                                        </div>
                                        <div class="text-center">
                                        <a href="dashboard">
										<button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
										</a>
										</div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?php echo base_url('/vendor/global/global.min.js');?>"></script>
	<script src="<?php echo base_url('/vendor/bootstrap-select/dist/js/bootstrap-select.min.js');?>"></script>
    <script src="<?php echo base_url('/js/custom.min.js');?>"></script>
    <script src="<?php echo base_url('/js/deznav-init.js');?>"></script>

</body>

</html>
