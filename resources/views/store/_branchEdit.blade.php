<section id="form-control-repeater" class="mt-2 w-100">
    <!-- phone repeater -->
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Multiple Branches</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="contact-repeater">
              <div data-repeater-list="branches">
                
                
                
                  @foreach ($branches as $k => $item)
                      <div class="row justify-content-between border py-1 px-1 mb-2" data-repeater-item>
                        <div class="col-md-4">
                            <input type="hidden" name="seller_branch_id" value="{{$item->seller_branch_id}}">
                          <div class="form-group">
                              <label for="storeBranchName">Branch Name</label>
                              <div class="controls">
                                <input type="text" value="{{ isset($item->seller_branch_name) ? $item->seller_branch_name : '' }}"  name="store_branch_name" id="storeBranchName" class="form-control"
                                   placeholder="Branch Name">
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="storePincode">Pincode</label>
                              <div class="controls">
                                <input type="text"  value="{{ isset($item->seller_branch_pincode) ? $item->seller_branch_pincode : '' }}" name="store_pincode" id="storePincode" class="form-control"
                                   placeholder="Pincode">
                              </div>
                            </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="storeBranchType">Branch Type</label>
                          <div class="controls">
                            <input type="text" value="{{ isset($item->seller_branch_type) ? $item->seller_branch_type : '' }}"  name="store_branch_type" id="storeBranchType" class="form-control"
                               placeholder="Branch Type">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="storeBranchCity">Branch City</label>
                          <div class="controls">
                            <input type="text" value="{{ isset($item->seller_branch_city) ? $item->seller_branch_city : '' }}"  name="store_branch_city" id="storeBranchCity" class="form-control"
                               placeholder="Branch City">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <fieldset class="form-group">
                            <label for="storeShortAddress">Short Address</label>
                            <textarea class="form-control" id="storeShortAddress" name="store_short_address" rows="5" placeholder="Address">{{ isset($item->seller_branch_address) ? $item->seller_branch_address : '' }}</textarea>
                        </fieldset>
                      </div>
                      <div class="col-md-12 col-12 form-group">
                        <button class="btn btn-danger float-right" type="button" onclick="branch_delete({{$item->seller_branch_id}})" data-toggle="modal" data-target="#exampleModal">
                            Delete
                        </button>
                        </div>
                      
                      </div>
                  @endforeach
                  
                
              </div>
              <div class="row">
                <div class="col-12 my-3">
                  <button class="btn btn-icon rounded-circle btn-primary" data-toggle="modal" data-target="#staticBackdrop" id="addNewStep" type="button">
                    <i class="bx bx-plus" style="vertical-align: 0;"></i>
                  </button>
                  <span class="ml-1 font-weight-bold text-primary">ADD Branch</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   
    <!-- /phone repeater -->
 
</section>


