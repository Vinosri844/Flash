@csrf

                
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title mb-0">Offer Info</h4> <br>
    </div>
    
  <div class="col-md-6">
    <div class="form-group">
      <label for="storeOfferTitle">Title<span class="text-danger"> *</span></label>
      <div class="controls">
      <input type="text" name="title" id="storeOfferTitle" class="form-control" value="{{ isset($category_offer->title) ? $category_offer->title : '' }}"
          data-validation-required-message="This field is required" placeholder="Offer Title">
      </div>
    </div>
    <div class="form-group">
      <label for="storeOfferSubTitle">Sub Title<span class="text-danger"> *</span></label>
      <div class="controls">
      <input type="text" name="subtitle" id="storeOfferSubTitle" class="form-control" value="{{ isset($category_offer->subtitle) ? $category_offer->subtitle : '' }}"
          data-validation-required-message="This field is required" placeholder="Offer Sub-Title">
      </div>
    </div>

    
     
            
      <div class="form-group">
        <label for="categoryOfferStore">Select Store<span class="text-danger"> *</span></label>
        <select class="select2 form-control"  id="categoryOfferStore" name="seller_id"  autocomplete="new-password" data-placeholder="Select Store..." >
          <option value="">Select Store...</option>
            @if (isset($stores) && !empty($stores))
            <?php $value = null; if(isset($category_offer)){$value = $category_offer->seller_id;} ?>
                @foreach ($stores as $k => $item)
                
                    <option value="{{$item->seller_id}}" {{$value == $item->seller_id ? ' selected' : ''}}>{{$item->seller_name}}</option>
                @endforeach
            @endif
        </select>
      </div>
   
    <div class="form-group">
      <label for="categoryOfferCategory">Select category<span class="text-danger"> *</span></label>
      <select class="select2 form-control" id="categoryOfferCategory" name="category_id"  autocomplete="new-password" data-placeholder="Select Category..." >
        <option value="">Select Category...</option>
          @if (isset($categories) && !empty($categories))
          <?php $value = null; if(isset($category_offer)){$value = $category_offer->category_id ;} ?>
              @foreach ($categories as $k => $item)
                  <option value="{{$item->category_id}}" {{$value == $item->category_id ? ' selected' : ''}}>{{$item->category_name}}</option>
              @endforeach
          @endif
      </select>
    </div>
    
    
    
      {{-- <optgroup label="Figures">
        <option value="romboid">Romboid</option>
      </optgroup> --}}

      <div style="display: flex;">
        <fieldset class="form-group mr-1">
          <label for="storeOfferMinDiscount">Min Discount<span class="text-danger"> *</span></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="storeOfferMinDiscount">Value</span>
              </div>
          <input type="number" value="{{ isset($category_offer->min_discount) ? $category_offer->min_discount : '' }}" class="form-control" name="min_discount" placeholder="Min Discount" aria-describedby="storeOfferMinDiscount">
          
        </div>
      </fieldset>
      <fieldset class="form-group">
          <label for="storeOfferMaxDiscount">Max Discount<span class="text-danger"> *</span></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="storeOfferMaxDiscount">Value</span>
              </div>
          <input type="number" value="{{ isset($category_offer->max_discount) ? $category_offer->max_discount : '' }}" class="form-control" placeholder="Max Discount" name="max_discount" aria-describedby="storeOfferMaxDiscount">
         
        </div>
      </fieldset>
      </div>

    
  </div>
  <div class="col-md-6">
   
      <div class="form-group">
        <label for="storeOfferStartDate">Start Date<span class="text-danger"> *</span></label>
        <fieldset class="form-group position-relative has-icon-left">
            <input type="text" class="form-control pickadate-months-year" value="{{  isset($category_offer->start_date) ? date('d M, Y', strtotime($category_offer->start_date)) : null  }}" id="storeOfferStartDate" name="start_date" placeholder="Start Date">
            <div class="form-control-position">
              <i class='bx bx-calendar'></i>
            </div>
          </fieldset>
    </div>
      <div class="form-group">
        <label for="storeOfferEndDate">End Date<span class="text-danger"> *</span></label>
        <fieldset class="form-group position-relative has-icon-left">
            <input type="text" class="form-control pickadate-months-year" value="{{  isset($category_offer->end_date) ? date('d M, Y', strtotime($category_offer->end_date)) : null  }}" id="storeOfferEndDate" name="end_date" placeholder="End Date">
            <div class="form-control-position">
              <i class='bx bx-calendar'></i>
            </div>
          </fieldset>
    </div>
    
    <div style="display: flex; width:100%; justify-content: space-between;">
      <div class="form-group">
        <label for="storeOfferActive" class="mt-2 mr-2">Active <br>( show Offer Status )</label>
        <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
            <input type="checkbox" class="custom-control-input" name="isactive" <?php if(isset($category_offer->isactive) && $category_offer->isactive == 0) { echo '';}else{  echo 'checked';} ?> id="storeOfferActive">
            <label class="custom-control-label" for="storeOfferActive"> 
            </label>
          </div>
      </div>
      @if(!empty($category_offer->offer_image))
     
        <img src="{{ asset('imge/o_227/so22072019/OriginalImage/') }}/{{$category_offer->offer_image}} " width="30%" alt="" srcset="">
       
      @endif
    </div>

    <div class="form-group" style="margin-top: 4px;">
        <fieldset id="categoryOfferError">
            <label for="storeOfferImage">Upload Offer Image<span class="text-danger"> *</span> </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="storeOfferImage">Offer Image</span>
            </div>
            <div class="custom-file">
            <input type="file"  class="custom-file-input" onchange="imageValidate('#categoryOfferImageUpload', '#categoryOfferError')" name="offer_image" id="categoryOfferImageUpload" aria-describedby="storeOfferImage">
              <label class="custom-file-label" for="storeOfferImage">{{isset($category_offer->offer_image) ? $category_offer->offer_image : null}}</label>
            </div>
          </div>
          <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            Image should be jpg, jpeg Format
          </div>
        </fieldset>
    </div>

  </div>

</div>


<a href="{{ route('category-offer.index') }}"  class="btn btn-info float-left my-2">Back</a>

