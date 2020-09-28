@extends('layouts')

@section('content')
<!-- Scroll - horizontal and vertical table -->
<h5><b>SubCategory</b></h5> <br />

<!-- // Basic Floating Label Form section start -->
<section id="floating-label-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
          <form method="post" name="subcategory_form" id="subcategory_form" action="{{ route('subcategory_submit') }}" enctype= multipart/form-data>
        {{ csrf_field() }}
              <div class="form-body">
                <div class="row">
                  <div class="col-6">
                  <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">SubCategory Name</label>
                      <input type="text" id="subcategory_name" class="form-control" placeholder="SubCategory Name"
                        name="subcategory_name" >
                    </div>
                  </div>
                  
									<div class="col-6">
                  <div class="form-group mb-50">
                          <label class="form-label">Category</label>
                          <select name="category_id" id="category_id" class="form-control select2_picker">
                              <option value="">Select Category</option>
                              @if(isset($cat) && !empty($cat))
                              @foreach($cat as $k => $val)
                              <option value="{{ $val->category_id }}">{{ ucfirst($val->category_name) }}</option>
                              @endforeach
                              @endif
                          </select>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                  <div class="col-6">
                  <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">Description</label>
                      <input type="text" id="subcategory_description" class="form-control" name="subcategory_description"
                        placeholder="Description" >
                    </div>
                  </div>
                <div class="col-6">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">Image</label>
                      <input type="file" id="subcategory_image" class="form-control" name="subcategory_image"
                        placeholder="Image">
                    </div>
                  </div>
                  <div class="col-6 mt-2">
                  <div class="form-group" style="display: flex">
                    <label for="eventStatus" class="mr-2">SubCategory Status</label>
                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="sc_status" checked id="catStatus">
                        <label class="custom-control-label" for="catStatus"> 
                        </label>
                      </div>
                      </div>
                </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Create</button>
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
