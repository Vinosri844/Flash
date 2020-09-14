@csrf

                
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title mb-0">Recipe Create Form</h4> <br>
    </div>
    
  <div class="col-md-6">
    <div class="form-group">
      <label for="recipeMasterName">Recipe Name</label>
      <div class="controls">
      <input type="text" name="recipe_name" id="recipeMasterName" class="form-control" value="{{ isset($recipe_master->recipe_name) ? $recipe_master->recipe_name : '' }}"
          data-validation-required-message="This field is required" placeholder="Recipe Name">
      </div>
    </div>
    <div class="form-group">
        <label for="recipeMasterCat">Select category</label>
        <select class="select2 form-control" id="category_id" onchange="cat_by_subcategory(this.value)" name="recipe_category_id"  autocomplete="new-password" data-placeholder="Select Category..." >
          <option value="">Select Category...</option>
            @if (isset($categories) && !empty($categories))
            <?php $value = null; if(isset($recipe_master)){$value = $recipe_master->recipe_category_id ;} ?>
                @foreach ($categories as $k => $item)
                    <option value="{{$item->category_id}}" {{$value == $item->category_id ? ' selected' : ''}}>{{$item->category_name}}</option>
                @endforeach
            @endif
        </select>
      </div>
    <div class="form-group">
        <label for="recipeMasterSubCat">Select Sub-Category</label>
        <select class="select2_picker form-control" id="subcat_id" name="recipe_subcategory_id"  autocomplete="new-password" data-placeholder="Select Category..." >
          <option value="">Select Sub-Category...</option>
          @if(isset($sub_categories))
              @foreach($sub_categories as $k => $val)
              <?php $value = $recipe_master->recipe_subcategory_id == $val->subcategory_id ? 'selected' : ''; ?>
                  <option value="{{ $val->subcategory_id }}" {{$value}}>{{ ucfirst($val->subcategory_name) }}</option>
              @endforeach
          @endif
        </select>
        <div class="clearfix"></div>
      </div>
      <div style="display: flex; width:100%; justify-content: space-between;">
        <div class="form-group" style="width: 35%;">
            <label for="recipeType">Recipe Type</label>
            <fieldset>            
                <select class="form-control" name="recipe_type" id="recipeType">
                    <?php  $types = ['Veg', 'Non-Veg']; $value = null; if(isset($recipe_master)){$value = $recipe_master->recipe_type == 1 ? 'Veg' : 'Non-Veg' ;} ?>
                    @foreach ($types as $k => $item)
                        <option value="{{$k + 1}}" {{ $value === $item ? ' selected' : ''}}>{{ $item }}</option>
                    @endforeach              
                </select>
            </fieldset>
        </div>
        <div class="form-group">
          <label for="recipeMasterActive" class="mt-2 mr-2">Active <br>( show Offer Status )</label>
          <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
              <input type="checkbox" class="custom-control-input" name="isactive" <?php if(isset($recipe_master->isactive) && $recipe_master->isactive == 0) { echo '';}else{  echo 'checked';} ?> id="recipeMasterActive">
              <label class="custom-control-label" for="recipeMasterActive"> 
              </label>
            </div>
        </div>
       
        
      </div>
      <div class="form-group">
        <fieldset>
            <label for="recipeMasterImage">Upload Offer Image </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="recipeMasterImage">Offer Image</span>
            </div>
            <div class="custom-file">
            <input type="file"  class="custom-file-input" value="" name="recipe_original_image_name" id="recipeMasterImage" aria-describedby="recipeMasterImage">
              <label class="custom-file-label" for="recipeMasterImage">Choose file</label>
            </div>
          </div>
        </fieldset>
    </div>
    
  </div>
  <div class="col-md-6">
   <div style="display: flex;">

    <div class="form-group mr-1">
        <fieldset>
            <label for="recipeServingCount">Serving Count</label>
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="recipeServingCount">Count</span>
              </div>
            <input type="number" class="form-control" data-validation-required-message="This field is required"  value="{{ isset($recipe_master->serving_count) ? $recipe_master->serving_count : '' }}" name="serving_count" id="recipeServingCount" placeholder="Serving Count" aria-describedby="recipeServingCount">
          </div>
        </fieldset>
    </div>
    <div class="form-group">
        <fieldset>
            <label for="recipeMasterIngre">Total Ingredients</label>
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="recipeMasterIngre">count</span>
              </div>
            <input type="number" class="form-control" data-validation-required-message="This field is required"  value="{{ isset($recipe_master->tot_ingredients) ? $recipe_master->tot_ingredients : '' }}" name="tot_ingredients" id="recipeMasterIngre" placeholder="Ingredients" aria-describedby="recipeMasterIngre">
          </div>
        </fieldset>
    </div>
    </div>
    <div style="display: flex;">
    <div class="form-group mr-1">
        <fieldset>
            <label for="recipePreTime">Preparing Time</label>
          <div class="input-group">
            
            <input type="number" class="form-control" data-validation-required-message="This field is required"  value="{{ isset($recipe_master->prepare_time) ? $recipe_master->prepare_time : '' }}" name="prepare_time" id="recipePreTime" placeholder="Time" aria-describedby="recipePreTime">
            <div class="input-group-append">
                <span class="input-group-text" id="recipePreTime">Minutes</span>
              </div>
        </div>
        </fieldset>
    </div>
    <div class="form-group">
        <fieldset>
            <label for="recipeCookTime">Cooking Time</label>
          <div class="input-group">
            
            <input type="number" class="form-control" data-validation-required-message="This field is required"  value="{{ isset($recipe_master->cooking_time) ? $recipe_master->cooking_time : '' }}" name="cooking_time" id="recipeCookTime" placeholder="Time" aria-describedby="recipeCookTime">
            <div class="input-group-append">
                <span class="input-group-text" id="recipeCookTime">Minutes</span>
              </div>
        </div>
        </fieldset>
    </div>
    </div>
    <div class="form-group">
        <fieldset>
            <label for="recipeShortAddress">Short Description</label>
            <textarea class="form-control" id="recipeShortAddress" name="short_description" rows="3" placeholder="Description">{{ isset($recipe_master->short_description) ? $recipe_master->short_description : '' }}</textarea>
        </fieldset>
    </div>
    <div class="form-group">
        @if(isset($recipe_image->recipe_original_image_name))
       
          <img src="{{ asset('imge/p_756/r_896527/OriginalImage/') }}/{{$recipe_image->recipe_original_image_name}} " width="30%" alt="" srcset="">
        
        @endif
    </div>
    

  </div>

