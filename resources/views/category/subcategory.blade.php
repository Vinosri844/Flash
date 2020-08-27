@extends('layouts')

@section('content')
<!-- Scroll - horizontal and vertical table -->
<h5><b>SubCategory</b></h5> <br />
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="card-text">  
                        <div class="row">
                        <div class="col-sm-10">  <h4 class="card-title">List</h4>
                            </div> 
                            <div class="col-sm-2">
                            <button type="button" class="btn btn-primary btn-sm" >
                            <a href="" onclick="return confirm('Are you sure you want to download the seller selling report?')" style="color: #ffff;" class="tx-white tx-12 d-block mg-t-10">
                            <i class="bx bx-import" aria-hidden="true"></i></a></button>
                            <div class="clearfix"></div>
                        </div>
                        </div></p>   
                </div><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table class="table nowrap scroll-horizontal-vertical">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>S.No</th>
                                        <th>Image</th>
                                        <th>Category name</th>
                                        <th>Sub category name</th>
                                        <th>Sub category details</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Scroll - horizontal and vertical table -->

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
          <form class="form">
              <div class="form-body">
                <div class="row">
                <div class="col-6">
                    <div class="form-label-group">
                        <select name="Category" id="Category" class="select2_picker form-control">
                            <option value="">Select Category</option>
                        </select>
                      <label for="first-name-floating">Category Name</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="first-name-floating" class="form-control" placeholder="Category Name"
                        name="fname-floating">
                      <label for="first-name-floating">SubCategory Name</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="email-id-floating" class="form-control" name="email-id-floating"
                        placeholder="Category Info(tamil)">
                      <label for="email-id-floating">SubCategory Info(tamil)</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="contact-info-floating" class="form-control" name="contact-floating"
                        placeholder="Description">
                      <label for="contact-info-floating">Description</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="file" id="password-floating" class="form-control" name="contact-floating"
                        placeholder="Password">
                      <label for="password-floating"></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
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
