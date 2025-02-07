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
          <h4>Composite Products List</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Composite Products List</a></li>
          </ol>
        </div>
      </div>
      <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="<?php echo base_url(
                    'catalog/composite_product_form'
                  ); ?>">
          <button class="btn btn-primary btn-rounded">
            <li class="fa fa-plus"></li>
          </button>
        </a>
        &nbsp;

        <button class="btn btn-danger btn-rounded">
          <li class="fa fa-trash"></li>
        </button>
        &nbsp;
        <button class="btn btn-warning btn-rounded">
          <li class="fa fa-download"></li>
        </button>
        &nbsp;
        <button class="btn btn-info btn-rounded">
          <li class="fa fa-upload"></li>
        </button>
        &nbsp;
        <button class="btn btn-success btn-rounded">
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
                    <th>Product Image</th>
                    <th class="text-center">Barcode</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th> Qty</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                        <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                        <label class="custom-control-label" for="checkAll"></label>
                      </div>
                    </td>
                    <td>
                      <img width="100" class="img-thumbnail" src="<?php echo base_url(
                                                                    'assets/images/card/2.png'
                                                                  ); ?>" alt="" />
                    </td>
                    <td class="text-center">
                      <img width="180" style="margin:auto" class="img-fluid" src="<?php echo base_url(
                                                                                    'assets/images/barcode.jpeg'
                                                                                  ); ?>" alt="" />
                    </td>
                    <td>

                      Eletric Pumps</td>
                    <td>Water Pump</td>
                    <td>KSP0198</td>
                    <td>
                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td><a href="javascript:void(0);"><strong>212</a></strong></td>
                    <td>
                      <div class="d-flex">
                        <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>





                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<?= $this->include('admin/common/footer') ?>