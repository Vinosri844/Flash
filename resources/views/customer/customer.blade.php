@extends('layouts')

@section('content')
    

<!-- Scroll - horizontal and vertical table -->
{{-- <h5><b>Customer</b></h5> <br /> --}}
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="card-text">  
                        <div class="row">
                        <div class="col-sm-8">  <h4 class="card-title">Customer List</h4>
                            </div> 
                            <div class="col-sm-4">
                            {{-- <a href="" class="btn btn-primary" class="btn btn-primary">Create Customer</a> --}}
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
                                        <th>Contact no</th>
                                        <th>Email id</th>
                                        <th>Type</th>
                                        <th>OS Name</th>
                                        <th>Registration Date</th>
                                        <th>Last_Login_Date</th>
                                        <th>Status</th>
                                        <th>Verified</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($customers) && !empty($customers))
                                            @foreach ($customers as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->customer_name }}</td>
                                                <td>{{ $item->customer_contact_no }}</td>
                                                <td>{{ $item->customer_contact_emailid }}</td>
                                                <td>{{ $item->customer_contact_logintype }}</td>
                                                <td>{{ $item->customer_contact_device_os }}</td>
                                                <td>{{ $item->create_date_time }}</td>
                                                <td>{{ $item->last_login_date_time }}</td>
                                                
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}} id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isverified == 1 ? 'checked' : ''}} id="customVerified{{$k}}">
                                                        <label class="custom-control-label" for="customVerified{{$k}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        
                                                        <a href="{{ route('customer.edit',  $item->customer_id) }}"> <button class="btn-outline-info mr-1" data-toggle="tooltip" data-placement="top" title data-original-title="View Customer"><i class="bx bx-show-alt" data-icon="warning-alt"></i></button></a>
                                                       <a href=""> <button class="btn-outline-primary mr-1" data-toggle="tooltip" data-placement="top" title data-original-title="View Address"><i class="bx bx-home-circle" data-icon="warning-alt"></i></button></a>
                                                       <a href=""> <button class="btn-outline-warning mr-1" data-toggle="tooltip" data-placement="top" title data-original-title="View Order List"><i class="bx bxs-shopping-bag" data-icon="warning-alt"></i></button></a>
                                                                               
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