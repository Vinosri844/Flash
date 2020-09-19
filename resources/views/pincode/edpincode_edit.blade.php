@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Extended Pincode Update</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pincode Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="payments_form" id="payments_form" action="{{ route('edpincodeedit_submit',$edpincode->pincode_id) }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="pincode" class="form-control" placeholder="pincode"
                                                       name="pincode" value="{{$edpincode->pincode}}">
                                                <label for="first-name-floating">Pincode</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="delivery_charge" class="form-control" placeholder="Delivery Charge"
                                                       name="delivery_charge" value="{{$edpincode->delivery_charge}}">
                                                <label for="first-name-floating">Delivery Charge</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group" style="display: flex">
                                                <label for="eventStatus" class="mr-2">Active</label>
                                                <?php $check = $edpincode->isactive == 1 ? 'checked' : ''; ?>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="isactive" {{$check}} id="isactive">
                                                    <label class="custom-control-label" for="isactive">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
                                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Floating Label Form section end -->
@endsection
