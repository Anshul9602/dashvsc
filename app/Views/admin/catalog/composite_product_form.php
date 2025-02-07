<?= $this->include('admin/common/header') ?>

<div class="content-body">
   <div class="container-fluid">
      <div class="row page-titles mx-0">
         <div class="col-sm-6">
            <div class="welcome-text">
               <h4>Add Unit Product</h4>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0)">Unit Products</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Unit Products</a></li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="<?php echo base_url('catalog/category_form'); ?>">
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
                           <a class="nav-link active" data-toggle="tab" href="#home1">
                           <i class="la la-home mr-2"></i> General
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#profile1">
                           <i class="la la-file mr-2"></i> Media
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#data">
                           <i class="la la-file mr-2"></i> Data
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#links">
                           <i class="la la-link mr-2"></i> Links
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#attr">
                           <i class="la la-battle-net mr-2"></i> Attributes
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#barcode">
                           <i class="la la-barcode mr-2"></i> Barcode
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#opt">
                           <i class="la la-filter mr-2"></i> Options
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#sp">
                           <i class="la la-tags mr-2"></i> Special prices
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#contact1">
                           <i class="la la-bell mr-2"></i>  Alert
                           </a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                           <div class="row pt-2">
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" placeholder="Product name">
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
                                 <p class="mb-0">Product Description</p>
                                 <div class="summernote pt-0"></div>
                              </div>
                           </div>
                           <hr />
                           <h6>SEO Information</h6>
                           <hr />
                           <div class="row">
                              <div class="col-4">
                                 <input type="text" class="form-control" placeholder="Meta title">
                              </div>
                              <div class="col-4">
                                 <input type="text" class="form-control" placeholder="SEO Url">
                              </div>
                              <div class="col-4">
                                 <input type="text" class="form-control" placeholder="Meta keywords">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12 pt-4">
                                 <p class="mb-0">Meta Description</p>
                                 <div class="summernote pt-0"></div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="profile1">
                           <div class="pt-4">
                              <div class="row">
                                 <div class="col-12">
                                    <h4>Images</h4>
                                    <button style="float:right; margin-top:-40px" class="btn btn-primary">
                                       <li class="fa fa-plus"></li>
                                    </button>
                                    <hr />
                                 </div>
                                 <div class="col-2">
                                    <img src="<?php echo base_url(
                                       'assets/images/card/2.png'
                                       ); ?>" alt="" class="img-thumbnail">
                                 </div>
                                 <div class="col-2">
                                    <input type="text" placeholder="sort order" class="form-control">
                                 </div>
                                 <div class="col-2">
                                    <input type="text" placeholder="Image title" class="form-control">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <hr />
                                    <h4>Videos</h4>
                                    <button style="float:right; margin-top:-40px" class="btn btn-primary">
                                       <li class="fa fa-plus"></li>
                                    </button>
                                    <hr />
                                 </div>
                                 <div class="col-2">
                                    <img src="<?php echo base_url(
                                       'assets/images/card/2.png'
                                       ); ?>" alt="" class="img-thumbnail">
                                 </div>
                                 <div class="col-2">
                                    <input type="text" placeholder="sort order" class="form-control">
                                 </div>
                                 <div class="col-2">
                                    <input type="text" placeholder="Video title" class="form-control">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <hr />
                                    <h4>Files</h4>
                                    <button style="float:right; margin-top:-40px" class="btn btn-primary">
                                       <li class="fa fa-plus"></li>
                                    </button>
                                    <hr />
                                 </div>
                                 <div class="col-2">
                                    <img src="<?php echo base_url(
                                       'assets/images/card/2.png'
                                       ); ?>" alt="" class="img-thumbnail">
                                 </div>
                                 <div class="col-2">
                                    <input type="text" placeholder="sort order" class="form-control">
                                 </div>
                                 <div class="col-2">
                                    <input type="text" placeholder="Files title" class="form-control">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="data" class="tab-pane fade">
                           <br />  
                           <div class="row">
                              <div class="col-sm-12">
                                 <h4>Model</h4>
                                 <hr />
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="Model">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="SKU">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="UPC">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="ISBN">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <br />
                                 <h4>Price</h4>
                                 <hr />
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="Price">
                              </div>
                              <div class="col-sm-3">
                                 <select name="tax_class_id" id="input-tax-class" class="form-select">
                                    <option value="0"> --- Tax Class --- </option>
                                    <option value="9">CGST</option>
                                    <option value="10">SGST</option>
                                    <option value="10">VAT</option>
                                 </select>
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="discount">
                              </div>
                              <div class="col-sm-3">
                                 <select name="tax_class_id" id="input-tax-class" class="form-select">
                                    <option value="0"> --- Discount Type --- </option>
                                    <option value="9">Percent</option>
                                    <option value="10">Fixed</option>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <br />
                                 <h4>Stock</h4>
                                 <hr />
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="Quantity">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="Min Quantity">
                              </div>
                              <div class="col-sm-3">
                                 <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="Date Available">
                              </div>
                              <div class="col-sm-3">
                                 <select name="tax_class_id" id="input-tax-class" class="form-select">
                                    <option value="0"> --- Substract Stock --- </option>
                                    <option value="9">Yes</option>
                                    <option value="10">No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <br />
                                 <h4>Composition</h4>
                                 <hr />
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                              <div class="table-responsive">
                              <table id="product-attribute" class="table table-bordered table-hover">
                                 <thead>
                                    <tr>
                                       <td class="text-start">Product Name</td>
                                       <td class="text-start">Quantity</td>
                                       <td></td>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr id="attribute-row-0">
                                       <td class="text-start">
                                          <input type="text" name="product_attribute[0][name]" value="" placeholder="Product Name" id="input-attribute-0" list="list-attribute-0" class="form-control">    <input type="hidden" name="product_attribute[0][attribute_id]" value="" id="input-attribute-id-0">    
                                          <datalist id="list-attribute-0"></datalist>
                                       </td>
                                       <td class="text-start">
                                          <div class="input-group">
                                          <input type="text" name="product_attribute[0][name]" value="" placeholder="Qty" id="input-attribute-0" list="list-attribute-0" class="form-control">    <input type="hidden" name="product_attribute[0][attribute_id]" value="" id="input-attribute-id-0">    
                                       </div>
                                       </td>
                                       <td class="text-end"><button type="button" onclick="$('#attribute-row-0').remove();" data-bs-toggle="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                    <tr id="attribute-row-0">
                                       <td class="text-start">
                                          <input type="text" name="product_attribute[0][name]" value="" placeholder="Product Name" id="input-attribute-0" list="list-attribute-0" class="form-control">    <input type="hidden" name="product_attribute[0][attribute_id]" value="" id="input-attribute-id-0">    
                                          <datalist id="list-attribute-0"></datalist>
                                       </td>
                                       <td class="text-start">
                                          <div class="input-group">
                                          <input type="text" name="product_attribute[0][name]" value="" placeholder="Qty" id="input-attribute-0" list="list-attribute-0" class="form-control">    <input type="hidden" name="product_attribute[0][attribute_id]" value="" id="input-attribute-id-0">    
                                       </div>
                                       </td>
                                       <td class="text-end"><button type="button" onclick="$('#attribute-row-0').remove();" data-bs-toggle="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td colspan="2"></td>
                                       <td class="text-end"><button type="button" id="button-attribute" data-bs-toggle="tooltip" title="" class="btn btn-primary" data-bs-original-title="Add Attribute" aria-label="Add Attribute"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                              </div>
                           </div>
                        
                           <div class="row">
                              <div class="col-sm-12">
                                 <br />
                                 <h4>Specification</h4>
                                 <hr />
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-3">
                                 <select name="tax_class_id" id="input-tax-class" class="form-select">
                                    <option value="0"> --- Shipping Required --- </option>
                                    <option value="9">Yes</option>
                                    <option value="10">No</option>
                                 </select>
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" placeholder="Weight">
                              </div>
                              <div class="col-sm-3">
                                 <select name="tax_class_id" id="input-tax-class" class="form-select">
                                    <option value="0"> --- Weight Unit --- </option>
                                    <option value="9">Kg</option>
                                    <option value="10">gm</option>
                                 </select>
                              </div>
                              <div class="col-sm-3">
                                 <select name="tax_class_id" id="input-tax-class" class="form-select">
                                    <option value="0"> --- Dimention Unit --- </option>
                                    <option value="9">MM</option>
                                    <option value="10">CM</option>
                                 </select>
                              </div>
                           </div>
                           <br />
                           <div class="row">
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" placeholder="Length">
                              </div>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" placeholder="Width">
                              </div>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" placeholder="Height">
                              </div>
                           </div>
                        </div>
                        <div id="links" class="tab-pane fade">
                           <div class="row mb-3">
                              <label class="col-sm-2 col-form-label pt-4">Manufacturer</label>
                              <div class="col-sm-10">
                                 <div class="input-group">
                                    <input type="text" name="manufacturer" value="" placeholder="Manufacturer" id="input-manufacturer" list="list-manufacturer" class="form-control">
                                 </div>
                                 <input type="hidden" name="manufacturer_id" value="0" id="input-manufacturer-id">
                                 <datalist id="list-manufacturer"></datalist>
                                 <div class="form-text">(Autocomplete)</div>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Categories</label>
                              <div class="col-sm-10">
                                 <input type="text" name="category" value="" placeholder="Categories" id="input-category" list="list-category" class="form-control">
                                 <datalist id="list-category"></datalist>
                                 <div class="input-group">
                                    <div class="form-control p-0" style="height: 150px; overflow: auto;">
                                       <table id="product-category" class="table table-sm m-0">
                                          <tbody></tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="form-text">(Autocomplete)</div>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Filters</label>
                              <div class="col-sm-10">
                                 <input type="text" name="filter" value="" placeholder="Filters" id="input-filter" list="list-filter" class="form-control">
                                 <datalist id="list-filter"></datalist>
                                 <div class="input-group">
                                    <div class="form-control p-0" style="height: 150px; overflow: auto;">
                                       <table id="product-filter" class="table table-sm m-0">
                                          <tbody></tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="form-text">(Autocomplete)</div>
                              </div>
                           </div>
                         
                           <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Downloads</label>
                              <div class="col-sm-10">
                                 <input type="text" name="download" value="" placeholder="Downloads" id="input-download" list="list-download" class="form-control">
                                 <datalist id="list-download"></datalist>
                                 <div class="input-group">
                                    <div class="form-control p-0" style="height: 150px; overflow: auto;">
                                       <table id="product-download" class="table table-sm m-0">
                                          <tbody></tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="form-text">(Autocomplete)</div>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Related Products</label>
                              <div class="col-sm-10">
                                 <input type="text" name="related" value="" placeholder="Related Products" id="input-related" list="list-related" class="form-control">
                                 <datalist id="list-related"></datalist>
                                 <div class="input-group">
                                    <div class="form-control p-0" style="height: 150px; overflow: auto;">
                                       <table id="product-related" class="table table-sm m-0">
                                          <tbody></tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="form-text">(Autocomplete)</div>
                              </div>
                           </div>
                        </div>
                        <div id="attr" class="tab-pane fade">
                           <div class="table-responsive">
                              <table id="product-attribute" class="table table-bordered table-hover">
                                 <thead>
                                    <tr>
                                       <td class="text-start">Attribute</td>
                                       <td class="text-start">Text</td>
                                       <td></td>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr id="attribute-row-0">
                                       <td class="text-start">
                                          <input type="text" name="product_attribute[0][name]" value="" placeholder="Attribute" id="input-attribute-0" list="list-attribute-0" class="form-control">    <input type="hidden" name="product_attribute[0][attribute_id]" value="" id="input-attribute-id-0">    
                                          <datalist id="list-attribute-0"></datalist>
                                       </td>
                                       <td class="text-start">
                                          <div class="input-group">
                                             <div class="input-group-text"><img src="language/en-gb/en-gb.png" title="English"></div>
                                             <textarea name="product_attribute[0][product_attribute_description][1][text]" rows="5" placeholder="Text" id="input-text-0-1" class="form-control"></textarea>
                                          </div>
                                       </td>
                                       <td class="text-end"><button type="button" onclick="$('#attribute-row-0').remove();" data-bs-toggle="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                    <tr id="attribute-row-1">
                                       <td class="text-start">
                                          <input type="text" name="product_attribute[1][name]" value="" placeholder="Attribute" id="input-attribute-1" list="list-attribute-0" class="form-control">    <input type="hidden" name="product_attribute[1][attribute_id]" value="" id="input-attribute-id-1">    
                                          <datalist id="list-attribute-0"></datalist>
                                       </td>
                                       <td class="text-start">
                                          <div class="input-group">
                                             <div class="input-group-text"><img src="language/en-gb/en-gb.png" title="English"></div>
                                             <textarea name="product_attribute[1][product_attribute_description][1][text]" rows="5" placeholder="Text" id="input-text-1-1" class="form-control"></textarea>
                                          </div>
                                       </td>
                                       <td class="text-end"><button type="button" onclick="$('#attribute-row-1').remove();" data-bs-toggle="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td colspan="2"></td>
                                       <td class="text-end"><button type="button" id="button-attribute" data-bs-toggle="tooltip" title="" class="btn btn-primary" data-bs-original-title="Add Attribute" aria-label="Add Attribute"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="barcode">
                           <div class="row">
                              <div class="col-sm-12">
                                 <p class="pt-4">Barcode</p>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <input type="text" class="form-control" id="barcodeValue" value="12345670">
                              </div>
                              <div class="col-sm-6">
                                 <div id="barcodeTarget" class="barcodeTarget" style="padding: 0px; overflow: auto; width: 87px;">
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 10px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 4px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 3px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div>
                                    <div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div>
                                    <div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 10px"></div>
                                    <div style="clear:both; width: 100%; background-color: #FFFFFF; color: #000000; text-align: center; font-size: 10px; margin-top: 5px;">69874222</div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <button class="btn btn-primary">Generate Barcode</button>
                              </div>
                           </div>
                        </div>
                        <div id="opt" class="tab-pane fade">
                           <div id="tab-option" class="tab-pane active">
                              <div id="option">
                                 <fieldset id="option-row-0">
                                    <legend>Checkbox <button type="button" class="btn float-right btn-danger btn-sm float-end" onclick="$('#option-row-0').remove();"><i class="fa fa-minus-circle"></i></button></legend>
                                    <hr />
                                    <input type="hidden" name="product_option[0][product_option_id]" value="">  <input type="hidden" name="product_option[0][name]" value="Checkbox">  <input type="hidden" name="product_option[0][option_id]" value="2">  <input type="hidden" name="product_option[0][type]" value="checkbox">  
                                    <div class="row mb-3">
                                       <label for="input-required-0" class="col-sm-2 col-form-label">Required</label>	   
                                       <div class="col-sm-10">
                                          <select name="product_option[0][required]" id="input-required-0" class="form-select">
                                             <option value="1">Yes</option>
                                             <option value="0">No</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="table-responsive">
                                       <table id="option-value-0" class="table table-bordered table-hover">
                                          <thead>
                                             <tr>
                                                <td class="text-start">Option Value</td>
                                                <td class="text-end">Quantity</td>
                                                <td class="text-start">Subtract Stock</td>
                                                <td class="text-end">Price</td>
                                                <td class="text-end">Points</td>
                                                <td class="text-end">Weight</td>
                                                <td></td>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr id="option-value-row-0">
                                                <td class="text-start">Checkbox 2<input type="hidden" name="product_option[0][product_option_value][0][option_value_id]" value="24"><input type="hidden" name="product_option[0][product_option_value][0][product_option_value_id]" value=""></td>
                                                <td class="text-end">1<input type="hidden" name="product_option[0][product_option_value][0][quantity]" value="1"></td>
                                                <td class="text-start">No<input type="hidden" name="product_option[0][product_option_value][0][subtract]" value="0"></td>
                                                <td class="text-end">+1<input type="hidden" name="product_option[0][product_option_value][0][price_prefix]" value="+"><input type="hidden" name="product_option[0][product_option_value][0][price]" value="1"></td>
                                                <td class="text-end"> +1<input type="hidden" name="product_option[0][product_option_value][0][points_prefix]" value="+"><input type="hidden" name="product_option[0][product_option_value][0][points]" value="1"></td>
                                                <td class="text-end">+1<input type="hidden" name="product_option[0][product_option_value][0][weight_prefix]" value="+"><input type="hidden" name="product_option[0][product_option_value][0][weight]" value="1"></td>
                                                <td class="text-end"><button type="button" data-bs-toggle="tooltip" title="" data-option-row="0" data-option-value-row="0" class="btn btn-primary" data-bs-original-title="Edit" aria-label="Edit"><i class="fa fa-pencil-alt"></i></button> <button type="button" onclick="$('#option-value-row-0').remove();" data-bs-toggle="tooltip" rel="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                             </tr>
                                          </tbody>
                                          <tfoot>
                                             <tr>
                                                <td colspan="6"></td>
                                                <td class="text-end">
                                                   <button type="button" data-option-row="0" data-bs-toggle="tooltip" title="" class="btn btn-primary" data-bs-original-title="Add Option Value" aria-label="Add Option Value"><i class="fa fa-plus-circle"></i></button>
                                                </td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                    </div>
                                    <select id="product-option-values-0" class="d-none">
                                       <option value="23">Checkbox 1</option>
                                       <option value="24">Checkbox 2</option>
                                       <option value="44">Checkbox 3</option>
                                       <option value="45">Checkbox 4</option>
                                    </select>
                                 </fieldset>
                                 <hr />
                                 <fieldset id="option-row-1">
                                    <legend>Date <button type="button" class="btn btn-danger btn-sm float-right" onclick="$('#option-row-1').remove();"><i class="fa fa-minus-circle"></i></button></legend>
                                    <hr />
                                    <input type="hidden" name="product_option[1][product_option_id]" value="">  <input type="hidden" name="product_option[1][name]" value="Date">  <input type="hidden" name="product_option[1][option_id]" value="8">  <input type="hidden" name="product_option[1][type]" value="date">  
                                    <div class="row mb-3">
                                       <label for="input-required-1" class="col-sm-2 col-form-label">Required</label>	   
                                       <div class="col-sm-10">
                                          <select name="product_option[1][required]" id="input-required-1" class="form-select">
                                             <option value="1">Yes</option>
                                             <option value="0">No</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <label for="input-option-1" class="col-sm-2 col-form-label">Option Value</label>	  
                                       <div class="col-sm-10 col-md-4">
                                          <div class="input-group">
                                             <input type="text" name="product_option[1][value]" value="" placeholder="Option Value" id="input-option-1" class="form-control date">
                                             <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <hr />
                              <fieldset>
                                 <legend>Add Option</legend>
                                 <hr />
                                 <div class="row mb-3">
                                    <label for="input-option" class="col-sm-2 col-form-label">Option</label>
                                    <div class="col-sm-10">
                                       <input type="text" name="option" value="" placeholder="Option" id="input-option" list="list-option" class="form-control">
                                       <datalist id="list-option">
                                          <option value="Date">Date</option>
                                          <option value="Date &amp; Time">Date</option>
                                       </datalist>
                                       <div class="form-text">(Autocomplete)</div>
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="sp">
                           <div class="row">
                              <div class="col-12">
                                 <div class="table-responsive">
                                    <table id="product-special" class="table table-bordered table-hover">
                                       <thead>
                                          <tr>
                                             <td class="text-start">Customer Group</td>
                                             <td class="text-end">Priority</td>
                                             <td class="text-end">Price</td>
                                             <td class="text-start">Date Start</td>
                                             <td class="text-start">Date End</td>
                                             <td class="text-center"></td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr id="special-row-0">
                                             <td class="text-start">
                                                <select name="product_special[0][customer_group_id]" class="form-select">
                                                   <option value="1">Default</option>
                                                </select>
                                                <input type="hidden" name="product_special[0][product_special_id]" value="">
                                             </td>
                                             <td class="text-end"><input type="text" name="product_special[0][priority]" value="" placeholder="Priority" class="form-control"></td>
                                             <td class="text-end"><input type="text" name="product_special[0][price]" value="" placeholder="Price" class="form-control"></td>
                                             <td class="text-start">
                                                <div class="input-group">
                                                   <input type="text" name="product_special[0][date_start]" value="" placeholder="Date Start" class="form-control date">
                                                   <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                             </td>
                                             <td class="text-start">
                                                <div class="input-group">
                                                   <input type="text" name="product_special[0][date_end]" value="" placeholder="Date End" class="form-control date">
                                                   <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                             </td>
                                             <td class="text-end"><button type="button" onclick="$('#special-row-0').remove();" data-bs-toggle="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                          </tr>
                                       </tbody>
                                       <tfoot>
                                          <tr>
                                             <td colspan="5"></td>
                                             <td class="text-end"><button type="button" id="button-special" data-bs-toggle="tooltip" title="" class="btn btn-primary" data-bs-original-title="Add Special" aria-label="Add Special"><i class="fa fa-plus-circle"></i></button></td>
                                          </tr>
                                       </tfoot>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="contact1">
                           <div class="pt-4">
                              <div class="row">
                                 <div class="col-12">
                                    <button class="btn btn-primary" style="float:right">Add New Alert</button>
                                    <table style="width:100%" class="table table-responsive table-striped w-100">
                                       <thead style="width:100%">
                                          <tr>
                                             <th>
                                                S.No
                                             </th>
                                             <th>Alert Name</th>
                                             <th>Alert Type</th>
                                             <th>Trigger</th>
                                             <th>Frequancy</th>
                                             <th>Status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>1.</td>
                                             <td>Low Inventory</td>
                                             <td>App Notification, Email</td>
                                             <td>Quantity < 100</td>
                                             <td>Once per day</td>
                                             <td>Active</td>
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
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->include('admin/common/footer') ?>