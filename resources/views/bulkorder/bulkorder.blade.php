@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Bulk Order</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bulk Order Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="bulkorder_form" id="bulkorder_form" action="{{ route('bulkorder_submit') }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                      <fieldset>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="orderImage">Order Image</span>
                                          </div>
                                          <div class="custom-file">
                                          <input type="file"  class="custom-file-input" name="orderImage" id="dlicenceImage" aria-describedby="orderImage">
                                            <label class="custom-file-label" for="orderImage">Choose file</label>
                                          </div>
                                        </div>
                                      </fieldset>
                                    </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="title" class="form-control" placeholder="Title"
                                                       name="title" >
                                                <label for="first-name-floating">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="sub_tiitle" class="form-control" placeholder="Sub Title"
                                                       name="sub_title" >
                                                <label for="first-name-floating">Sub Title</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                            <textarea type="text" id="description" class="form-control" placeholder="Description"
                                                      name="description" cols="30" rows="4"></textarea>
                                                <label for="first-name-floating">Description</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                          <div class="form-group">
                                              <div class="controls">
                                                <input type="text" name="mobile_no" id="mobile_no" class="form-control"
                                                  data-validation-containsnumber-regex="^([0-9]+)$"
                                                  data-validation-containsnumber-message="The regex field format is invalid."
                                                  placeholder="Contact Number" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="button_text" class="form-control" placeholder="Button Text"
                                                       name="button_text" >
                                                <label for="first-name-floating">Button Text</label>
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
