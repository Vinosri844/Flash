@extends('layouts')

@section('content')
    

    <!-- Scroll - horizontal and vertical table -->
<h5><b>Sub category</b></h5> <br />
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="card-text">  
                        <div class="row">
                        <div class="col-sm-9">  
                            <button class="btn btn-success float-left" class="btn btn-primary" data-toggle="modal" data-target="#excelUploadSubCat">
                                &nbsp;&nbsp;Excel &nbsp;&nbsp;
                               <i class="bx bxs-download" style="vertical-align: initial; transform: rotate(180deg);"></i>
                            </button>
                            </div> 
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventMasterCreate" class="btn btn-primary"><a style="color: #fff" href="{{route('subcategory_create')}}">Create subcategory</a></button>
                            </div>
                            
                        </div></p>   
                </div><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table class="table zero-configuration " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>S.No</th>
                                        <th>Image</th>
                                        <th>Category name</th>
                                        <th>Sub category name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th style="white-space: nowrap;">Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($masters) && !empty($masters))
                                            @foreach ($masters as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <?php $img = !empty($item->subcategory_image) ? asset(config('constants.subcategory_img_path1').$item->subcategory_image) : "http://placehold.it/50x50"; ?>
                                                <td><img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50"></td>     
                                                <td>{{ isset($item->category['category_name']) ? $item->category['category_name'] : ''}}</td>
                                                <td>{{ $item->subcategory_name }}</td>
                                                <td style=" max-width: 100px; cursor: pointer;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                white-space: nowrap;" data-toggle="tooltip" data-placement="top" title="{{$item->subcategory_description}}">{{ $item->subcategory_description }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} value="{{$item->subcategory_id}}" onchange="change_status(this.value, 'subcategory_master', '#customSwitchGlow{{$k}}', 'subcategory_id', 'isactive');" id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>{{ strtotime($item->created_date_time) > 0 ? date(config('constants.app_date_format'), strtotime($item->created_date_time)) : 'N/A' }}</td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $item->subcategory_id }}, {{ $item->subcategory_name }}, {{ $item->isactive }}"  data-toggle="modal" data-target="#eventMasterEdit"><a href="{{ route('subcategory_edit', $item->subcategory_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        {{-- <button class="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                      
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$item->subcategory_name}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('subcategory_destroy',['id'=>$item->subcategory_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
                                                        </button>
                                                       
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
<!-- Modal -->
<div class="modal fade" id="excelUploadSubCat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="excelUploadCatLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="excelUploadSubCatLabel">Sub Category Excel Upload</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form action="{{ route('excel_import.index', 'SubCategoryImport') }}" method="post" enctype="multipart/form-data">
      {{method_field('POST')}}
        @csrf
        <div class="modal-body">
            <fieldset id="categoryOfferError">
                <label for="catExcelUpload">Upload Excel<span class="text-danger"> *</span> </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="catExcelUpload">Excel</span>
                </div>
                <div class="custom-file">
                <input type="file"  class="custom-file-input" name="sub_category" id="categoryExcelUpload" aria-describedby="catExcelUpload">
                  <label class="custom-file-label" for="catExcelUpload">Choose file</label>
                </div>
              </div>
            </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  

@endsection