@extends('layouts')

@section('content')
    

    <!-- Scroll - horizontal and vertical table -->
{{-- <h5><b>Event Master</b></h5> <br /> --}}
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
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#eventMasterCreate" class="btn btn-primary">Create Event</button>
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
                                        <th>Event name</th>
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
                                                <td>{{ $item->event_name }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isActive == 1 ? 'checked' : ''}} value="{{$item->event_id}}"  onchange="change_status(this.value, 'event_master', '#eventStatusChange{{$item->event_id}}', 'event_id', 'isActive');" id="eventStatusChange{{$item->event_id}}">
                                                        <label class="custom-control-label" for="eventStatusChange{{$item->event_id}}">
                                                        </label>
                                                      </div>    
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                    <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $item->event_id }}, {{ $item->event_name }}, {{ $item->isActive }}"  data-toggle="modal" data-target="#eventMasterEdit"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                        {{-- <button class="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <form action="{{ route('event-master.destroy', $item->event_id) }}" method="post" 
                                                            onsubmit = "return confirm('Are you sure wanted to delete this {{$item->event_name}} ?')" style="display: inline">
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
  <div class="modal fade" id="eventMasterCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="eventMasterCreate" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventMasterCreate">Create Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('event-master.store') }}">
                @csrf
                <div class="form-group">
                  <label for="eventName">Event Name</label>
                  <input type="text" class="form-control" id="eventName" name="event_name" aria-describedby="eventName">
    
                </div>
                <div class="form-group" style="display: flex">
                    <label for="eventStatus" class="mr-2">Event Status</label>
                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                        <input type="checkbox" class="custom-control-input" name="event_status" checked id="eventStatus">
                        <label class="custom-control-label" for="eventStatus"> 
                        </label>
                      </div>
                </div>
                
                
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create</button>
          
        </div>
      </form>
      </div>
    </div>
  </div>
<!-- // Basic Floating Label Form section end -->


{{-- Edit Event Name --}}
<div class="modal fade" id="eventMasterEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="eventMasterEdit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventMasterEdit">Edit Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="eventEditForm">
                {{ method_field('PUT') }}
                @csrf
                <div class="form-group">
                  <label for="eventNameEdit">Event Name</label>
                  <input type="text" class="form-control" id="eventNameEdit" name="event_name" aria-describedby="eventName">
    
                </div>
                <div class="form-group" style="display: flex">
                    <label for="eventStatus" class="mr-2">Event Status</label>
                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="eventStatusEdit" name="event_status" id="eventStatusEdit">
                        <label class="custom-control-label" for="eventStatusEdit"> 
                        </label>
                      </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
          
        </div>
      </form>
      </div>
    </div>
  </div>


  @push('scripts')

  <script>
      $(document).on('click', '.eventMasterEdit', function(){
            var event = $(this).data('value');
            var event_array = event.split(',');
            
            $('#eventNameEdit').val(event_array[1]);
            if(event_array[2] == 1){
             
                $('#eventStatusEdit').attr('checked', true);
            }
            $('#eventEditForm').attr('action', "{{ url('/event-master') }}" + "/" + event_array[0])
            
      });
  </script>

  @endpush

@endsection