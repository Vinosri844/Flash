@extends('layouts')

@section('content')
    

<!-- Scroll - horizontal and vertical table -->
<h5><b>Store</b></h5> <br />
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
                                <button type="button" class="btn btn-primary" class="btn btn-primary">Create Store</button>
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
                                        <th>Store name</th>
                                        <th>Image</th>
                                        <th>Service Tax No</th>
                                        <th>GST No</th>
                                        <th>CST No</th>
                                        <th>FSSAI No</th>
                                        <th>PAN No</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($stores) && !empty($stores))
                                            @foreach ($stores as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->seller_name }}</td>
                                                <td><img src="{{ asset('image/sellercompanylogo/CompressImage/-1459597364.jpg') }} " width="100%" alt="" srcset=""></td>
                                                
                                                <td>{{ $item->seller_company_image }}</td>
                                                <td>{{ $item->seller_gst_tin_number }}</td>
                                                <td>{{ $item->seller_cst_tin_number }}</td>
                                                <td>{{ $item->seller_fssai_number }}</td>
                                                <td>{{ $item->seller_pan_number_image }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <button class="btn-outline-info mr-1" data-value="{{ $item->store_id }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                        {{-- <button class="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <form action="" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this  ?')" style="display: inline">
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