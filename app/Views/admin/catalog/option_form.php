<?= $this->include('admin/common/header') ?>
<div class="content-body">
   <div class="container-fluid">
      <div class="row page-titles mx-0">
         <div class="col-sm-6">
            <div class="welcome-text">
               <h4>Add New Option</h4>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Catalog</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0)">Option</a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Option</a></li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="<?php echo base_url('catalog/category_form'); ?>">
            <button class="btn btn-primary btn-rounded" >
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
                 
                     <form id="form-option" action="#" method="post" data-oc-toggle="ajax">
                        <fieldset>
                          
                           <div class="row mb-3 required">
                              <label class="col-sm-2 col-form-label">Option Name</label>
                              <div class="col-sm-10">
                                 <div class="input-group">
                                    <input type="text" name="option_description[1][name]" value="" placeholder="Option Name" id="input-name-1" class="form-control">
                                 </div>
                                 <div id="error-name-1" class="invalid-feedback"></div>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="input-type" class="col-sm-2 col-form-label">Type</label>
                              <div class="col-sm-10">
                                 <select name="type" id="input-type" class="form-select">
                                    <optgroup label="Choose">
                                       <option value="select">Select</option>
                                       <option value="radio">Radio</option>
                                       <option value="checkbox">Checkbox</option>
                                    </optgroup>
                                    <optgroup label="Input">
                                       <option value="text">Text</option>
                                       <option value="textarea">Textarea</option>
                                    </optgroup>
                                    <optgroup label="File">
                                       <option value="file">File</option>
                                    </optgroup>
                                    <optgroup label="Date">
                                       <option value="date">Date</option>
                                       <option value="time">Time</option>
                                       <option value="datetime">Date &amp; Time</option>
                                    </optgroup>
                                 </select>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="input-sort-order" class="col-sm-2 col-form-label">Sort Order</label>
                              <div class="col-sm-10">
                                 <input type="text" name="sort_order" value="" placeholder="Sort Order" id="input-sort-order" class="form-control">
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <legend>Option Values</legend>
                           <table id="option-value" class="table table-bordered table-hover">
                              <thead>
                                 <tr>
                                    <td class="text-start required">Option Value Name</td>
                                    <td class="text-center">Image</td>
                                    <td class="text-end">Sort Order</td>
                                    <td></td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr id="option-value-row-0">
                                    <td class="text-start">
                                       <input type="hidden" name="option_value[0][option_value_id]" value="">    
                                       <div class="input-group">
                                          <div class="input-group-text"></div>
                                          <input type="text" name="option_value[0][option_value_description][1][name]" value="" placeholder="Option Value Name" id="input-option-value-0-1" class="form-control">    
                                       </div>
                                       <div id="error-option-value-0-1" class="invalid-feedback"></div>
                                    </td>
                                    <td class="text-center">
                                       <div class="card image">
                                          <img src="" alt="" title="" id="thumb-image-0" data-oc-placeholder="" class="card-img-top">      <input type="hidden" name="option_value[0][image]" value="" id="input-image-0">      
                                          <div class="card-body">        <button type="button" data-oc-toggle="image" data-oc-target="#input-image-0" data-oc-thumb="#thumb-image-0" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil-alt"></i> Edit</button>        <button type="button" data-oc-toggle="clear" data-oc-target="#input-image-0" data-oc-thumb="#thumb-image-0" class="btn btn-warning btn-sm btn-block"><i class="fa fa-trash-alt"></i> Clear</button>      </div>
                                       </div>
                                    </td>
                                    <td class="text-end"><input type="text" name="option_value[0][sort_order]" value="" placeholder="Sort Order" class="form-control"></td>
                                    <td class="text-end"><button type="button" onclick="$('#option-value-row-0').remove();" data-bs-toggle="tooltip" title="" class="btn btn-danger" data-bs-original-title="Remove" aria-label="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                 </tr>
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <td colspan="3"></td>
                                    <td class="text-end"><button type="button" onclick="addOptionValue();" data-bs-toggle="tooltip" title="" class="btn btn-primary" data-bs-original-title="Add Option Value" aria-label="Add Option Value"><i class="fa fa-plus-circle"></i></button></td>
                                 </tr>
                              </tfoot>
                           </table>
                        </fieldset>
                        <input type="hidden" name="option_id" value="0" id="input-option-id">
                     </form>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->include('admin/common/footer') ?>