</div>

<div class="row">
    <div class="col-md-6">
            <h4 class="card-title mt-3">Add Recipe Ingredients</h4>
        
            <div class="form-group">
                <label for="recipeMasterProd">Select Product Name</label>
                <select class="select2 form-control" id="recipeMasterProd" name="product_id"  autocomplete="new-password" data-placeholder="Select Product Name..." >
                  <option value="">Select Product Name...</option>
                    @if (isset($products) && !empty($products))
                    <?php $value = null; if(isset($recipe_ingredient)){$value = $recipe_ingredient->product_id ;} ?>
                        @foreach ($products as $k => $item)
                            <option value="{{$item->product_id}}" {{$value == $item->product_id ? ' selected' : ''}}>{{$item->product_name}}</option>
                        @endforeach
                    @endif
                </select>
              </div>
            <div class="form-group">
                <fieldset>
                    <label for="recipeDescr">Short Description</label>
                    <textarea class="form-control" id="recipeDescr" name="description" rows="6" placeholder="Description">{{ isset($recipe_ingredient->description) ? $recipe_ingredient->description : '' }}</textarea>
                </fieldset>
            </div>
        
    </div>
    <div class="col-md-6">
        <section id="form-control-repeater" class="mt-2">
              <!-- phone repeater -->
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Add Cooking Steps</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <div class="contact-repeater">
                        <div data-repeater-list="contact">
                          <div class="row">
                            <div class="col-12 mb-2">
                              <button class="btn btn-icon rounded-circle btn-primary" id="addNewStep" type="button" data-repeater-create>
                                <i class="bx bx-plus" style="vertical-align: 0;"></i>
                              </button>
                              <span class="ml-1 font-weight-bold text-primary">ADD NEW STEP</span>
                            </div>
                            {{-- <div class="col-md-4 col-4 mb-50">
                              <label class="text-nowrap">Step</label>
                            </div> --}}
                            {{-- <div class="col-md-4 col-4 mb-50">
                              <label  class="text-nowrap">Description</label>
                            </div> --}}
                          </div>
                          @if (isset($recipe_steps))
                            @foreach ($recipe_steps as $k => $item)
                                <div class="row justify-content-between" data-repeater-item>
                                    <div class="col-md-1 col-12 form-group d-flex align-items-center">
                                  <i class="bx bx-menu mr-1"></i>
                                    <input type="hidden" class="form-control" value="{{ $item->step_no }}" name="step_no" placeholder="No">
                                    </div>
                                    <div class="col-md-8 col-12 form-group">
                                    <input type="text" class="form-control" value="{{ $item->steps }}" name="steps" placeholder="Description">
                                    </div>
                                    <div class="col-md-2 col-12 form-group">
                                      <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete>
                                          <i class="bx bx-x" style="vertical-align: 0;"></i>
                                      </button>
                                      </div>
                                </div>
                            @endforeach
                          @else
                            <div class="row justify-content-between" data-repeater-item>
                                <div class="col-md-1 col-12 form-group d-flex align-items-center">
                                  <i class="bx bx-menu mr-1"></i>
                                </div>
                                <div class="col-md-8 col-12 form-group">
                                <input type="text" class="form-control" name="steps" placeholder="Description">
                                </div>
                                <div class="col-md-3 col-12 form-group">
                                <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete>
                                    <i class="bx bx-x" style="vertical-align: 0;"></i>
                                </button>
                                </div>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
             
              <!-- /phone repeater -->
           
        </section>
    </div>
    
    
</div>



  
<a href="{{ route('recipe-master.index') }}"  class="btn btn-info float-left my-2">Back</a>

@push('scripts')

<script>
  $('#addNewStep').on('click', ()=>{
    
    $('#stepNumber').value = 3;
  })
</script>
    
@endpush

