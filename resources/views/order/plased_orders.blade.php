@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    {{-- <h5><b>Event Master</b></h5> <br /> --}}
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-text"></p>
                        <div class="row">
                            <div class="col-sm-8">  <h4 class="card-title">List</h4>
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
                                        <th>S.No</th>
                                        <th>Order Number</th>
                                        <th>Cust Name</th>
                                        <th>Order Date/Time</th>
                                        <th>Delivery Date</th>
                                        <th>Delivery Time</th>
                                        <th>Assign</th>
                                        <th>Amount</th>
                                        <th>status</th>
                                        <th>Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($orders) && !empty($orders))
                                        @foreach ($orders as $k => $order)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $order->order_number}}</td>
                                                <td>{{ $order->customer->customer_name}}</td>
                                                <td>{{ $order->order_date_time}}</td>
                                                <td>{{ $order->delivery_date}}</td>
                                                <td>{{ $order->delivery_time_slot}}</td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1 statusedit" id="statusedit" onclick="set_order_id({{$order->order_id}})" data-value="{{ $order->order_id }}"  data-toggle="modal" data-target="#statusupdate"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></button>
                                                    </div>
                                                </td>
                                                <td>{{ $order->final_paid_amount}}</td>
                                                <td>{{ $order->order_status->order_delivery_status_name}}</td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1 OrderDetail" data-value="{{ $order->order_id }}" onclick="order_detail({{$order->order_id}})"  data-toggle="modal" data-target="#OrderDetail"><i class="bx bx-receipt" data-icon="warning-alt"></i></button>
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

    <!-- // Basic Floating Label Form section start -->


    {{-- Edit Event Name --}}
    <div class="modal fade" id="statusupdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="statusupdate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusupdate">{{$status}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="statusEditForm" action="{{route('assign_order')}}">
                        {{-- method_field('PUT') --}}
                        @csrf
                        <div class="form-group">
                            <label for="eventNameEdit">Choose Delivery boy</label>
                            <input  type="hidden" name="status" value="{{$status_id}}" />
                            <input class="orderassignid" type="hidden" id="orderassignid" name="order_id"  />
                            <select name="dperson_id" id="dperson_id" class="form-control select2_picker">
                                <option value="">Select Delivery boy</option>
                                @if(isset($deliveryboys) && !empty($deliveryboys))
                                    @foreach($deliveryboys as $k => $val)
                                        <option value="{{ $val['id'] }}">{{ ucfirst($val['name']) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Order Assign</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="OrderDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="OrderDetail" aria-hidden="true">
        <div class="modal-dialog" id="orderdetail_model">

        </div>
    </div>
@endsection
