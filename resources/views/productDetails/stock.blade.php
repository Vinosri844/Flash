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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="price">Product Code</label>
                                    <div class="controls">
                                        <input type="number" disabled class="form-control"
                                               id="product_code" name="product_code"  placeholder="{{$product_code}}">
                                    </div>
                                </div>
                        </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Weights<span class="text-danger"> *</span></label>
                                    <select name="weight" id="weight" class="form-control select2_picker" onchange="cat_by_subcategory(this.value)" required>
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

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="price">Product Price<span class="text-danger"> *</span></label>
                                        <div class="controls">
                                        <input type="number" class="form-control"
                                          id="price" name="price" placeholder="Price"required>
                                        </div>
                                      </div>
                                </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="stock">Stock<span class="text-danger"> *</span></label>
                                    <div class="controls">
                                    <input type="number" class="form-control"
                                      id="stock" name="stock" placeholder="Stock" required>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label">Discount Type</label>
                                    <select name="dis_type" id="weight" class="form-control select2_picker" onchange="show_discount(this.value);">
                                        <option value="">Select Discount Type</option>
                                        <option value="1">Percentage</option>
                                        <option value="2">Amount</option>

                                    </select>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            @push('scripts')
                                <script>
                                    function show_discount(id){
                                        if(id){
                                            $('#non_discount_show').removeClass('d-none');
                                            $('#discount_show').removeClass('d-none');
                                            $('#non_discount').attr('required', true);
                                            $('#discount').attr('required', true);
                                        }else{
                                            $('#non_discount_show').addClass('d-none');
                                            $('#discount_show').addClass('d-none');
                                            $('#non_discount').attr('required', false);
                                            $('#discount').attr('required', false);
                                        }
                                    }
                                </script>
                            @endpush
                            <div class="col-sm-3">
                                <div class="form-group d-none" id="non_discount_show">
                                    <label for="non_discount">Non Membership Discount<span class="text-danger"> *</span></label>
                                    <div class="controls">
                                    <input type="number" name="non_discount" id="non_discount" class="form-control"
                                       placeholder="Value">
                                    </div>
                                  </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="form-group d-none"id="discount_show">
                                    <label for="discount"> Membership Discount<span class="text-danger"> *</span></label>
                                    <div class="controls">
                                    <input type="number" name="discount" id="discount" class="form-control"
                                      placeholder="Value">
                                    </div>
                                  </div>

                            </div>
                        </div>
                         <div class="row">
                             <div class="col-sm-9">
                             </div>
                             <div class="col-sm-3">
                                 <button type="submit"  class="btn btn-primary float-right"><a style="color: #fff">Add Stock</a></button>
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
                                        <th>Product Code</th>
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
                                                <td>{{isset($stock->product_weight_code) ? $stock->product_weight_code : null}}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td>{{ $seller->seller_name }}</td>
                                                <td>{{ $stock->weight_display }}</td>
                                                <td>{{ $stock->weight }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-glow custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" {{$stock->isactive == 1 ? 'checked' : ''}}
                                                        value="{{$stock->stock_id}}"  onchange="change_status(this.value, 'stock', '#customSwitchGlow{{$k}}', 'stock_id', 'isactive');" id="customSwitchGlow{{$k}}">
                                                        <label class="custom-control-label" for="customSwitchGlow{{$k}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div  style="display:inline-flex">
                                                        <button class="btn-outline-info mr-1 eventMasterEdit" ><a href="{{ route('stock_update', $stock->stock_id) }}"><i class="bx bxs-edit-alt" data-icon="warning-alt"></i></a></button>
                                                        {{-- <button clas
s="btn-outline-danger"><i class="bx bx-trash-alt"></i></button> --}}
                                                        <button  onclick = "return confirm('Are you sure wanted to delete this {{$stock->weight_display}} ?')" style="display: inline" class="btn-outline-danger">
                                                            <a href="{{route('stock_delete',['id'=>$stock->stock_id])}}"><i style="color: red" class="bx bx-trash-alt"></i></a>
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
