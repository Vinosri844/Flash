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
          <h4 class="card-title">Edit</h4>
        </div> <br />
        <div class="card-content">
          <div class="card-body">
          <form method="post" name="category_form" id="category_form" action="{{ route('subcategory_edit_submit', $category->subcategory_id) }}" enctype= multipart/form-data>
        {{ csrf_field() }}
              <div class="form-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="subcategory_name" class="form-control" placeholder="SubCategory Name"
                        name="subcategory_name" value="{{ $category->subcategory_name }}">
                      <label for="first-name-floating">Category Name</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="t_subcategory_name" class="form-control" name="t_subcategory_name"
                        placeholder="SubCategory Info(tamil)" value="{{ $category->t_subcategory_name }}">
                      <label for="email-id-floating">SubCategory Info(tamil)</label>
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="form-label-group">
                          <label class="form-label">Category</label>
                          <select name="category_id" id="category_id" class="form-control select2_picker">
                              <option value="">Select Category</option>
                              @if(isset($cat) && !empty($cat))
                              @foreach($cat as $k => $val)
                              <?php $sel = $category->category_id == $val->category_id ? 'selected' : ''; ?>
                              <option value="{{ $val->category_id }}" {{ $sel }}>{{ ucfirst($val->category_name) }}</option>
                              @endforeach
                              @endif
                          </select>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="subcategory_description" class="form-control" name="subcategory_description"
                        placeholder="Description" value="{{ $category->subcategory_description }}">
                      <label for="contact-info-floating">Description</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="file" id="subcategory_image" class="form-control" name="subcategory_image"
                        placeholder="Image">
                      <label for="password-floating"></label>
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="form-group" style="display: flex">
                    <label for="catStatus" class="mr-2">SubCategory Status</label>
                    <?php $check = $category->isactive == 1 ? 'checked' : ''; ?>
                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="catStatusEdit" name="sc_status" id="catStatusEdit" value="{{ $category->isactive }}"  {{ $check }}>
                        <label class="custom-control-label" for="catStatusEdit"> 
                        </label>
                      </div>
                      </div>
                </div>
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
