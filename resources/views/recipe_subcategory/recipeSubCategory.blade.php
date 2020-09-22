@extends('layouts')

@section('content')
    

<!-- Scroll - horizontal and vertical table -->
{{-- <h5><b>Store</b></h5> <br /> --}}
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="card-text">  
                        <div class="row">
                        <div class="col-sm-6">  <h4 class="card-title">List</h4>
                            </div> 
                            <div class="col-sm-6">
                            <a href="{{ route('recipe-sub-category.create') }}" class="btn btn-primary float-right" class="btn btn-primary">Add Recipe Sub-Category</a>
                            </div>
                            
                        </div>
                        </p>   
                </div><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table class="table zero-configuration " style="width:100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>S.No</th>
                                        <th>Category name</th>
                                        <th>Sub-Category name</th>
                                        <th>Image</th>                                        
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($recipe_subcategory) && !empty($recipe_subcategory))
                                            @foreach ($recipe_subcategory as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->recipe_category_id }}</td>
                                                <td>{{ $item->subcategory_name }}</td>
                                                {{-- <td><img src="{{ asset('image/sellerpancard/OriginalImage/') }}/{{$item->seller_pan_number_image}} " width="100%" alt="" srcset=""></td> --}}
                                                
                                                <td><img src="{{ asset('imge/rs_745/m37593449/OriginalImage/') }}/{{$item->subcategory_image}} " width="100%" alt="" srcset=""></td>
                                                
                                            
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} value="{{$item->recipe_subcategory_id}}"  onchange="change_status(this.value, 'recipe_subcategory_master', '#subCategoryStatusChange{{$item->recipe_subcategory_id}}', 'recipe_subcategory_id', 'isactive');" id="subCategoryStatusChange{{$item->recipe_subcategory_id}}">
                                                        <label class="custom-control-label" for="subCategoryStatusChange{{$item->recipe_subcategory_id}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td style="white-space: nowrap;">{{ $item->created_date_time }}</td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <form action="{{ route('recipe-sub-category.edit', $item->recipe_subcategory_id) }}" method="get">
                                                        @csrf
                                                        <button class="btn-outline-info mr-1"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                    </form>
                                                   
                                                       
                                                <form action="{{ route('recipe-sub-category.destroy', $item->recipe_subcategory_id) }}" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this Store Offer ?')" style="display: inline">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn-outline-danger">
                                                            <i class="bx bx-trash-alt"></i>
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

<!-- // Basic Floating Label Form section start -->
<!-- Button trigger modal -->


  @push('scripts')

  
  @endpush

@endsection