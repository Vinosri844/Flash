@extends('layouts')

@section('content')
<!-- Scroll - horizontal and vertical table -->
<h5><b>Category</b></h5> <br />

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
          <form method="post" name="category_form" id="category_form" action="{{ route('category_submit') }}" enctype= multipart/form-data>
        {{ csrf_field() }}
              <div class="form-body">
                <div class="row">
                <div class="col-6">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">Category name</label>
                  <input type="text" class="form-control" id="category_name" name="category_name"
                      placeholder="Category Name">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">Category Info(tamil)</label>
                  <input type="text" id="t_category_name" class="form-control" name="t_category_name"
                        placeholder="Category Info(tamil)">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">Description</label>
                  <input type="text" id="category_description" class="form-control" name="category_description"
                        placeholder="Description" >
                </div>
                </div>
                  <div class="col-6">
                  <div class="form-group" style="display: flex">
                    <label for="eventStatus" class="mr-2">Category Status</label>
                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="cat_status" checked id="catStatus">
                        <label class="custom-control-label" for="catStatus"> 
                        </label>
                      </div>
                      </div>
                </div>
                <div class="col-6">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="exampleInputEmail1">Image</label>
                      <input type="file" id="category_image" class="form-control" name="category_image"
                        placeholder="Password">
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
