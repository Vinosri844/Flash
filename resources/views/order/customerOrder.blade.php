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
                        <div class="col-sm-8">  <h4 class="card-title">{{$customer->customer_name}} Orders List</h4>
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
                                        <th>Order id</th>
                                        <th>Payment Type</th>
                                        <th>Payable Amount</th>
                                        <th>No. of Products</th>
                                        <th>Promocode</th>
                                        <th>Before Promocode Amt</th>
                                        <th>After Promocode Amt</th>
                                        <th>Delivery Charge</th>
                                        <th>Order Date</th>
                                        <th>Final Paid Amount</th>
                                        <th>Extra Amount</th>
                                        <th>Order Number</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($orders) && !empty($orders))
                                            @foreach ($orders as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->order_id }}</td>
                                                <td>{{ $item->payment_type_method }}</td>
                                                <td>{{ $item->payable_amount }}</td>
                                                <td>{{ $item->no_of_product }}</td>
                                                <td>{{ $item->promocode }}</td>
                                                <td>{{ $item->before_promocode_amount }}</td>
                                                <td>{{ $item->after_promocode_amount }}</td>
                                                <td>{{ $item->delivery_charge }}</td>
                                                <td>{{ $item->order_date_time }}</td>
                                                <td>{{ $item->final_paid_amount }}</td>
                                                <td>{{ $item->extra_amount }}</td>
                                                <td>{{ $item->order_number }}</td>
                                                
                                                
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