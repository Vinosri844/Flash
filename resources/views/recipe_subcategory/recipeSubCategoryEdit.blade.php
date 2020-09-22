@extends('layouts')

@section('content')

<section class="input-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="">Edit {{ucfirst($recipe_subcategory->subcategory_name)}} Sub-Category</h2>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" action="{{ route('recipe-sub-category.update', $recipe_subcategory->recipe_subcategory_id) }}" id="formFieldCheck" method="POST"  enctype="multipart/form-data" novalidate autocomplete="off">
                 {{ method_field('PUT') }}
                    @include('recipe_subcategory._recipeSubCategoryForm')
                    <button type="submit" id="submitFormDetails" class="btn btn-primary float-right my-2">Update</button>
                </form>
            </div>
         </div>
        </div>
    </div>
</div>
</section>
@push('scripts')
   <script>

     $("#recipesubcategoryImageUpload").change(function(){
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
