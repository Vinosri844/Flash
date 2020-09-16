@extends('layouts')

@section('content')

<section class="input-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="">Create Store Offer</h2>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" action="{{ route('store-offer.store') }}" id="formFieldCheck" method="POST"  enctype="multipart/form-data" novalidate autocomplete="off">
                 {{ method_field('POST') }}
                    @include('store_offer._storeOfferForm')
                    <button type="submit" id="submitFormDetails" class="btn btn-primary float-right my-2" disabled>Create</button>
                </form>
            </div>
         </div>
        </div>
    </div>
</div>
</section>
@push('scripts')
   <script>

     $("#storeOfferImageUpload").change(function(){
      $('#submitFormDetails').removeAttr('disabled');
     })
    //  $("input[type='text']").bind('keyup', function() {
    //    console.log(1);
    // if(allFilled()) $('#submitFormDetails').removeAttr('disabled');
    // });

    // function allFilled() {
    //     var filled = true;
    //     $("#storeOfferFormCheck input[type='file']").each(function() {
    //       console.log('in');
    //         if($(this).val() == '') {
    //           console.log(1);
    //           filled = false;
    //         }
    //     });
    //     return filled;
    // }
   
   </script>
@endpush
@endsection
