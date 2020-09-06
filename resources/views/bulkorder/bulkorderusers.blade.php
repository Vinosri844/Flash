@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Bulk Order User List</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div>
                            
                        </div>
                    </div><hr>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table zero-configuration " style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile no</th>
                                        <th>event</th>
                                        <th>Created Date and Time</th>
                                        <th>commands</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($masters) && !empty($masters))
                                        @foreach ($masters as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{ $item->email}}</td>
                                                <td>{{ $item->mobile_no }}</td>
                                                <td>{{ $item->event[0]->event_name }}</td>
                                                <td>{{ $item->created_date_time }}</td>

                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $item->logistics_id }}, {{ $item->logistics_name }}, {{ $item->isactive }}"  data-toggle="modal" data-target="#eventMasterEdit"><a href=""><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>

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


     Modal
  <div class="modal fade" id="userdetails" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="userdetails" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width:140%">
        <div class="modal-header">
          <h5 class="modal-title" id="eventMasterCreate">Bulk Order User Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                @csrf
        <div class="form-group">
          <table class="table table-condensed table-hover table-striped">
                          <thead>
                          	<tr>
                          		<th style="border-bottom: none;vertical-align: middle;">Name : </th>
                          		<td colspan="3">Rashmi new</td>
                          	</tr>

                          	<tr>
                          		<th style="border-bottom: none;vertical-align: middle;">Email : </th>
                          		<td>upari.rashmi@gmail.com</td>

                          		<th>Contact </th>
                          		<td>7022848224</td>
                          	</tr>

                          	<tr>
                          		<th style="border-bottom: none;vertical-align: middle;">Date : </th>
                          		<td>07-08-2020</td>

                          		<th style="border-bottom: none;vertical-align: middle;">No. Of People : </th>
                          		<td>10</td>
                          	</tr>

                          	<tr>
                          		<!--<th style="border-bottom: none;vertical-align: middle;">Company Name : </th>
                          		<td></td>-->
          						<th style="border-bottom: none;vertical-align: middle;"></th>
                          		<td></td>

                          		<th style="border-bottom: none;vertical-align: middle;">Event : </th>
                          		<td>Wedding Party</td>
                          	</tr>

                          	<tr>
                          		<th style="border-bottom: none;vertical-align: middle;">Address : </th>
                          		<td colspan="3">test</td>
                          	</tr>

                          	<tr>
                          		<th style="border-bottom: none;vertical-align: middle;">Description : </th>
                          		<td colspan="3">Covid wedding party</td>
                          	</tr>
                      	</thead>
                  	</table>        </div>


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

</div>
</div>
</div>
</div>
    <!-- // Basic Floating Label Form section end -->

    <!--
{{-- Edit Event Name --}}
        <div class="modal fade" id="eventMasterEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="eventMasterEdit" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eventMasterEdit">Edit category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="eventEditForm">
                {{ method_field('PUT') }}
    @csrf
        <div class="form-group">
          <label for="eventNameEdit">Category Name</label>
          <input type="text" class="form-control" id="eventNameEdit" name="category_name" aria-describedby="eventName">

        </div>
        <div class="form-group" style="display: flex">
            <label for="eventStatus" class="mr-2">Category Status</label>
            <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="eventStatusEdit" name="event_status" id="eventStatusEdit">
                <label class="custom-control-label" for="eventStatusEdit">
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
            $(document).on('click', '.eventMasterEdit', function(){
                  var event = $(this).data('value');
                  var event_array = event.split(',');
                  console.log(event_array);
                  $('#eventNameEdit').val(event_array[1]);
            if(event_array[2] == 1){
                console.log(1);
                $('#eventStatusEdit').attr('checked', true);
            }
            $('#eventEditForm').attr('action', "{{ url('/category') }}" + "/" + event_array[0])

      });
  </script>

  @endpush

        -->

@endsection
