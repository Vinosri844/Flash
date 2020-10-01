@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Product Details</b></h5> <br />
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
                                        <th>Seller Name</th>
                                        <th>Product name</th>
                                        <th>Status</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($masters) && !empty($masters))
                                        @foreach ($masters as $k => $item)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{$item->seller['seller_name']}}</td>
                                                <td>{{ $item->product['product_name'] }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$item->isactive == 1 ? 'checked' : ''}}
                                                        value="{{$item->product_details_id}}"  onchange="change_status(this.value, 'product_details', '#customSwitchGlow{{$k}}', 'product_details_id', 'isactive');" id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $item->product_details_id }}, {{ $item->product['product_name'] }}, {{ $item->isactive }}"  data-toggle="modal" data-target="#eventMasterEdit"><a href="{{ route('stock', $item->product_details_id) }}"><i class="bx bxs-server" data-icon="warning-alt"></i></a></button>
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $item->product_details_id }}, {{ $item->product['product_name'] }}, {{ $item->isactive }}"  data-toggle="modal" data-target="#eventMasterEdit"><a href="{{ route('productDetail_edit', $item->product_details_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        {{-- <button clas
s="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$item->product['product_name']}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('productDetail_delete',['id'=>$item->product_details_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
                                                        </button>

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


    <!-- Modal
  <div class="modal fade" id="eventMasterCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="eventMasterCreate" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventMasterCreate">Create category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('category_submit') }}">
                @csrf
        <div class="form-group">
          <label for="eventName">Category Name</label>
          <input type="text" class="form-control" id="eventName" name="category_name" aria-describedby="eventName">
        </div>
        <div class="form-group" style="display: flex">
            <label for="eventStatus" class="mr-2">Category Status</label>
            <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                <input type="checkbox" class="custom-control-input" name="event_status" checked id="eventStatus">
                <label class="custom-control-label" for="eventStatus">
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
</div> -->
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
