@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>SMS Template Create</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">SMS Template Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="payments_form" id="payments_form" action="{{ route('smstemplate_submit') }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="sms_template_name" class="form-control" placeholder="SMS Template Name"
                                                       name="sms_template_name" >
                                                <label for="first-name-floating">SMS Template Name</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="template_description" class="form-control" placeholder="SMS Template Description"
                                                       name="template_description" >
                                                <label for="first-name-floating">SMS Template Description</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Create</button>
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
