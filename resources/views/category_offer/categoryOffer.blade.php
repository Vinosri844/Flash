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
                        <div class="col-sm-8">  <h4 class="card-title">List</h4>
                            </div> 
                            <div class="col-sm-4">
                            <a href="{{ route('category-offer.create') }}" class="btn btn-primary float-right" class="btn btn-primary">Create Category Offer</a>
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
                                        <th>Store name</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Minimum Discount</th>
                                        <th>Maximum Discount</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Validity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($category_offers) && !empty($category_offers))
                                            @foreach ($category_offers as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->store()->pluck('seller_name')->first() }}</td>
                                                <td>{{ $item->category()->pluck('category_name')->first() }}</td>
                                                {{-- <td><img src="{{ asset('image/sellerpancard/OriginalImage/') }}/{{$item->seller_pan_number_image}} " width="100%" alt="" srcset=""></td> --}}
                                                
                                                <td><img src="{{ asset('imge/o_227/so22072019/OriginalImage/') }}/{{$item->offer_image}} " width="100%" alt="" srcset=""></td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->subtitle }}</td>
                                                <td>{{ $item->min_discount }}</td>
                                                <td>{{ $item->max_discount }}</td>
                                            <td class="text-center">{{ date('d M, Y', strtotime($item->start_date)) }} <span class="text-primary"> TO</span> <br> {{ date('d M, Y', strtotime($item->end_date)) }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} value="{{$item->category_offer_id}}"  onchange="change_status(this.value, 'category_offers', '#categoryOfferStatusChange{{$item->category_offer_id}}', 'category_offer_id', 'isactive');" id="categoryOfferStatusChange{{$item->category_offer_id}}">
                                                        <label class="custom-control-label" for="categoryOfferStatusChange{{$item->category_offer_id}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <form action="{{ route('category-offer.edit', $item->category_offer_id) }}" method="get">
                                                        @csrf
                                                        <button class="btn-outline-info mr-1"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                    </form>
                                                   
                                                       
                                                <form action="{{ route('category-offer.destroy', $item->category_offer_id) }}" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this Category Offer ?')" style="display: inline">
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