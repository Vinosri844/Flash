@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Slider</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"  class="btn btn-primary"><a style="color: #fff" href="{{route('slider_add')}}">Create Slider</a></button>
                            </div>

                        </div>
                    </div><hr>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table zero-configuration " style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>Sr.No</th>
                                        <th>Image</th>
                                        <th>OS Type</th>
                                        <th>Category Name</th>
                                        <th>Slider Position</th>
                                        <th>Slider Postion For Web-Home</th>
                                        <th>Status</th>
                                        <th>Commands</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($sliders) && !empty($sliders))
                                        @foreach ($sliders as $k => $slider)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <?php $img = !empty($slider->slider_image) ? asset(config('constants.category_img_path1').$slider->slider_image) : "http://placehold.it/50x50"; ?>
                                                <td><img src="{{ $img }}" class="img-fluid img-thumbnail" alt="#" height="50" width="50"></td>
                                                <td>{{ $slider->OS}}</td>
                                                <td>{{ $slider->category_name}}</td>
                                                <td>{{ $slider->slider_name }}</td>
                                                <td>{{ $slider->homeslider_name }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$slider->isactive == 1 ? 'checked' : ''}} 
                                                        value="{{$slider->slider_id}}"  onchange="change_status(this.value, 'slider', '#customSwitchGlow{{$k}}', 'slider_id', 'isactive');" id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1" ><a href="{{ route('slider_edit',$slider->slider_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        {{-- <button clas
s="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$slider->slider_image}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('slider_delete',['id'=>$slider->slider_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
                                                        </button>

                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Scroll - horizontal and vertical table -->

@endsection
