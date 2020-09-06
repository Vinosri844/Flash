@extends('layouts')

@section('content')
    
{{-- {{dd($address)}} --}}
<!-- Scroll - horizontal and vertical table -->
{{-- <h5><b>Customer</b></h5> <br /> --}}
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="card-text">  
                        <div class="row">
                        <div class="col-sm-8">  <h4 class="card-title">{{$customer->customer_name}} Address List</h4>
                            </div> 
                            <div class="col-sm-4">
                                <a href="{{ route('customer.index') }}" class="btn btn-primary float-right" class="btn btn-primary">Customer List</a>
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
                                        <th>Customer name</th>
                                        <th>Address 1</th>
                                        <th>Address 2</th>
                                        <th>Contact no</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Pincode</th>
                                        <th>Landmark</th>
                                        <th>Status</th>
                
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($address) && !empty($address))
                                            @foreach ($address as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->customer_name }}</td>
                                                <td>{{ $item->address_1 }}</td>
                                                <td>{{ $item->address_2 }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->city }}</td>
                                                <td>{{ $item->state }}</td>
                                                <td>{{ $item->pincode }}</td>
                                                <td>{{ $item->near_by_landmark }}</td>
                                                
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
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