@csrf

                
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title mb-0">Offer Info</h4> <br>
    </div>
    
  <div class="col-md-6">
    <div class="form-group">
      <label for="storeOfferTitle">Title</label>
      <div class="controls">
      <input type="text" name="title" id="storeOfferTitle" class="form-control" value="{{ isset($store_offer->title) ? $store_offer->title : '' }}"
          data-validation-required-message="This field is required" placeholder="Offer Title">
      </div>
    </div>
    <div class="form-group">
      <label for="storeOfferSubTitle">Sub Title</label>
      <div class="controls">
      <input type="text" name="subtitle" id="storeOfferSubTitle" class="form-control" value="{{ isset($store_offer->subtitle) ? $store_offer->subtitle : '' }}"
          data-validation-required-message="This field is required" placeholder="Offer Sub-Title">
      </div>
    </div>

    @if (isset($store_offer))
      <div class="form-group">
        <label for="storeOffers">Select Stores</label>
        <select class="select2 form-control" id="storeOffers" name="seller_id"  autocomplete="new-password" data-placeholder="Select Stores...">
            
            @if (isset($stores) && !empty($stores))
                @foreach ($stores as $k => $item)
                    <option value="{{$item->seller_id}}" {{ $store_offer->seller_id == $item->seller_id ? ' selected' : ''}}>{{$item->seller_name}}</option>
                @endforeach
            @endif
        </select>
      </div>
    @else
      <div class="form-group">
        <label for="storeOffers">Select Stores</label>
        <select class="select2 form-control" id="storeOffers" name="seller_ids[]" multiple="multiple"  autocomplete="new-password" data-placeholder="Select Stores...">
            
            @if (isset($stores) && !empty($stores))
                @foreach ($stores as $k => $item)
                    <option value="{{$item->seller_id}}">{{$item->seller_name}}</option>
                @endforeach
            @endif
        </select>
      </div>
    @endif
    
    
    
      {{-- <optgroup label="Figures">
        <option value="romboid">Romboid</option>
      </optgroup> --}}

      <div style="display: flex;">
        <fieldset class="form-group mr-1">
          <label for="storeOfferMinDiscount">Min Discount</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="storeOfferMinDiscount">Value</span>
              </div>
          <input type="number" value="{{ isset($store_offer->min_discount) ? $store_offer->min_discount : '' }}" class="form-control" name="min_discount" placeholder="Min Discount" aria-describedby="storeOfferMinDiscount">
          
        </div>
      </fieldset>
      <fieldset class="form-group">
          <label for="storeOfferMaxDiscount">Max Discount</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="storeOfferMaxDiscount">Value</span>
              </div>
          <input type="number" value="{{ isset($store_offer->max_discount) ? $store_offer->max_discount : '' }}" class="form-control" placeholder="Max Discount" name="max_discount" aria-describedby="storeOfferMaxDiscount">
         
        </div>
      </fieldset>
      </div>

    
  </div>
  <div class="col-md-6">
   
      <div class="form-group">
        <label for="storeOfferStartDate">Start Date</label>
        <fieldset class="form-group position-relative has-icon-left">
            <input type="text" class="form-control pickadate-months-year" value="{{  isset($store_offer->start_date) ? date('d M, Y', strtotime($store_offer->start_date)) : null  }}" id="storeOfferStartDate" name="start_date" placeholder="Start Date">
            <div class="form-control-position">
              <i class='bx bx-calendar'></i>
            </div>
          </fieldset>
    </div>
      <div class="form-group">
        <label for="storeOfferEndDate">End Date</label>
        <fieldset class="form-group position-relative has-icon-left">
            <input type="text" class="form-control pickadate-months-year" value="{{  isset($store_offer->end_date) ? date('d M, Y', strtotime($store_offer->end_date)) : null  }}" id="storeOfferEndDate" name="end_date" placeholder="End Date">
            <div class="form-control-position">
              <i class='bx bx-calendar'></i>
            </div>
          </fieldset>
    </div>
    
    <div style="display: flex; width:100%; justify-content: space-between;">
      <div class="form-group">
        <label for="storeOfferActive" class="mt-2 mr-2">Active <br>( show Offer Status )</label>
        <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
            <input type="checkbox" class="custom-control-input" name="isactive" <?php if(isset($store_offer->isactive) && $store_offer->isactive == 0) { echo '';}else{  echo 'checked';} ?> id="storeOfferActive">
            <label class="custom-control-label" for="storeOfferActive"> 
            </label>
          </div>
      </div>
      @if(isset($store_offer->offer_image))
     
        <img src="{{ asset('imge/o_227/so22072019/OriginalImage/') }}/{{$store_offer->offer_image}} " width="30%" alt="" srcset="">
      
      @endif
    </div>

    <div class="form-group" style="margin-top: 4px;">
        <fieldset>
            <label for="storeOfferImage">Upload Offer Image </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="storeOfferImage">Offer Image</span>
            </div>
            <div class="custom-file">
            <input type="file"  class="custom-file-input" name="offer_image" id="storeOfferImage" aria-describedby="storeOfferImage">
              <label class="custom-file-label" for="storeOfferImage">Choose file</label>
            </div>
          </div>
        </fieldset>
    </div>

    
      
   
  </div>

</div>


<a href="{{ route('store-offer.index') }}"  class="btn btn-info float-left my-2">Back</a>

