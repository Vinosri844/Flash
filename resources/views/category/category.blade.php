@extends('layouts')

@section('content')
<!-- Scroll - horizontal and vertical table -->
<h5><b>Category</b></h5> <br />
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
                                        <th>Category details</th>
                                        <th>Status</th>
                                        <th>Created date/time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($category) && !empty($category))
                                @foreach($category as $k=>$v) 
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id=""></td>
                                    <td>{{ $k + 1 }}</td>
                                    <td> </td>
                                    <td>{{ ($v->category_name) ?? 'N/A' }}</td>
                                    <td>{{ ($v->category_description) ?? 'N/A' }} </td>
                                    <td> <input data-id="{{$v->category_id}}" class="toggle-class" type="checkbox" data-onstyle="success" 
                                    data-offstyle="danger" data-toggle="toggle" data-on="Solved" 
                                    data-off="Active" {{ $v->isactive ? 'checked' : '' }}></td>
                                    <td>{{ ($v->created_date_time) ?? 'N/A' }} </td>
                                    <td class="text-right">
                                        <a href="{{ route('category_edit', $v->category_id) }}" class="btn btn-link btn-success edit"><i class="bx bxs-pencil"></i></a>
                                        <a href="{{route('category_destroy',['id'=>$v->category_id])}}" class="btn btn-link btn-danger delete"><i class="bx bxs-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
            <form method="post" name="category_form" id="category_form" action="{{ route('category_submit') }}" enctype= multipart/form-data>
            {{ csrf_field() }}
              <div class="form-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="text" id="category_name" class="form-control" placeholder="Category Name"
                        name="category_name">
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
                        placeholder="Description">
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
