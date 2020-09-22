@csrf

                
<div class="row">
    <div class="col-md-12">
        {{-- <h4 class="card-title mb-0">Recipe Sub-Category Form</h4> <br> --}}
    </div>
    
  <div class="col-md-6">
    
    <div class="form-group">
      <label for="categoryOfferCategory">Select category<span class="text-danger"> *</span></label>
      <select class="select2 form-control" id="categoryOfferCategory" name="recipe_category_id"  autocomplete="new-password" data-placeholder="Select Category..." >
        <option value="">Select Category...</option>
          @if (isset($categories) && !empty($categories))
          <?php $value = null; if(isset($recipe_subcategory)){$value = $recipe_subcategory->recipe_category_id;} ?>
              @foreach ($categories as $k => $item)
                  <option value="{{$item->category_id}}" {{$value == $item->category_id ? ' selected' : ''}}>{{$item->category_name}}</option>
              @endforeach
          @endif
      </select>
    </div>

    <div class="form-group">
        <label for="storeOfferTitle">Sub-Category Name<span class="text-danger"> *</span></label>
        <div class="controls">
        <input type="text" name="subcategory_name" id="storeOfferTitle" class="form-control" value="{{ isset($recipe_subcategory->subcategory_name) ? $recipe_subcategory->subcategory_name : '' }}"
            data-validation-required-message="This field is required" placeholder="Offer Title">
        </div>
      </div>
     
        <fieldset class="form-group">
            <label for="storeDescription">Store Description</label>
            <textarea class="form-control" name="subcategory_description" id="storeDescription" rows="3" placeholder="Descripton">{{ isset($recipe_subcategory->subcategory_description) ? $recipe_subcategory->subcategory_description : '' }}</textarea>
        </fieldset>
   
    
  </div>
  <div class="col-md-6">
   
    
    <div style="display: flex; width:100%; justify-content: space-between;">
      <div class="form-group">
        <label for="storeOfferActive" class="mt-2 mr-2">Active <br>( show Offer Status )</label>
        <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
            <input type="checkbox" class="custom-control-input" name="isactive" <?php if(isset($recipe_subcategory->isactive) && $recipe_subcategory->isactive == 0) { echo '';}else{  echo 'checked';} ?> id="storeOfferActive">
            <label class="custom-control-label" for="storeOfferActive"> 
            </label>
          </div>
      </div>
      @if(isset($recipe_subcategory->subcategory_image))
     
        <img src="{{ asset('imge/rs_745/m37593449/OriginalImage/') }}/{{$recipe_subcategory->subcategory_image}} " width="30%" alt="" srcset="">
      
      @endif
    </div>

    <div class="form-group" style="margin-top: 4px;">
        <fieldset id="recipesubcategoryOfferError">
            <label for="storeOfferImage">Upload Offer Image<span class="text-danger"> *</span> </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="recipeSubCat">Offer Image</span>
            </div>
            <div class="custom-file">
            <input type="file"  class="custom-file-input" onchange="imageValidate('#recipesubcategoryImageUpload', '#recipesubcategoryOfferError')" name="subcategory_image" id="recipesubcategoryImageUpload" aria-describedby="recipeSubCat">
              <label class="custom-file-label" for="recipeSubCat">Choose file</label>
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


<a href="{{ route('recipe-sub-category.index') }}"  class="btn btn-info float-left my-2">Back</a>

