@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Slider Update</b></h5> <br />

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
                            <form method="post" name="products_form" id="products_form" action="{{ route('slideredit_submit',$slider->slider_id) }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">OS Type</label>
                                                <select name="os_type" id="os_type" class="form-control select2_picker">
                                                    <option value="">Select Os Type</option>
                                                    <option value="ANDROID" <?php if($slider->OS=='ANDROID') echo 'selected'; ?>>Android</option>
                                                    <option value="WEB" <?php if($slider->OS=='WEB') echo 'selected'; ?>>Web</option>
                                                    <option value="IOS" <?php if($slider->OS=='IOS') echo 'selected'; ?>>Ios</option>
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
                                                            <?php $sel = $k == $slider->slider_position ? 'selected' : ''  ?>
                                                            <option value="{{$k}}" {{$sel}}>{{ ucfirst($val) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">Category</label>
                                                <?php $sli =  $slider->slider_position == 1 ? 'disabled' : '' ?>
                                                <select name="category_id" id="category_id" class="form-control select2_picker" {{$sli}} >
                                                    <option value="">Select Category</option>
                                                    @if(isset($category) && !empty($category))
                                                        @foreach($category as $k => $val)
                                                            <?php $sel = $val->category_id == $slider->category_id ? 'selected' : ''  ?>
                                                            <option value="{{ $val->category_id }}" {{$sel}}>{{ ucfirst($val->category_name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">Home Slider Position</label>
                                                <?php $sli =  $slider->slider_position == 2 ? 'disabled' : '' ?>

                                                <select name="homeslider_position" id="homeslider_position" class="form-control select2_picker" {{$sli}}>
                                                    <option value="">Select Position</option>
                                                    @if(isset($homeslider_position) && !empty($homeslider_position))
                                                        @foreach($homeslider_position as $k => $val)
                                                            <?php $sel = $k == $slider->web_home_slider_position ? 'selected' : ''  ?>
                                                            <option value="{{$k}}" {{$sel}}>{{ ucfirst($val) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6">
                                           
                                            <div class="form-label-group">
                                                <input type="text" id="link" class="form-control" placeholder="image Url"
                                                       name="link" value="{{$slider->link}}">
                                                <label for="first-name-floating">Link</label>
                                            </div>
                                        </div> --}}
                                        <div class="col-6">
                                            <?php $img = !empty($slider->slider_image) ? asset(config('constants.product_img_path').$slider->slider_image) : "http://placehold.it/50x50"; ?>
                                            <img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50">
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
                                                <?php $check = $slider->isactive == 1 ? 'checked' : ''; ?>
                                                <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="isactive" {{$check}} id="isactive">
                                                    <label class="custom-control-label" for="product_status">
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
