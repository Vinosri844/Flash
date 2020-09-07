@extends('layouts')



@section('content')

    

    <!-- Scroll - horizontal and vertical table -->
{{-- <h5><b>Delivery Slot Master</b></h5> <br /> --}}
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
                                <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#deliverySlotMasterCreate" class="btn btn-primary">Create Delivery Slot</button>
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
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if(isset($masters) && !empty($masters))
                                            @foreach ($masters as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ date('h:i a', strtotime($item->from_time)) }}</td>
                                                <td>{{ date('h:i a', strtotime($item->to_time)) }}</td>
                                                <td>{{ $item->created_date_time }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isActive == 1 ? 'checked' : ''}} value="{{$item->delivery_slot_id}}"  onchange="change_status(this.value, 'delivery_slot_master', '#deliverySlotStatus{{$item->delivery_slot_id}}', 'delivery_slot_id', 'isActive');" id="deliverySlotStatus{{$item->delivery_slot_id}}">
                                                        <label class="custom-control-label" for="deliverySlotStatus{{$item->delivery_slot_id}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <button class="btn-outline-info mr-1 deliverySlotMasterEdit" data-value="{{ $item->delivery_slot_id }},{{ $item->from_time }},{{ $item->to_time }},{{ $item->isActive }}"  data-toggle="modal" data-target="#deliverySlotMasterEdit"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                        {{-- <button class="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <form action="{{ route('delivery-slot-master.destroy', $item->delivery_slot_id) }}" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this Delivery Slot ?')" style="display: inline">
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

  
<!-- Modal -->
  <div class="modal fade" id="deliverySlotMasterCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deliverySlotMasterCreate" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deliverySlotMasterCreate">Create Delivery Slot</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('delivery-slot-master.store') }}">
                @csrf
                
                <div class="form-group">
                  <label for="deliverySlotFrom">From Time</label>
                  <input type="time" class="form-control" id="deliverySlotFrom" name="deliverySlotFrom" aria-describedby="deliverySlotFrom">
    
                </div>
                <div class="form-group">
                  <label for="deliverySlotTo">To Time</label>
                  <input type="time" class="form-control" id="deliverySlotTo" name="deliverySlotTo" aria-describedby="deliverySlotTo">
    
                </div>
                <div class="form-group" style="display: flex">
                    <label for="deliverySlotStatus" class="mr-2">Slot Status</label>
                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="deliverySlotStatus" checked id="deliverySlotStatus">
                        <label class="custom-control-label" for="deliverySlotStatus"> 
                        </label>
                      </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>
<!-- // Basic Floating Label Form section end -->


{{-- Edit Event Name --}}
<div class="modal fade" id="deliverySlotMasterEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deliverySlotMasterEdit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deliverySlotMasterEdit">Edit Delivery Slot </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="deliverySlotMasterEditForm">
                {{ method_field('PUT') }}
                @csrf
                 
                  <div class="form-group">
                    <label for="deliverySlotFromEdit">From Time</label>
                    <input type="time" class="form-control" id="deliverySlotFromEdit" name="deliverySlotFromEdit" aria-describedby="deliverySlotFromEdit">
      
                  </div>
                  <div class="form-group">
                    <label for="deliverySlotToEdit">To Time</label>
                    <input type="time" class="form-control" id="deliverySlotToEdit" name="deliverySlotToEdit" aria-describedby="deliverySlotToEdit">
      
                  </div>
                  <div class="form-group" style="display: flex">
                      <label for="deliverySlotStatusEdit" class="mr-2">Slot Status</label>
                      <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                          <input type="checkbox" class="custom-control-input" name="deliverySlotStatusEdit" id="deliverySlotStatusEdit">
                          <label class="custom-control-label" for="deliverySlotStatusEdit"> 
                          </label>
                        </div>
                  </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>

@push('scripts')

<script>
    $(document).on('click', '.deliverySlotMasterEdit', function(){
          var event = $(this).data('value');
          var event_array = event.split(',');
          
          
          document.getElementById('deliverySlotFromEdit').value = event_array[1];
          document.getElementById('deliverySlotToEdit').value = event_array[2];
         

          if(event_array[3] == 1){
           
              $('#deliverySlotStatusEdit').attr('checked', true);
          }
          $('#deliverySlotMasterEditForm').attr('action', "{{ url('/delivery-slot-master') }}" + "/" + event_array[0])
          
    });
</script>

  
@endpush
  

@endsection