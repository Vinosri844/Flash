                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title mb-0">General Info</h4> <br>
                    </div>
                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="storeName">Store Name</label>
                      <div class="controls">
                      <input type="text" name="store_name" id="storeName" class="form-control" value="{{ isset($store->seller_name) ? $store->seller_name : '' }}"
                          data-validation-required-message="This field is required" placeholder="Store Name">
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="storeMobileNumber">Mobile Number</label>
                        <div class="controls">
                          <input type="text" value="{{ isset($store->seller) ? $store->seller_name : '1234567890' }}" name="store_mobile_number" id="storeMobileNumber" class="form-control"
                            data-validation-containsnumber-regex="^([0-9]+)$"
                            data-validation-containsnumber-message="The regex field format is invalid."
                            placeholder="Enter Your Mobile Number" required>
                        </div>
                      </div>
                    
                    
                    
                    <div class="form-group">
                      <label for="storePassword">Password</label>
                      <div class="controls">
                        <input type="password" name="store_password" id="storePassword" class="form-control"
                          data-validation-required-message="This field is required" placeholder="Password">
                      </div>
                    </div>
                    
                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="storeNameTamil">Store Name (Tamil)</label>
                        <div class="controls">
                          <input type="text" value="{{ isset($store->t_seller_name) ? $store->t_seller_name : '' }}" name="store_name_tamil" id="storeNameTamil" class="form-control"
                            data-validation-required-message="This field is required" placeholder="Store Name (tamil)">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="storeEmail">Email</label>
                        <div class="controls">
                          <input type="email" value="{{ isset($store->seller) ? $store->seller_name : 'sample@gmail.com' }}" name="store_email" id="storeEmail" class="form-control"
                            data-validation-required-message="Must be a valid email" autocomplete="new_password" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="storeConfirmPassword">Repeat password must match</label>
                        <div class="controls">
                          <input type="password" autocomplete="new-password" name="store_confirm_password" id="storeConfirmPassword" data-validation-match-match="store_password"
                            class="form-control" data-validation-required-message="Repeat password must match"
                            placeholder="Repeat Password">
                        </div>
                      </div>
                   
                  </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title mt-4">Other Settings</h4>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="form-group" style="display: flex">
                            <label for="storeActive" class="mr-2">Active <br>( show store )</label>
                            <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="store_active" {{ isset($store->isactive) == 1 ? 'checked' : '' }} id="storeActive">
                                <label class="custom-control-label" for="storeActive"> 
                                </label>
                              </div>
                            <label for="storeApprove" class="ml-auto mr-2">Is Approve <br>( permission to store )</label>
                            <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                <input type="checkbox" class="custom-control-input"  {{ isset($store->isapprove) == 1 ? 'checked' : '' }} name="store_approve"  id="storeApprove">
                                <label class="custom-control-label" for="storeApprove"> 
                                </label>
                              </div>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <label for="storeMinimumCartValue">Store Minimum cart Value</label>
                            <div class="controls">
                              <input type="number" value="{{ isset($store->seller_errand) ? $store->seller_errand : '' }}" id="storeMinimumCartValue" name="store_min_value" class="touchspin-min-max" value="0">
                            </div>
                          </div>
                          <fieldset>
                              <label for="storeErrand">Store Errand</label>
                            <div class="input-group">
                              <input type="text" class="form-control" value="{{ isset($store->seller_errand) ? $store->seller_errand : '' }}" name="store_errand" id="storeErrand" placeholder="Store Errand" aria-describedby="storeErrand">
                              <div class="input-group-append">
                                <span class="input-group-text" id="storeErrand">%</span>
                              </div>
                            </div>
                          </fieldset>
                    </div>
                    <div class="col-md-6 mt-1">
                        <fieldset class="form-group">
                            <label for="storeDescription">Store Description</label>
                            <textarea class="form-control" value="{{ isset($store->seller_description) ? $store->seller_description : '' }}" name="store_description" id="storeDescription" rows="7" placeholder="Descripton"></textarea>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title mt-4">Service Info</h4>
                    </div>
                    
                    <div class="col-md-6 mt-1">
                        <div class="form-group">
                            <label for="serviceTaxNumber">Service Tax Number</label>
                            <div class="controls">
                              <input type="text" value="{{ isset($store->seller_service_tax_number) ? $store->seller_service_tax_number : '' }}" name="store_service_tax_num" id="serviceTaxNumber" class="form-control"
                                data-validation-required-message="This field is required" placeholder="Service TAX Number">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="CSTNumber">CST tin Number</label>
                            <div class="controls">
                              <input type="text" value="{{ isset($store->seller_cst_tin_number) ? $store->seller_cst_tin_number : '' }}" name="store_cst_num" id="CSTNumber" class="form-control"
                                data-validation-required-message="This field is required" placeholder="CST tin Number">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="GSTNumber">GST tin Number</label>
                            <div class="controls">
                              <input type="text" value="{{ isset($store->seller_gst_tin_number) ? $store->seller_gst_tin_number : '' }}" name="store_gst_num" id="GSTNumber" class="form-control"
                                data-validation-required-message="This field is required" placeholder="GST Number">
                            </div>
                          </div>
                          <fieldset>
                              <label for="storePANImage">Upload PAN Card Image </label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="storePANImage">PAN Image</span>
                              </div>
                              <div class="custom-file">
                              <input type="file" value="{{ isset($store->seller_pan_number_image) ? $store->seller_pan_number_image : ''}}" class="custom-file-input" name="store_pan_image" id="storePANImage" aria-describedby="storePANImage">
                                <label class="custom-file-label" for="storePANImage">Choose file</label>
                              </div>
                            </div>
                          </fieldset>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="form-group">
                            <label for="FSSAINumber">FSSAI Number</label>
                            <div class="controls">
                              <input type="text" value="{{ isset($store->seller_fssai_number) ? $store->seller_fssai_number : '' }}" name="store_fssai_num" id="FSSAINumber" class="form-control"
                                data-validation-required-message="This field is required" placeholder="FSSAI Number">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="PANNumber">PAN Number</label>
                            <div class="controls">
                              <input type="text" value="{{ isset($store->seller_pan_number) ? $store->seller_pan_number : '' }}" name="store_pan_num" id="PANNumber" class="form-control"
                                data-validation-required-message="This field is required" placeholder="PAN Number">
                            </div>
                          </div>
                          <div style="display: flex;">
                            <fieldset class="form-group mr-1">
                              <label for="storeVal1">Val 1</label>
                            <div class="input-group">
                              <input type="text" value="{{ isset($store->vat_1) ? $store->vat_1 : '' }}" class="form-control" name="store_val_1" placeholder="Val 1" aria-describedby="storeVal1">
                              <div class="input-group-append">
                                <span class="input-group-text" id="storeVal1">%</span>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset class="form-group">
                              <label for="storeVal2">Val 2</label>
                            <div class="input-group">
                              <input type="text" value="{{ isset($store->vat_2) ? $store->vat_2 : '' }}" class="form-control" placeholder="Val 2" name="store_val_2" aria-describedby="storeVal2">
                              <div class="input-group-append">
                                <span class="input-group-text" id="storeVal2">%</span>
                              </div>
                            </div>
                          </fieldset>
                          </div>
                          <fieldset>
                              <label for="storeCompanyLogo">Upload Company LOGO</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="storeCompanyLogo">Company Logo</span>
                              </div>
                              <div class="custom-file">
                                <input type="file" {{ isset($store->seller_company_image) ? $store->seller_company_image : ''}}" class="custom-file-input" name="store_company_logo" id="storeCompanyLogo" aria-describedby="storeCompanyLogo">
                                <label class="custom-file-label" for="storeCompanyLogo">Choose file</label>
                              </div>
                            </div>
                          </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title mt-4">Branch Info</h4>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="form-group">
                            <label for="storeBranchName">Branch Name</label>
                            <div class="controls">
                              <input type="text" value="{{ isset($branch->seller_branch_name) ? $branch->seller_branch_name : '' }}"  name="store_branch_name" id="storeBranchName" class="form-control"
                                data-validation-required-message="This field is required" placeholder="Branch Name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="storeContactNumber">Contact Number</label>
                            <div class="controls">
                              <input type="text"  value="{{ isset($branch->seller_branch_contact_no) ? $branch->seller_branch_contact_no : '' }}" name="store_contact_number" id="storeContactNumber" class="form-control"
                                data-validation-required-message="This field is required" placeholder="Contact Number">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="storePincode">Pincode</label>
                            <div class="controls">
                              <input type="text"  value="{{ isset($branch->seller_branch_pincode) ? $branch->seller_branch_pincode : '' }}" name="store_pincode" id="storePincode" class="form-control"
                                data-validation-required-message="This field is required" placeholder="Pincode">
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6 mt-1">
                        <fieldset class="form-group">
                            <label for="storeSelectBranch">Select Branch</label>
                            <select class="form-control" name="store_select_branch" id="storeSelectBranch">
                              <option>IT</option>
                              <option>Blade Runner</option>
                              <option>Thor Ragnarok</option>
                            </select>
                          </fieldset>
                        <fieldset class="form-group">
                            <label for="storeSelectCity">Select City</label>
                            <select class="form-control" name="store_select_city" id="storeSelectCity">
                              <option>IT</option>
                              <option>Blade Runner</option>
                              <option>Thor Ragnarok</option>
                            </select>
                          </fieldset>
                    </div>
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <label for="storeShortAddress">Short Address</label>
                            <textarea class="form-control"  value="{{ isset($branch->seller_branch_address) ? $branch->seller_branch_address : '' }}" id="storeShortAddress" name="store_short_address" rows="6" placeholder="Address"></textarea>
                        </fieldset>
                    </div>
                </div>

                <button type="submit" class="btn btn-info float-left my-2">Back</button>
                <button type="submit" class="btn btn-primary float-right my-2">Update</button>
              