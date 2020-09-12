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
                        <div class="col-sm-8">  <h4 class="card-title">Footer Detail</h4>
                            </div> 
                            <div class="col-sm-4">
                            <button class="btn btn-primary float-right" id="footerEdit" onclick="changeField(true)"  class="btn btn-primary">Edit</button>
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
                                    <form class="form-horizontal" id="footerForm" action="{{ route('footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                                         {{ method_field('PUT') }}
                                         @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="footerMobileNumber">Phone Number</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($footer->phone_number) ? $footer->phone_number : '' }}" name="phone_number" id="footerMobileNumber" class="form-control"
                                                            data-validation-containsnumber-regex="^([0-9]+)$"
                                                            data-validation-containsnumber-message="The regex field format is invalid."
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="footerMobileNumber1">Mobile Number 1</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($footer->mobile1) ? $footer->mobile1 : '' }}" name="mobile1" id="footerMobileNumber1" class="form-control"
                                                            data-validation-containsnumber-regex="^([0-9]+)$"
                                                            data-validation-containsnumber-message="The regex field format is invalid."
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="contactMobileNumber2">Mobile Number 2</label>
                                                        <div class="controls">
                                                          <input type="text" value="{{ isset($footer->mobile2) ? $footer->mobile2 : '' }}" name="mobile2" id="contactMobileNumber2" class="form-control"
                                                            data-validation-containsnumber-regex="^([0-9]+)$"
                                                            data-validation-containsnumber-message="The regex field format is invalid."
                                                            placeholder="Enter Your Mobile Number" disabled required>
                                                        </div>
                                                      </div>
                                                      <fieldset class="form-group">
                                                        <label for="footerEmail">Email Address</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="footerEmail">Email</span>
                                                            </div>
                                                        <input type="email" value="{{ isset($footer->email) ? $footer->email : '' }}" class="form-control"
                                                        data-validation-required-message="Must be a valid email" autocomplete="new_password" name="email" placeholder="Email" aria-describedby="footerEmail" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                      <fieldset class="form-group">
                                                        <label for="footerPlayLink">Google Play Store</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="footerEmail">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->google_play_store) ? $footer->google_play_store : '' }}" class="form-control"
                                                        name="google_play_store" placeholder="Google Play Store" aria-describedby="footerPlayLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                      <fieldset class="form-group">
                                                        <label for="footerAppLink">App Store</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="footerAppLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->app_store) ? $footer->app_store : '' }}" class="form-control"
                                                        name="app_store" placeholder="App Store" aria-describedby="footerAppLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                      <fieldset class="form-group">
                                                        <label for="deliveryTitle">Delivery Title</label>
                                                      <div class="input-group">
                                    
                                                        <input type="text" value="{{ isset($footer->delivery_title) ? $footer->delivery_title : '' }}" class="form-control" placeholder="Delivery Title" name="delivery_title" aria-describedby="deliveryTitle" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                      <fieldset class="form-group">
                                                        <label for="basketTitle">Basket Title</label>
                                                      <div class="input-group">
                                    
                                                        <input type="text" value="{{ isset($footer->basket_title) ? $footer->basket_title : '' }}" class="form-control" placeholder="Basket Title" name="basket_title" aria-describedby="basketTitle" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6">
                                                    <fieldset class="form-group">
                                                        <label for="facebookLink">Facebook</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="facebookLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->facebook) ? $footer->facebook : '' }}" class="form-control"
                                                        name="facebook" placeholder="Facebook" aria-describedby="facebookLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="twitterLink">Twitter</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="twitterLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->twitter) ? $footer->twitter : '' }}" class="form-control"
                                                        name="twitter" placeholder="Twitter" aria-describedby="twitterLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                    
                                                    <fieldset class="form-group">
                                                        <label for="instaLink">Instagram</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="instaLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->instagram) ? $footer->instagram : '' }}" class="form-control"
                                                        name="instagram" placeholder="Instagram" aria-describedby="instaLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="wpLink">Whatsapp</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="wpLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->whatsapp) ? $footer->whatsapp : '' }}" class="form-control"
                                                        name="whatsapp" placeholder="Whatsapp" aria-describedby="wpLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="mesLink">Facebook Messenger</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="mesLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->fb_messenger) ? $footer->fb_messenger : '' }}" class="form-control"
                                                        name="fb_messenger" placeholder="Facebook Messenger" aria-describedby="mesLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="gpLink">Google Plus</label>
                                                          <div class="input-group">
                                                          <div class="input-group-prepend">
                                                              <span class="input-group-text" id="gpLink">Link</span>
                                                            </div>
                                                        <input type="text" value="{{ isset($footer->google_plus) ? $footer->google_plus : '' }}" class="form-control"
                                                        name="google_plus" placeholder="Google Plus" aria-describedby="gpLink" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="ClockTitle">Clock Title</label>
                                                      <div class="input-group">
                                    
                                                        <input type="text" value="{{ isset($footer->clock_title) ? $footer->clock_title : '' }}" class="form-control" placeholder="Clock Title" name="clock_title" aria-describedby="ClockTitle" disabled>
                                                        
                                                      </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div id="footerButtons" class="d-none">
                                                <button type="reset" id="footerCancel" onclick="changeField(false)" class="btn btn-secondary float-right my-2">Cancel</button>
                                                <button type="submit" id="footerUpdate" class="btn btn-primary float-right my-2 mr-2">Update</button>
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
      function changeField(data){
        if(data){
        $('#footerForm input').removeAttr('disabled');
        $('#footerButtons').removeClass('d-none');
        $('#footerEdit').addClass('d-none');
        }else{
            $('#footerForm input').attr('disabled', true);
            $('#footerButtons').addClass('d-none');
            $('#footerEdit').removeClass('d-none');
        }
      }
  </script>
  
  @endpush

@endsection