@extends('layouts')

@section('content')

<section class="input-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="">Create Store</h2>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" action="{{ route('store.store') }}" id="formFieldsCheck" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                 {{ method_field('POST') }}
                    @include('store._storeForm')
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
        $("form input[type='file']").change(function(){
         var image = $("input[name='store_company_logo']").val();
        //  var panimage = $("input[name='store_pan_image']").val();
         if(image != ''){
          $('#submitFormDetails').removeAttr('disabled');
         }else{
          $('#submitFormDetails').attr('disabled', true);
         }
        
      })


    //   $("#storePANImageUpload, #storeCompanyLogoImage").bind('keyup', function() {
    //    console.log(1);
    // if(allFilled()) $('#submitFormDetails').removeAttr('disabled');
    // });

    // function allFilled() {
    //     var filled = true;
    //     console.log('fun-in');
    //     $("#storeOfferFormCheck input").each(function() {
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