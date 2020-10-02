<div class="modal-content" style="width: 160%;
    margin-left: -27%;">
    <div class="modal-header">
        <h5 class="modal-title" id="statusupdate">Order Invoince - {{$order->order_number}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <div class="modal-body"><div class="row">
            <div class="col-sm-6" >
            <label class=""><strong>Customer Name - </strong>{{$customer_address->customer_name}}</label>
            </div>
            <div class="col-sm-6" >
                <?php $date = (new DateTime($order['order_date_time']))->format('d-m-Y h:m A');?>
                <label class=""><strong>Date - </strong>{{$date}}</label>
            </div>
            </div>
            <label class=""><strong>Invoice No.- {{$order->order_number}}</strong></label>

            <div class="row">

                <div class="col-sm-6" >
                    <br>
                    <h5 class=""><strong>Bulling Address</strong></h5>
                    <p><strong> {{ $customer_address['customer_name']}}</strong><br>
                    {{$customer_address['customer_address_1'].", ".$address1}}<br>
                        {{$customer_address['city'] . "-"}}{{$customer_address['pincode'] . ","}}<br>
                         {{$customer_address['state'] != "" ? $customer_address['state'] . "," : ""}}{{$customer_address['country'] != "" ?  $customer_address['country'] . "," : " "}}
                    </p>
                </div>
                <div class="col-sm-6" >
                    <br>
                    <h5 class=""><strong>Shipping Address</strong></h5>
                    <p><strong> {{ $customer_address['customer_name']}}</strong><br>
                    {{$customer_address['customer_address_1'].", ".$address1}}<br>
                        {{$customer_address['city'] . "-"}}{{$customer_address['pincode'] . ","}}<br>
                        {{$customer_address['state'] != "" ? $customer_address['state'] . "," : ""}}{{$customer_address['country'] != "" ?  $customer_address['country'] . "," : " "}}
                    </p>
                </div>
            </div>
            <?php  $payment_type=$customer_address['payment_type_method'];
            $tmp_promocod=$customer_address['promocode'];

            $tmp_promo_code_amount=$customer_address['promocode_amount'];
            $tmp_cancle_amount = $customer_address['cancel_amount'];
            $tmp_paid_wallet_amount = $customer_address['wallet_amount'];
            $tmp_payment_method=$customer_address['payment_type_method'];

            $tmp_final_paid_amount = $customer_address['final_paid_amount'];

            $before_promocode_cancel_amount = $customer_address['before_promocode_cancel_amount'];
            $tmp_payable_amount = 0;
            $tmp_before_paromocode_amount = $customer_address['before_promocode_amount'] - $before_promocode_cancel_amount;//$tmp_cancle_amount;
            $tmp_after_paromocode_amount = $customer_address['after_promocode_amount'] - $tmp_cancle_amount;
            $delivery_charge= $customer_address['delivery_charge'];
            $tmp_delivery_charge = 0;
            $tmp_after_discount_amount = 0;
            ?>
            <div class="table-responsive">
                <table class="table zero-configuration " style="width:100%;">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Total</th>
                        <th>VAT1(%)</th>
                        <th>VAT2(%)</th>
                        <th>TOTAL AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($invoice_details) && !empty($invoice_details))
                        @foreach ($invoice_details as $k => $invoice_detail)
                            <tr>
                                <td><label>{{ $invoice_detail->product_name." (".$invoice_detail->product_weight_display.")" }}</label><br>
                                    <p>By - {{$invoice_detail->seller_name}}</p>
                                </td>
                                <td>{{$invoice_detail->product_qty}}</td>
                                <td>{{$invoice_detail->product_price}}</td>
                                <td>{{ $invoice_detail->tamt }}</td>
                                <td>{{ $invoice_detail->vat_1 }}</td>
                                <td>{{ $invoice_detail->vat_2 }}</td>
                                <td>{{ $invoice_detail->total }}</td>

                            </tr>
                        @endforeach

                    @endif
                    <tr>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{$totalqty}}</td>
                        <td></td>
                        <td>{{$totalprz}}</td>
                        <td></td>
                        <td></td>
                        <td>{{$grandtotal}}</td>
                    </tr>
                    <tr>
                        <<td colspan="3">Payment Mode: <span><b>{{$customer_address['payment_type_method']}}</b></span></td>
                        <td colspan="3" class="uk-text-right"><strong>Delivery Charge :</strong></td>
                        <td>{{$delivery_charge}}</td>
                    </tr>
                    <?php

                    $final_total= $grandtotal + $delivery_charge;

                    $whole = floor($final_total);      // 1
                    $round_value= round($final_total);
                    $decimal = $final_total - $whole;
                    ?>
                    <tr>
                        <td></td>
                        <td></td><td></td>
                        <td colspan="3" class="uk-text-right"><strong>Grand Total : </strong> </td>
                        <td class="uk-text-center"><strong><?php echo $final_total?> </strong> </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

        </div>
</div>
