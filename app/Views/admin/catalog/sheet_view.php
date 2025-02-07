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
          <h4>Sheets List</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Sheets List</a></li>
          </ol>
        </div>
      </div>
      <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
       
          
        
       
        

      </div>
    </div>
    <!-- row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
          <iframe 
            src="<?= $sheet_url ?>" 
            width="100%" 
            height="500px" 
            frameborder="0" 
            allowfullscreen>
        </iframe>
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
</div>
<?= $this->include('admin/common/footer') ?>