@extends('layouts')

@section('content')

<section class="input-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="">Edit {{ucfirst($store->seller_name)}} Store</h2>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" action="{{ route('store.update', $store->seller_id) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                 {{ method_field('PUT') }}
                    @include('store._storeForm')
                    <button type="submit" class="btn btn-primary float-right my-2">Update</button>
                </form>
            </div>
         </div>
        </div>
    </div>
</div>
</section>

{{-- Branch Add Modal --}}

<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Branch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('branch-add')}}" method="post">
          @csrf
          @method('POST')
            <div class="row justify-content-between mb-2">
                <div class="col-md-6">
                   <input type="hidden" name="seller_id" value="{{$store->seller_id}}">
                  <div class="form-group">
                      <label for="storeBranchName">Branch Name</label>
                      <div class="controls">
                        <input type="text" value=""  name="store_branch_name" id="storeBranchName" class="form-control"
                           placeholder="Branch Name">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="storePincode">Pincode</label>
                      <div class="controls">
                        <input type="text"  value="" name="store_pincode" id="storePincode" class="form-control"
                           placeholder="Pincode">
                      </div>
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="storeBranchType">Branch Type</label>
                  <div class="controls">
                    <input type="text" value=""  name="store_branch_type" id="storeBranchType" class="form-control"
                       placeholder="Branch Type">
                  </div>
                </div>
                <div class="form-group">
                  <label for="storeBranchCity">Branch City</label>
                  <div class="controls">
                    <input type="text" value=""  name="store_branch_city" id="storeBranchCity" class="form-control"
                       placeholder="Branch City">
                  </div>
                </div>
                 
              </div>
              <div class="col-md-12">
                  <fieldset class="form-group">
                    <label for="storeShortAddress">Short Address</label>
                    <textarea class="form-control" id="storeShortAddress" name="store_short_address" rows="5" placeholder="Address"></textarea>
                </fieldset>
              </div>
              
              
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary ml-auto">Add</button>
        </div>
    </form>
      </div>
    </div>
  </div>


  {{-- Branch Delete Modal --}}
 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" id="branch_delete_form">
        @csrf
        
        <h6 class="text-danger">Are you sure you want to delete this branch ?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger ml-auto">Delete</button>
      </div>
    </form>
    </div>
  </div>
</div>

@push('scripts')
    <script>
      function branch_delete(id){
        $('#branch_delete_form').attr('action', "{{ url('/branch-delete') }}" + "/" + id);
      }
    </script>
@endpush
@endsection