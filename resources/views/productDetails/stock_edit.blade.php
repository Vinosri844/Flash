@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Stock Edit</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Stock Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="stock_form" id="stock_form" action="{{ route('stock_edit_submit',$stock->stock_id) }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <input type="text" disabled id="product_code" class="form-control" placeholder="Product Code"
                                                   name="product_code" value="{{$product_code}}">
                                            <label for="first-name-floating">Product Code</label>
                                        </div>
                                        <input type="hidden" id="productweight_id" class="form-control"
                                               name="productweight_id" value="{{$productweightdetail->product_weight_details_id}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <label class="form-label">Weights</label>
                                            <select name="weight" id="weight" class="form-control select2_picker" onchange="cat_by_subcategory(this.value)">
                                                <option value="">Select Weight</option>
                                                @if(isset($weights) && !empty($weights))
                                                    @foreach($weights as $k => $weight)
                                                        <?php $sel = $weight->weight_id == $stock->weight_id ? 'selected' : ''; ?>
                                                        <option value="{{ $weight->weight_id }}" {{$sel}}>{{ ucfirst($weight->weight_display) }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <input type="number" id="price" class="form-control" placeholder="Price"
                                                   name="price" value="{{$productweightdetail->seller_price}}">
                                            <label for="first-name-floating">Product Price</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <input type="text" id="stock" class="form-control" placeholder="Stock"
                                                   name="stock" value="{{$stock->weight}}">
                                            <label for="first-name-floating">Stock</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <label class="form-label">Discount Type</label>
                                            <select name="dis_type" id="weight" class="form-control select2_picker">
                                                <option value="">Select Discount Type</option>
                                                <option value="1" {{$productweightdetail->discount_type == 1 ? 'selected' : "" }}>Percentage</option>
                                                <option value="2" {{$productweightdetail->discount_type == 2 ? 'selected' : "" }}>Rupee</option>

                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <input type="number" id="non_discount" class="form-control" placeholder="Non Membership Discount"
                                                   name="non_discount" value="{{$productweightdetail->discount_value}}">
                                            <label for="first-name-floating">Non Membership Discount</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-label-group">
                                            <input type="number" id="discount" class="form-control" placeholder="Membership Discount"
                                                   name="discount" value="{{$productweightdetail->m_discount_value}}">
                                            <label for="first-name-floating">Membership Discount</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit"  class="btn btn-primary"><a style="color: #fff">Update Stock</a></button>
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
