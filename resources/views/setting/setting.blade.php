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
                        <div class="col-sm-8">  <h4 class="card-title">Settings Detail</h4>
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
                                    <form class="form-horizontal" id="contactUsForm" action="{{ route('setting.update', $setting->contact_us_id) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                                         {{ method_field('PUT') }}
                                         @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contactMobileNumber">Contact Number</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($setting->contact_number) ? $setting->contact_number : '' }}" name="contact_number" id="contactMobileNumber" class="form-control"
                                                            data-validation-containsnumber-regex="^([0-9]+)$"
                                                            data-validation-containsnumber-message="The regex field format is invalid."
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                      <fieldset class="form-group">
                                                        <label for="storeVal2">Delivery Charge</label>
                                                      <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="deliveryCharge">Value</span>
                                                          </div>
                                                        <input type="number" value="{{ isset($setting->delivery_charge) ? $setting->delivery_charge : '' }}" class="form-control" placeholder="Delivery Charge" name="delivery_charge" aria-describedby="deliveryCharge" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contactsmsMobileNumber">SMS Contact Number</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($setting->sms_contact_number) ? $setting->sms_contact_number : '' }}" name="sms_contact_number" id="contactsmsMobileNumber" class="form-control"
                                                            data-validation-containsnumber-regex="^([0-9]+)$"
                                                            data-validation-containsnumber-message="The regex field format is invalid."
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                      <div style="display: flex; width:100%; justify-content: space-between">
                                                        <fieldset class="form-group" style="width: 45%;">
                                                          <label for="minTime">Min Time</label>
                                                            <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="minTime">Time</span>
                                                              </div>
                                                          <input type="time" value="{{ isset($setting->mintime) ? $setting->mintime : '' }}" class="form-control" name="mintime" placeholder="Min Time" aria-describedby="minTime" disabled>
                                                          
                                                        </div>
                                                      </fieldset>
                                                      <fieldset class="form-group" style="width: 45%;">
                                                          <label for="maxTime">Max Time</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="maxTime">Time</span>
                                                              </div>
                                                          <input type="time" value="{{ isset($setting->maxtime) ? $setting->maxtime : '' }}" class="form-control" placeholder="Max Time" name="maxtime" aria-describedby="maxTime" disabled>
                                                         
                                                        </div>
                                                      </fieldset>
                                                      </div>
                                                </div>
                                                
                                            </div>
                                            <div id="contactButtons" class="d-none">
                                                <button type="reset" id="contactUsCancel" onclick="settingUpdate(false)" class="btn btn-secondary float-right my-2">Cancel</button>
                                                <button type="submit" id="contactUsUpdate" class="btn btn-primary float-right my-2 mr-2">Update</button>
                                            </div>
                                        </form>
                                        <div class="col-md-6">
                                          <label for="" class="mr-2">Multi Store Flag</label>
                                          <div class="custom-control custom-switch custom-switch-glow custom-control-inline" style="vertical-align: bottom">
                                            <input type="checkbox" class="custom-control-input" {{$setting->multistore == 1 ? 'checked' : ''}} value="{{$setting->contact_us_id}}" onchange="change_status(this.value, 'contact_us', '#customSwitchGlow', 'contact_us_id', 'multistore');" id="customSwitchGlow">
                                            <label class="custom-control-label" for="customSwitchGlow">
                                            </label>
                                        </div>
                                        </div>
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
        $('#contactButtons').removeClass('d-none');
        $('#contactUsEdit').addClass('d-none');
        }else{
            $('#contactUsForm input').attr('disabled', true);
            $('#contactButtons').addClass('d-none');
            $('#contactUsEdit').removeClass('d-none');
        }
      }
  </script>
  
  @endpush

@endsection