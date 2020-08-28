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
                        <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div> 
                           <!-- <div class="col-sm-2">
                            <button type="button" class="btn btn-primary btn-sm" >
                            <a href="" onclick="return confirm('Are you sure you want to download the seller selling report?')" style="color: #ffff;" class="tx-white tx-12 d-block mg-t-10">
                            <i class="bx bx-import" aria-hidden="true"></i></a></button>
                            <div class="clearfix"></div>
                        </div> -->
                        <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventMasterCreate" class="btn btn-primary">Create Category</button>
                            </div>
                        </div></p>   
                </div><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table class="table zero-configuration ">
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
                                    <td>
                                    <input data-id="{{$v->category_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $v->isactive ? 'checked' : '' }}>
                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox"  data-id="{{$v->category_id}}" class="custom-control-input" {{$v->isactive == 1 ? 'checked' : ''}} id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                      </div>    
                                                      
                                                      </td>
                                    <td>{{ ($v->created_date_time) ?? 'N/A' }} </td>
                                    <td class="text-right">
                                                    <div  style="display:inline-flex">
                                                    <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $v->category_id }}, {{ $v->category_name }}, {{ $v->isactive }}"  data-toggle="modal" data-target="#eventMasterEdit"><a href="{{ route('category_edit', $v->category_id) }}"</a><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                        {{-- <button class="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                       
                                                        <button class="btn-outline-danger">
                                                        <a href="{{route('category_destroy',['id'=>$v->category_id])}}"</a><i class="bx bx-trash-alt"></i>
                                                        </button>
                                                        
                                                        </form>
                                                    </div>
                                                    
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


<!-- Create Modal -->
<div class="modal fade" id="eventMasterCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="eventMasterCreate" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventMasterCreate">Create Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>
<!-- // Basic Floating Label Form section end -->
@endsection
