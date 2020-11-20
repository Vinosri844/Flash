@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Slider Create</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Slider Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="products_form" id="products_form" action="{{ route('slider_submit') }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">OS Type</label>
                                                <select name="os_type" id="os_type" class="form-control select2_picker">
                                                    <option value="">Select Os Type</option>
                                                    <option value="ANDROID">Android</option>
                                                    <option value="WEB">Web</option>
                                                    <option value="IOS">Ios</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">Slider Position</label>
                                                <select name="slider_position" id="slider_position" class="form-control select2_picker" onchange="choose_position(this.value)">
                                                    <option value="">Select Position</option>
                                                    @if(isset($slider_position) && !empty($slider_position))
                                                        @foreach($slider_position as $k => $val)
                                                            <option value="{{$k}}">{{ ucfirst($val) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">Category</label>
                                                <select name="category_id" id="category_id" class="form-control select2_picker">
                                                    <option value="">Select Category</option>
                                                    @if(isset($category) && !empty($category))
                                                        @foreach($category as $k => $val)
                                                            <option value="{{ $val->category_id }}">{{ ucfirst($val->category_name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">Home Slider Position</label>
                                                <select name="homeslider_position" id="homeslider_position" class="form-control select2_picker" >
                                                    <option value="">Select Position</option>
                                                    @if(isset($homeslider_position) && !empty($homeslider_position))
                                                        @foreach($homeslider_position as $k => $val)
                                                            <option value="{{$k}}">{{ ucfirst($val) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="link" class="form-control" placeholder="image Url"
                                                       name="link" >
                                                <label for="first-name-floating">Link</label>
                                            </div>
                                        </div> --}}
                                        <div class="col-6">
                                            <div class="form-group mb-50">
                                                <label class="text-bold-600" for="exampleInputEmail1">Slider Image</label>
                                                <input type="file" id="slider_image" class="form-control" name="slider_image"
                                                       placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Other Product Info</h4>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group" style="display: flex">
                                                <label for="eventStatus" class="mr-2">Active</label>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="isactive" checked id="isactive">
                                                    <label class="custom-control-label" for="product_status">
                                                    </label>
                                                </div>
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
