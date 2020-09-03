@csrf

                
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title mb-0">General Info</h4> <br>
    </div>
    
  <div class="col-md-6">
    <div class="form-group">
      <label for="storeName">Customer Name</label>
      <div class="controls">
      <input type="text" name="customer_name" id="customerName" class="form-control" value="{{ isset($customer->customer_name) ? $customer->customer_name : '' }}"
          data-validation-required-message="This field is required" placeholder="Store Name">
      </div>
    </div>
    
    {{-- <div class="form-group">
        <label for="customerAnniversaryDate">Anniversary Date</label>
        <fieldset class="form-group position-relative has-icon-left">
            <input type="text" class="form-control"  onfocus="(this.type='date')" id="customerAnniversaryDate" name="customer_anniversary_date" placeholder="Select Anniversary Date">
            <div class="form-control-position">
              <i class='bx bx-calendar'></i>
            </div>
          </fieldset>
    </div> --}}
    <div class="form-group">
        <label for="customerAnniversaryDate">Anniversary Date</label>
        <fieldset class="form-group position-relative has-icon-left">
            <input type="text" class="form-control single-daterange" value="<?php date('m/d/Y', strtotime($customer->customer_anniversary_date))  ?>" id="customerAnniversaryDate" name="customer_anniversary_date" placeholder="Select Anniversary Date">
            <div class="form-control-position">
              <i class='bx bx-calendar'></i>
            </div>
          </fieldset>
    </div>
    
    
    <div class="form-group">
        <label for="customerMobileNumber">Mobile Number</label>
        <div class="controls">
          <input type="text" value="{{ isset($customer->customer_contact_no) ? $customer->customer_contact_no : '' }}" name="customer_mobile_number" id="customerMobileNumber" class="form-control"
            data-validation-containsnumber-regex="^([0-9]+)$"
            data-validation-containsnumber-message="The regex field format is invalid."
            placeholder="Enter Your Mobile Number" required>
        </div>
      </div>

      <div style="display: flex; width: 100%; justify-content: space-between;">
        
        <div class="form-group" style="width: 35%">
            <label for="customerGender">Select Gender</label>
            <fieldset>            
                <select class="form-control" name="customer_gender" id="customerGender">
                    <?php  $genders = ['Male', 'Female']; ?>
                    @foreach ($genders as $item)
                        <option value="{{$item}}" {{$item == $customer->customer_gender ? ' selected' : ''}}>{{ $item }}</option>
                    @endforeach              
                
                </select>
            </fieldset>
        </div>
        <div class="mt-1">
            <div class="custom-control custom-switch custom-switch-glow custom-control-inline float-right">
                <input type="checkbox" class="custom-control-input" name="store_active" <?php if(isset($store->isactive) && $store->isactive == 0) { echo '';}else{  echo 'checked';} ?> id="storeActive">
                <label class="custom-control-label" for="storeActive"> 
                </label>
            </div>
            <label for="storeActive" class="mr-2 float-right">Active <br>( show Customer )</label>
        </div>
      </div>
  
  </div>
  <div class="col-md-6">
    
      <div class="form-group">
        <label for="customerEmail">Email id</label>
        <div class="controls">
          <input type="email" value="{{ isset($customer->customer_emailid) ? $customer->customer_emailid : '' }}" name="customer_email" id="customerEmail" class="form-control"
            data-validation-required-message="Must be a valid email" autocomplete="new_password" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="customerBirthDate">Birth Date</label>
      <fieldset class="form-group position-relative has-icon-left">
        <input type="text" class="form-control single-daterange" value="<?php date('m/d/Y', strtotime($customer->customer_birthdate))  ?>" id="customerBirthDate" name="customer_birth_date" placeholder="Select Birth Date">
        <div class="form-control-position">
          <i class='bx bx-calendar'></i>
        </div>
      </fieldset>
      </div>
      
      <div class="form-group">
        <label for="customerProfession">Profession</label>
        <div class="controls">
        <input type="text" name="customer_profession" id="customerProfession" class="form-control" value="{{ isset($customer->customer_profession) ? $customer->customer_profession : '' }}"
            data-validation-required-message="This field is required" placeholder="Customer Profession">
        </div>
      </div>
      <div class="form-group">
        <label for="customerProfession">Marital Status</label>
        <div class="controls">
        <input type="text" name="customer_profession" id="customerProfession" class="form-control" value="{{ isset($customer->customer_profession) ? $customer->customer_profession : '' }}"
            data-validation-required-message="This field is required" placeholder="Customer Profession">
        </div>
      </div>
      
  </div>

</div>

<a href="{{ route('customer.index') }}"  class="btn btn-info float-left my-2">Back</a>

