@extends('layouts')

@section('content')


    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Product Stock</b></h5> <br />
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form method="post" name="stock_form" id="stock_form" action="{{ route('stock_submit',$productdetail->product_details_id) }}" enctype= multipart/form-data>
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-label-group">
                                    <label class="form-label">Weights</label>
                                    <select name="weight" id="weight" class="form-control select2_picker" onchange="cat_by_subcategory(this.value)">
                                        <option value="">Select Weight</option>
                                        @if(isset($weights) && !empty($weights))
                                            @foreach($weights as $k => $weight)
                                                <option value="{{ $weight->weight_id }}">{{ ucfirst($weight->weight_display) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-label-group">
                                    <input type="text" id="seller_price" class="form-control" placeholder="Seller Price"
                                           name="seller_price" >
                                    <label for="first-name-floating">Price</label>
                                </div>
                            </div>
                                <div class="col-sm-3">
                                    <div class="form-label-group">
                                        <input type="text" id="price" class="form-control" placeholder="Price"
                                               name="price" >
                                        <label for="first-name-floating">Price</label>
                                    </div>
                                </div>
                            <div class="col-sm-3">
                                <div class="form-label-group">
                                    <input type="text" id="stock" class="form-control" placeholder="Stock"
                                           name="stock" >
                                    <label for="first-name-floating">Stock</label>
                                </div>
                            </div>


                        </div>
                         <div class="row">
                             <div class="col-sm-9">
                             </div>
                             <div class="col-sm-3">
                                 <button type="submit"  class="btn btn-primary"><a style="color: #fff">Add Stock</a></button>
                             </div>
                         </div>
                        </form>
                    </div><hr>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table zero-configuration " style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>Sr.No</th>
                                        <th>Product Name</th>
                                        <th>Seller name</th>
                                        <th>Weight</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($stocks) && !empty($stocks))
                                        @foreach ($stocks as $k => $stock)
                                            <tr>
                                                <td><input type="checkbox" id="master"></td>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td>{{ $seller->seller_name }}</td>
                                                <td>{{ $stock->weight_display }}</td>
                                                <td>{{ $stock->weight }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$stock->isactive == 1 ? 'checked' : ''}} id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1 eventMasterEdit" data-value="{{ $stock->stock_id }},"  data-toggle="modal" data-target="#eventMasterEdit"><a href="{{ route('product_edit', $stock->stock_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        {{-- <button clas
s="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$stock->weight_display}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('product_delete',['id'=>$stock->stock_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
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
