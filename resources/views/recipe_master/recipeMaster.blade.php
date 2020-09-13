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
                        <div class="col-sm-8">  
                            {{-- <h4 class="card-title">List</h4> --}}
                            <a href="{{ route('excel.index', 'RecipeMasterExport') }}">
                                <button class="btn btn-success float-left" class="btn btn-primary" >
                                 &nbsp;&nbsp;Excel &nbsp;&nbsp;
                                <i class="bx bxs-download" style="vertical-align: initial;"></i>
                             </button>
                            </a>
                            </div> 
                            <div class="col-sm-4">
                            <a href="{{ route('recipe-master.create') }}" class="btn btn-primary float-right" class="btn btn-primary">Create Recipe</a>
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
                                        <th>Category</th>
                                        <th>Sub-Category</th>
                                        <th>Product Name</th>
                                        <th>Recipe Name</th>
                                        <th>Recipe Image</th>
                                        <th>Recipe Type</th>
                                        <th>No. of Steps</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($recipes) && !empty($recipes))
                                            @foreach ($recipes as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->category()->pluck('category_name')->first() }}</td>
                                                <td>{{ $item->sub_category()->pluck('subcategory_name')->first() }}</td>
                                                <td>{{ $item->recipe_ingredient()->value('product_name') }}</td>
                                                <td>{{ $item->recipe_name }}</td>
                                                {{-- <td>{{ $item->recipe_image()->pluck('recipe_original_image_name') }}</td> --}}
                                                <td><img src="{{ asset('imge/p_756/r_896527/OriginalImage/') }}/{{ $item->recipe_image()->pluck('recipe_original_image_name')->first() }} " width="100%" alt="" srcset=""></td>
                                                <td>{{ $item->recipe_type == 1 ? 'Veg' : 'Non-Veg' }}</td>
                                                <td>{{ $item->recipe_steps()->count() }}</td>
                                             <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} value="{{$item->recipe_id}}"  onchange="change_status(this.value, 'recipe_master', '#recipeMasterStatusChange{{$item->recipe_id}}', 'recipe_id', 'isactive');" id="recipeMasterStatusChange{{$item->recipe_id}}">
                                                        <label class="custom-control-label" for="recipeMasterStatusChange{{$item->recipe_id}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <form action="{{ route('recipe-master.edit', $item->recipe_id) }}" method="get">
                                                        <button class="btn-outline-info mr-1"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                    </form>
                                                   
                                                       
                                                <form action="{{ route('recipe-master.destroy', $item->recipe_id) }}" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this Recipe ?')" style="display: inline">
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