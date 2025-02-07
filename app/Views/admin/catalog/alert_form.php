
<div class="content-body">

<div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6">
                        <div class="welcome-text">
                            <h4>Add New Alert</h4>
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Alerts</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Alerts</a></li>
                    
                        </ol>
                        </div>
                    </div>
                    <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                  <a href="<?php echo base_url('catalog/category_form');?>">
                    <button class="btn btn-primary btn-rounded">
                 Save
                    </button>
                    </a>&nbsp;
                   <button class="btn btn-danger btn-rounded">
                    <li class="fa fa-arrow-left"></li>
                   </button>
                  
                </div>
                </div>
                <!-- row -->
                <div class="row">
                <div class="col-12">
                <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home1"><i class="la la-home mr-2"></i> General</a>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                          <div class="row pt-2">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Alert name">
                                            </div>
                                            <div class="col-sm-4">
                                              <input type="text" class="form-control" placeholder="Sort Order">
                                            </div>
                                            <div class="col-sm-4">
                                            <select class="form-control form-control-lg">
                                                <option>Enable</option>
                                                <option>Disable</option>
                                            </select>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-12 pt-4">
                                            <p class="mb-0">Alert Description</p>
                                            <div class="summernote pt-0"></div>
                                            </div>
                                          </div>
                                         <br />
                                           <div class="row">
                                            <div class="col-3">
                                                <p class="mb-0">Alert Parameter</p>
                                                <select class="form-control form-control-lg">
                                                <option>Quantity</option>
                                                <option>Price</option>
                                                <option>Expiry Date</option>
                                                <option>Stock Added</option>
                                                <option>New Record Created</option>
                                            </select>
                                            </div>
                                            <div class="col-3">
                                            <p class="mb-0">Alert Trigger</p>
                                                <select class="form-control form-control-lg">
                                                <option>At Event</option>
                                                <option>Before Event</option>
                                                <option>After Event</option>
                                              
                                            </select>
                                            </div>
                                            <div class="col-3">
                                            <p class="mb-0">Frequancy</p>
                                            <select class="form-control form-control-lg">
                                                <option>Once Per Day</option>
                                                <option>Once Per week</option>
                                                <option>Once Per Month</option>
                                              
                                            </select>
                                            </div>
                                            <div class="col-3">
                                            <p class="mb-0">Alert Type</p>
                                            <select class="form-control form-control-lg">
                                                <option>Mobile App Alert</option>
                                                <option>Email</option>
                                                <option>SMS</option>
                                                <option>Dashboard Sidebar</option>
                                            </select>
                                            </div>
                                           </div> 
                                          
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                </div>
			   </div>
              
            </div>
           
        </div>
       
    </div>