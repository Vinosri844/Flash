@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Product Edit</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="products_form" id="products_form" action="{{ route('product_edit_submit',$product->product_id) }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Product Name<span class="text-danger"> *</span></label>
                                                <input type="text" id="product_name" class="form-control" placeholder="Product Name"
                                                       name="product_name" value="{{$product->product_name}}" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Category<span class="text-danger"> *</span></label>
                                                <select name="category_id" id="category_id" class="form-control select2_picker" onchange="cat_by_subcategory(this.value)" required>
                                                    <option value="">Select Category</option>
                                                    @if(isset($category) && !empty($category))
                                                        @foreach($category as $k => $val)
                                                            <?php $sel = $subcat->category_id == $val->category_id ? 'selected' : ''; ?>
                                                            <option value="{{ $val->category_id }}" {{ $sel }}>{{ ucfirst($val->category_name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Sub-Category<span class="text-danger"> *</span></label>
                                                <select name="subcat_id" id="subcat_id" class="form-control select2_picker" required>
                                                    @if(isset($subcats) && !empty($subcats))
                                                        @foreach($subcats as $k => $val)
                                                            <?php $sel = $product->subcategory_id == $val->subcategory_id ? 'selected' : ''; ?>
                                                            <option value="{{ $val->subcategory_id }}" {{ $sel }}>{{ ucfirst($val->subcategory_name) }}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Stores<span class="text-danger"> *</span></label>
                                                <select class="mul-select" name="productstore_id[]" id="productstore_id" style="width: 100%" multiple="true" required>
                                                    @if(isset($seller) && !empty($seller))
                                                        @foreach($seller as $k => $val)
                                                            <?php $sel = in_array($val->seller_id,$selectedsellers) ? 'selected' : ''; ?>
                                                            <option value="{{ $val->seller_id }}" {{ $sel }}>{{ ucfirst($val->seller_name) }}</option>                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-floating">Optional Name</label>

                                                <input type="text" id="optional_name" class="form-control" placeholder="Optional Name"
                                                       name="optional_name" value="{{$product->product_alias_name}}" >
                                                  </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-floating">Description<span class="text-danger"> *</span></label>
                                                <input type="text" id="product_short_description" class="form-control" name="product_short_description"
                                                       placeholder="Description" value="{{$product->product_description}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Other Product Info</h4>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group" style="display: flex">
                                                <label for="eventStatus" class="mr-2">Active</label>
                                                <?php $check = $product->isactive == 1 ? 'checked' : ''; ?>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="product_status"  id="product_status"{{$check}}>
                                                    <label class="custom-control-label" for="product_status">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group" style="display: flex">
                                                <label for="isAcive_jain" class="mr-2">Is Veg?</label>
                                                <?php $check = $productdetails[0]->isjain == 1 ? 'checked' : ''; ?>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="isAcive_jain"  id="isAcive_jain"  {{$check}}>
                                                    <label class="custom-control-label" for="isAcive_jain">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group" style="display: flex">
                                                <label for="isActive_service" class="mr-2">Is Service?</label>
                                                <?php $check = $productdetails[0]->isservice == 1 ? 'checked' : ''; ?>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="isActive_service"  id="isActive_service" {{$check}}>
                                                    <label class="custom-control-label" for="isActive_service">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-label-group">
                                                <input type="text" id="product_title" class="form-control" placeholder="Product Title"
                                                       name="product_title" value="{{ $productdetails[0]->product_details_title}}">
                                                <label for="first-name-floating">Product Title</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                            <textarea type="text" id="ingredients" class="form-control" placeholder="Ingredients"
                                                      name="ingredients" cols="30" rows="4" value="{{$productdetails[0]->product_details_ingredients}}">{{$productdetails[0]->product_details_ingredients}}</textarea>
                                                <label for="first-name-floating">Ingredients</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-label-group">
                                            <textarea type="text" id="remarks" class="form-control" placeholder="Remarks"
                                                      name="remarks" cols="30" rows="4" value="{{$productdetails[0]->product_details_remarks}}">{{$productdetails[0]->product_details_remarks}}</textarea>
                                                <label for="remarks">Remarks</label>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <h4 class="card-title">Product Images</h4>
                                    <div class="row">
                                        <div class="col-4 mb-1">
                                            <?php $img = !empty($product->product_img) ? asset(config('constants.product_img_path').$product->product_img) : "http://placehold.it/50x50"; ?>
                                            <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
                                            <fieldset id="storePanimageElement6">
                                                <label for="storePANImage6">Upload Product Image</label>
                                              <div class="input-group" >
                                                {{-- <div class="input-group-prepend">
                                                  <span class="input-group-text" id="storePANImage">Category Image</span>
                                                </div> --}}
                                                <div class="custom-file">
                                                <input type="file"  class="custom-file-input"  name="product_image"  id="storePANImageUpload6" aria-describedby="storePANImage6">
                                                <label class="custom-file-label" for="storePANImage6">{{$product->product_img}}</label>
                                                </div>
                                              </div>
                                              <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Image should be jpg, jpeg Format
                                              </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <?php $img = !empty($product->top_img) ? asset(config('constants.product_img_path').$product->top_img) : "http://placehold.it/50x50"; ?>
                                                    <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
                                            <fieldset id="storePanimageElement5">
                                                <label for="storePANImage5">Upload Top Image<span class="text-danger"> *</span></label>
                                              <div class="input-group" >
                                                {{-- <div class="input-group-prepend">
                                                  <span class="input-group-text" id="storePANImage">Category Image</span>
                                                </div> --}}
                                                <div class="custom-file">
                                                <input type="file"  class="custom-file-input"  name="top_image"  id="storePANImageUpload5" aria-describedby="storePANImage5">
                                                <label class="custom-file-label" for="storePANImage5">{{$product->top_img}}</label>
                                                </div>
                                              </div>
                                              <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Image should be jpg, jpeg Format
                                              </div>
                                            </fieldset>
                                            
                                        </div>
                                        <div class="col-4 mb-1">
                                            <?php $img = !empty($product->bottom_img) ? asset(config('constants.product_img_path').$product->bottom_img) : "http://placehold.it/50x50"; ?>
                                                    <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
                                            <fieldset id="storePanimageElement4">
                                                <label for="storePANImage4">Upload Bottom Image</label>
                                              <div class="input-group" >
                                                {{-- <div class="input-group-prepend">
                                                  <span class="input-group-text" id="storePANImage">Category Image</span>
                                                </div> --}}
                                                <div class="custom-file">
                                                <input type="file"  class="custom-file-input"  name="bottom_image"  id="storePANImageUpload4" aria-describedby="storePANImage4">
                                                <label class="custom-file-label" for="storePANImage4">{{$product->bottom_img}}</label>
                                                </div>
                                              </div>
                                              <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Image should be jpg, jpeg Format
                                              </div>
                                            </fieldset>
                                            
                                        </div>
                                        <div class="col-4">
                                            <?php $img = !empty($product->left_img) ? asset(config('constants.product_img_path').$product->left_img) : "http://placehold.it/50x50"; ?>
                                                    <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
                                            <fieldset id="storePanimageElement3">
                                                <label for="storePANImage3">Upload Left Image</label>
                                              <div class="input-group" >
                                                {{-- <div class="input-group-prepend">
                                                  <span class="input-group-text" id="storePANImage">Category Image</span>
                                                </div> --}}
                                                <div class="custom-file">
                                                <input type="file"  class="custom-file-input"  name="left_image"  id="storePANImageUpload3" aria-describedby="storePANImage3">
                                                <label class="custom-file-label" for="storePANImage3">{{$product->left_img}}</label>
                                                </div>
                                              </div>
                                              <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Image should be jpg, jpeg Format
                                              </div>
                                            </fieldset>
                                            
                                        </div>
                                        <div class="col-4">
                                            <?php $img = !empty($product->right_img) ? asset(config('constants.product_img_path').$product->right_img) : "http://placehold.it/50x50"; ?>
                                                    <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
                                            <fieldset id="storePanimageElement2">
                                                <label for="storePANImage2">Upload Right Image</label>
                                              <div class="input-group" >
                                                {{-- <div class="input-group-prepend">
                                                  <span class="input-group-text" id="storePANImage">Category Image</span>
                                                </div> --}}
                                                <div class="custom-file">
                                                <input type="file"  class="custom-file-input"  name="right_image"  id="storePANImageUpload2" aria-describedby="storePANImage2">
                                                <label class="custom-file-label" for="storePANImage2">{{$product->right_img}}</label>
                                                </div>
                                              </div>
                                              <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Image should be jpg, jpeg Format
                                              </div>
                                            </fieldset>
                                            
                                        </div>
                                        <div class="col-4">
                                            <?php $img = !empty($productimages->product_original_image_name) ? asset(config('constants.product_img_path').$productimages->product_original_image_name) : "http://placehold.it/50x50"; ?>
                                                    <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
                                            <fieldset id="storePanimageElement1">
                                                <label for="storePANImage1">Upload Other Image</label>
                                              <div class="input-group" >
                                                {{-- <div class="input-group-prepend">
                                                  <span class="input-group-text" id="storePANImage">Category Image</span>
                                                </div> --}}
                                                <div class="custom-file">
                                                <input type="file"  class="custom-file-input"  name="other_image"  id="storePANImageUpload1" aria-describedby="storePANImage1">
                                                <label class="custom-file-label" for="storePANImage1x">{{$productimages->product_original_image_name}}</label>
                                                </div>
                                              </div>
                                              <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Image should be jpg, jpeg Format
                                              </div>
                                            </fieldset>
                                            
                                        </div>

                                    </div>

                                    <div>
                                        <div class="col-12 d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
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
