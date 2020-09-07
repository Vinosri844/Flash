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
                            <a href="{{ route('membership.create') }}" class="btn btn-primary float-right" class="btn btn-primary">Add Membership</a>
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
                                        <th>Initial Amount</th>
                                        <th>Current Amount</th>
                                        <th>Validity</th>
                                        <th>Minimum Order Amount</th>
                                        <th>Cashback Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($members) && !empty($members))
                                            @foreach ($members as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $item->initial_amount }}</td>
                                                <td>{{ $item->current_amount }}</td>
                                                <td>{{ $item->validity }}</td>
                                                <td>{{ $item->order_amount }}</td>
                                                <td>{{ $item->cashback_amount }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isActive == 1 ? 'checked' : ''}} value="{{$item->membership_id}}"  onchange="change_status(this.value, 'membership', '#membershipStatusChange{{$item->membership_id}}', 'membership_id', 'isActive');" id="membershipStatusChange{{$item->membership_id}}">
                                                        <label class="custom-control-label" for="membershipStatusChange{{$item->membership_id}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <form action="{{ route('membership.edit', $item->membership_id) }}" method="get">
                                                        @csrf
                                                        <button class="btn-outline-info mr-1">
                                                            <i class="bx bxs-edit-alt" data-icon="warning-alt"></i>
                                                        </button>
                                                    </form>
                                                   
                                                       
                                                <form action="{{ route('membership.destroy', $item->membership_id) }}" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this Membership ?')" style="display: inline">
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