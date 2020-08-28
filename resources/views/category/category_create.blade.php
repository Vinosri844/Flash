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
          <h4 class="card-title">Edit</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
          <form method="post" name="category_form" id="category_form" action="{{ route('category_submit') }}" enctype= multipart/form-data>
        {{ csrf_field() }}
              <div class="form-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="category_name" class="form-control" placeholder="Category Name"
                        name="category_name" >
                      <label for="first-name-floating">Category Name</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="t_category_name" class="form-control" name="t_category_name"
                        placeholder="Category Info(tamil)">
                      <label for="email-id-floating">Category Info(tamil)</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="category_description" class="form-control" name="category_description"
                        placeholder="Description" >
                      <label for="contact-info-floating">Description</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="file" id="category_image" class="form-control" name="category_image"
                        placeholder="Password">
                      <label for="password-floating"></label>
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
