@csrf

                
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title mb-0">Membership Info</h4> <br>
    </div>
    
  <div class="col-md-6">
    <div class="form-group">
        <fieldset>
            <label for="initialAmount">Initial Amount<span class="text-danger"> *</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="initialAmount">Value</span>
              </div>
            <input type="number" class="form-control" data-validation-required-message="This field is required"  value="{{ isset($member->initial_amount) ? $member->initial_amount : '' }}" name="initial_amount" id="initialAmount" placeholder="Enter Initial Amount" aria-describedby="storeErrand">
          </div>
        </fieldset>
    </div>
    <div class="form-group">
        <fieldset>
            <label for="currentAmount">Current Membership Amount<span class="text-danger"> *</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="currentAmount">Value</span>
              </div>
            <input type="number" class="form-control" data-validation-required-message="This field is required" value="{{ isset($member->current_amount) ? $member->current_amount : '' }}" name="current_amount" id="currentAmount" placeholder="Enter Current Amount" aria-describedby="storeErrand">
           
          </div>
        </fieldset>
    </div>
    <div class="form-group">
        <fieldset>
            <label for="membershipValidity">Membership Validity<span class="text-danger"> *</span></label>
          <div class="input-group">
            <input type="text" class="form-control" data-validation-required-message="This field is required" value="{{ isset($member->validity) ? $member->validity : '' }}" name="validity" id="membershipValidity" placeholder="Validity" aria-describedby="storeErrand">
            <div class="input-group-append">
              <span class="input-group-text" id="membershipValidity">Months</span>
            </div>
          </div>
        </fieldset>
    </div>
    
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <fieldset>
            <label for="orderAmount">Minimum Order Amount<span class="text-danger"> *</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="orderAmount">Value</span>
              </div>
            <input type="number" class="form-control" value="{{ isset($member->order_amount) ? $member->order_amount : '' }}" name="order_amount" id="orderAmount" placeholder="Order Amount" aria-describedby="storeErrand">
            
          </div>
        </fieldset>
    </div>
    <div class="form-group">
        <fieldset>
            <label for="cashbackAmount">Cashback Amount<span class="text-danger"> *</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="cashbackAmount">Value</span>
              </div>
            <input type="number" class="form-control" value="{{ isset($member->cashback_amount) ? $member->cashback_amount : '' }}" name="cashback_amount" id="cashbackAmount" placeholder="Cashback Amount" aria-describedby="storeErrand">
            
          </div>
        </fieldset>
    </div>

    <div class="form-group mt-3">
        <label for="memberActive" class="mr-2">Active  <br></label>
            <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                <input type="checkbox" class="custom-control-input" name="isActive" <?php if(isset($member->isActive) && $member->isActive == 0) { echo '';}else{  echo 'checked';} ?> id="memberActive">
                <label class="custom-control-label" for="memberActive"> 
                </label>
              </div>
    </div>
   
  </div>

</div>

<a href="{{ route('membership.index') }}"  class="btn btn-info float-left my-2">Back</a>

