@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Delivery Charges</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">  <h4 class="card-title">List</h4>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"  class="btn btn-primary"><a style="color: #fff" href="{{route('deliverycharge_add')}}">Create Delivery Charge</a></button>
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
                                        <th>Minimun Amount</th>
                                        <th>Maximum Amount</th>
                                        <th>Delivery Charge</th>
                                        <th>Commands</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($deliverycharges) && !empty($deliverycharges))
                                        @foreach ($deliverycharges as $k => $deliverycharge)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $deliverycharge->start_amount}}</td>
                                                <td>{{ $deliverycharge->end_amount}}</td>
                                                <td>{{ $deliverycharge->delivery_charge}}</td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1" ><a href="{{ route('deliverycharge_edit',$deliverycharge->delivery_charge_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$deliverycharge->delivery_charge}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('deliverycharge_delete',['id'=>$deliverycharge->delivery_charge_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
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
