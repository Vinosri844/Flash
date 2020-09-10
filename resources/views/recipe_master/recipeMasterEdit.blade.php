@extends('layouts')

@section('content')

<section class="input-validation">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="">Edit Recipe</h2>
          </div>
          <div class="card-content">
            <div class="card-body">
            <form class="form-horizontal" action="{{ route('recipe-master.update', $recipe_master->recipe_id) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
                 {{ method_field('PUT') }}
                    @include('recipe_master._recipeMasterForm')
                    <button type="submit" class="btn btn-primary float-right my-2">Update</button>
                </form>
            </div>
         </div>
        </div>
    </div>
</div>
</section>
@endsection