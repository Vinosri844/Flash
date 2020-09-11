@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Product Detail Edit</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Detail Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="productdetails_form" id="productdetails_form" action="{{ route('productDetail_edit_submit',$productdetail->product_details_id) }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label for="first-name-floating">Product Name</label>
                                                <select name="product_id" id="product_id" class="form-control select2_picker">
                                                    <option value="">Select product</option>
                                                    @if(isset($products) && !empty($products))
                                                        @foreach($products as $product)
                                                            <?php $sel =  $productdetail->product_id == $product->product_id ? 'selected' : ''; ?>
                                                            <option value="{{ $product->product_id }}" {{  $sel }}>{{ ucfirst($product->product_name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">Seller</label>
                                                <select name="seller_id" id="seller_id" class="form-control select2_picker">
                                                    <option value="">Select Seller</option>
                                                    @if(isset($seller) && !empty($seller))
                                                        @foreach($seller as $k => $val)
                                                            <?php $sel = $productdetail->seller_id == $val->seller_id ? 'selected' : ''; ?>
                                                            <option value="{{ $val->seller_id }}" {{ $sel }}>{{ ucfirst($val->seller_name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="discount" class="form-control" placeholder="Discount"
                                                       name="discount" value="{{$productdetail->product_details_discount}}" >
                                                <label for="first-name-floating">Discount</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="product_short_description" class="form-control" name="product_short_description"
                                                       placeholder="Description" value="{{$productdetail->product_details_description}}">
                                                <label for="contact-info-floating">Description</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Other Product Info</h4>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group" style="display: flex">
                                                <label for="eventStatus" class="mr-2">Active</label>
                                                <?php $check = $productdetail->isactive == 1 ? 'checked' : ''; ?>
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
                                                <?php $check = $productdetail->isjain == 1 ? 'checked' : ''; ?>
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
                                                <?php $check = $productdetail->isservice == 1 ? 'checked' : ''; ?>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="isActive_service"  id="isActive_service" {{$check}}>
                                                    <label class="custom-control-label" for="isActive_service">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-label-group">
                                                <input type="text" id="productdetail_title" class="form-control" placeholder="Product Title"
                                                       name="productdetail_title" value="{{ $productdetail->product_details_title}}">
                                                <label for="first-name-floating">Product Detail Title</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                            <textarea type="text" id="ingredients" class="form-control" placeholder="Ingredients"
                                                      name="ingredients" cols="30" rows="4" >{{$productdetail->product_details_ingredients}}</textarea>
                                                <label for="first-name-floating">Ingredients</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-label-group">
                                            <textarea type="text" id="remarks" class="form-control" placeholder="Remarks"
                                                      name="remarks" cols="30" rows="4" >{{$productdetail->product_details_remarks}}</textarea>
                                                <label for="remarks">Remarks</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="col-12 d-flex justify-content-end">
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
