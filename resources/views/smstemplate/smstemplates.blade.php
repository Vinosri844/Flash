@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>SMS Templates</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"  class="btn btn-primary"><a style="color: #fff" href="{{route('smstemplate_add')}}">Create SMS Template</a></button>
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
                                        <th>SMS Template Name</th>
                                        <th>SMS Template</th>
                                        <th>Created On</th>
                                        <th>Commands</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($smstemplates) && !empty($smstemplates))
                                        @foreach ($smstemplates as $k => $smstemplate)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $smstemplate->sms_template_name}}</td>
                                                <td>{{ $smstemplate->sms_template_data}}</td>
                                                <td>{{ $smstemplate->created_on}}</td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1" ><a href="{{ route('smstemplate_edit',$smstemplate->sms_template_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$smstemplate->sms_template_name}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('smstemplate_delete',['id'=>$smstemplate->sms_template_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
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
