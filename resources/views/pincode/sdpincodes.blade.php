@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Standerd Pincodes</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"  class="btn btn-primary"><a style="color: #fff" href="{{route('sdpincode_add')}}">Add Standerd Pincode</a></button>
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
                                        <th>Pincode</th>
                                        <th>Status</th>
                                        <th>Commands</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($sdpincodes) && !empty($sdpincodes))
                                        @foreach ($sdpincodes as $k => $sdpincode)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $sdpincode->pincode}}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$sdpincode->isactive == 1 ? 'checked' : ''}} id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1" ><a href="{{ route('sdpincode_edit',$sdpincode->pincode_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$sdpincode->pincode}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('sdpincode_delete',['id'=>$sdpincode->pincode_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
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
