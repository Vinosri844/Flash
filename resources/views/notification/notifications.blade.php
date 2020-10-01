@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Send Notifications</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"  class="btn btn-primary"><a style="color: #fff" href="{{route('send_notification')}}">Send Notification</a></button>
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
                                        <th>Customer Name</th>
                                        <th>Message</th>
                                        <th>Customer Device</th>
                                        <th>Customer Device</th>
                                        <th>Commands</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($notifications) && !empty($notifications))
                                        @foreach ($notifications as $k => $notification)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $notification->customer['customer_name']}}</td>
                                                <td>{{ $notification->message}}</td>
                                                <td>{{ $notification->customer['customer_device_os']}}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$notification->customer['isactive'] == 1 ? 'checked' : ''}} 
                                                        value="{{$notification->notification_logs_id}}"  onchange="change_status(this.value, 'notification_logs', '#customSwitchGlow{{$k}}', 'notification_logs_id', 'isactive');" id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <input type="hidden" id="id" value="{{$notification->notification_logs_id}}" />
                                                        <button class="btn-outline-info mr-1" onclick="resend_notification({{$notification->notification_logs_id}})"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
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
