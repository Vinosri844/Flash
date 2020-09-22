@extends('layouts')

@section('content')
    

<!-- Scroll - horizontal and vertical table -->
{{-- <h5><b>Store</b></h5> <br /> --}}
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <div class="card-text">  
                        <div class="row">
                        <div class="col-sm-8">  <h4 class="card-title">Admin Profile</h4>
                            </div> 
                            <div class="col-sm-4">
                            <button class="btn btn-primary float-right" id="contactUsEdit" onclick="settingUpdate(true)"  class="btn btn-primary">Edit</button>
                            </div>
                            
                        </div>
                    </div>   
                </div><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <section class="input-validation">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="card">
                                  <div class="card-header">
                                    
                                  </div>
                                  <div class="card-content">
                                    <div class="card-body">
                                    <form class="form-horizontal" id="contactUsForm" action="{{ route('manager.update', $user->manager_id) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                                         {{ method_field('PUT') }}
                                         @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contactMobileNumber">Username</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($user->manager_name) ? $user->manager_name : '' }}" name="manager_name" id="contactMobileNumber" class="form-control"
                                                            data-validation-required-message="This field is required"
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="storeEmail">Email<span class="text-danger"> *</span></label>
                                                        <div class="controls">
                                                          <input type="email" value="{{ isset($user->manager_emailid) ? $user->manager_emailid : '' }}" name="manager_emailid" id="storeEmail" class="form-control"
                                                            data-validation-required-message="Must be a valid email" autocomplete="new_password" placeholder="Email" disabled>
                                                        </div>
                                                      </div>
                                                      {{-- <div class="form-group">
                                                        <label for="contactMobileNumber">User Role</label>
                                                        <div class="controls">
                                                          <input type="text" value="Super Admin" name="super_admin" id="contactMobileNumber" class="form-control"
                                                            
                                                            placeholder="Enter Your Role" disabled required>
                                                        </div>
                                                      </div> --}}
                                                      
                                                      <div class="form-group d-none" id="passField">
                                                        <label for="storePassword">Password<span class="text-danger"> *</span></label>
                                                        <div class="controls">
                                                          <input type="password" name="manager_password" id="profilePassword" class="form-control"
                                                             placeholder="Password">
                                                        </div>
                                                      </div>
                                                      <div class="form-group d-none" id="conPassField">
                                                        <label for="storeConfirmPassword">Repeat password must match<span class="text-danger"> *</span></label>
                                                        <div class="controls">
                                                          <input type="password" autocomplete="new-password" name="store_confirm_password" id="profileConfirmPassword" data-validation-match-match="manager_password"
                                                            class="form-control"
                                                            placeholder="Repeat Password">
                                                        </div>
                                                      </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contactsmsMobileNumber">Contact Number</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($user->manager_mobileno) ? $user->manager_mobileno : '' }}" name="manager_mobileno" id="contactsmsMobileNumber" class="form-control"
                                                            data-validation-containsnumber-regex="^([0-9]+)$"
                                                            data-validation-containsnumber-message="The regex field format is invalid."
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                      
                                                      @if(isset($user->manager_image) && $user->manager_image != null)
                                                      <div class="my-1">
                                                        <img src="{{ asset('imge/') }}/{{$user->manager_image}} " width="30%" alt="" srcset="">
                                                      </div>
                                                      @endif

                                                      <fieldset class="form-group d-none" id="storePanimageElement">
                                                        <label for="storePANImage">Upload Profile Image<span class="text-danger"> *</span> </label>
                                                      <div class="input-group" >
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text" id="storePANImage">Profile Image</span>
                                                        </div>
                                                        <div class="custom-file">
                                                        <input type="file"  class="custom-file-input" onchange="imageValidate('#storePANImageUpload', '#storePanimageElement');" name="manager_image" id="storePANImageUpload" aria-describedby="storePANImage" disabled>
                                                        <label class="custom-file-label" for="storePANImage">Choose file</label>
                                                        </div>
                                                      </div>
                                                      <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        Image should be jpg, jpeg Format
                                                      </div>
                                                    </fieldset>
                                                    
                                                </div>
                                            </div>
                                            <div id="contactButtons" class="d-none">
                                                <button type="reset" id="contactUsCancel" onclick="settingUpdate(false)" class="btn btn-secondary float-right my-2">Cancel</button>
                                                <button type="submit" id="contactUsUpdate" class="btn btn-primary float-right my-2 mr-2">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                 </div>
                                </div>
                            </div>
                        </div>
                        </section>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Scroll - horizontal and vertical table -->

<!-- // Basic Floating Label Form section start -->
<!-- Button trigger modal -->


  @push('scripts')

  <script>
      function settingUpdate(data){
        if(data){
        $('#contactUsForm input').removeAttr('disabled');
        $('#contactUsEdit').addClass('d-none');
        $('#passField, #conPassField, #contactButtons, #storePanimageElement').removeClass('d-none');
        }else{
            $('#contactUsForm input').attr('disabled', true);
            $('#passField, #conPassField, #contactButtons, #storePanimageElement').addClass('d-none');
            $('#contactUsEdit').removeClass('d-none');
        }
      }
  </script>
  
  @endpush

@endsection