@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Delivery Person Create</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="deliveryperson_form" id="deliveryperson_form" action="{{ route('deliveryperson_submit') }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="deliveryperson_name" class="form-control" placeholder="Delivery Person Name"
                                                       name="deliveryperson_name" >
                                                <label for="first-name-floating">Delivery Person Name</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                          <div class="form-group">
                                              <div class="controls">
                                                <input type="text" value="{{ isset($branch->seller_branch_contact_no) ? $branch->seller_branch_contact_no : '' }}" name="dperson_mobile_number" id="dpersonMobileNumber" class="form-control"
                                                  data-validation-containsnumber-regex="^([0-9]+)$"
                                                  data-validation-containsnumber-message="The regex field format is invalid."
                                                  placeholder="Enter Your Mobile Number" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                          <div class="form-group">
                                            <div class="controls">
                                              <input type="email" value="{{ isset($branch->seller_branch_emailid) ? $branch->seller_branch_emailid : '' }}" name="dperson_email" id="dperson_email" class="form-control"
                                                data-validation-required-message="Must be a valid email" autocomplete="new_password" placeholder="Email">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                            <textarea type="text" id="dperson_address" class="form-control" placeholder="Delivery Person Address"
                                                      name="dperson_address" cols="30" rows="4"></textarea>
                                                <label for="first-name-floating">Delivery Person Address</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                          <div class="form-group">
                                           <label for="storePassword">Password</label>
                                           <div class="controls">
                                             <input type="password" name="dperson_password" id="dpersonPassword" class="form-control"
                                               data-validation-required-message="This field is required" placeholder="Password">
                                           </div>
                                         </div>
                                        </div>
                                        <div class="col-6">
                                        <fieldset>
                                            <label for="storePANImage">Upload Profile Image </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="dpersonImage">Profile Image</span>
                                            </div>
                                            <div class="custom-file">
                                            <input type="file"  class="custom-file-input" name="dpersonImage" id="dpersonImage" aria-describedby="dpersonImage">
                                              <label class="custom-file-label" for="dpersonImage">Choose file</label>
                                            </div>
                                          </div>
                                        </fieldset>
                                      </div>
                                    </div>
                                    <h4 class="card-title">Vehicle Info</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="vehicle_name" class="form-control" placeholder="Vehicle Name"
                                                       name="vehicle_name" >
                                                <label for="first-name-floating">Vehicle Name</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="vehicle_number" class="form-control" placeholder="Vechile Number"
                                                       name="vehicle_number" >
                                                <label for="first-name-floating">Vechile Number</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="licence_number" class="form-control" placeholder="Licence Number"
                                                       name="licence_number" >
                                                <label for="first-name-floating">Licence Number</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <fieldset>
                                            <label for="storePANImage">Upload Licence Image </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="dlicenceImage">Licence Image</span>
                                            </div>
                                            <div class="custom-file">
                                            <input type="file"  class="custom-file-input" name="dlicenceImage" id="dlicenceImage" aria-describedby="dlicenceImage">
                                              <label class="custom-file-label" for="dlicenceImage">Choose file</label>
                                            </div>
                                          </div>
                                        </fieldset>
                                      </div>
                                    </div>

                                    <h4 class="card-title">Other Settings</h4>
                                    <div class="row">
                                      <div class="col-6">
                                          <div class="form-group" style="display: flex">
                                              <label for="eventStatus" class="mr-2">Active</label>
                                              <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                  <input type="checkbox" class="custom-control-input" name="is_active" checked id="is_active">
                                                  <label class="custom-control-label" for="is_active">
                                                  </label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-6">
                                          <div class="form-group" style="display: flex">
                                              <label for="eventStatus" class="mr-2">Is Approve</label>
                                              <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                  <input type="checkbox" class="custom-control-input" name="is_approve" checked id="is_approve">
                                                  <label class="custom-control-label" for="is_approve">
                                                  </label>
                                              </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Create</button>
                                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Floating Label Form section end -->
@endsection
