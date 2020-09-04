@extends('layouts')

@section('content')

<section class="input-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="">Edit Customer</h2>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" action="{{ route('customer.update', $customer->customer_id) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                 {{ method_field('PUT') }}
                    @include('customer._customerForm')
                    {{-- <button type="submit" class="btn btn-primary float-right my-2">Update</button> --}}
                </form>
            </div>
         </div>
        </div>
    </div>
</div>
</section>
@endsection