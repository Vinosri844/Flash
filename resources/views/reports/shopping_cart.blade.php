@extends('layouts')

@section('content')
<!-- Scroll - horizontal and vertical table -->
<h5><b>Shopping cart report</b></h5> <br />
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <p class="card-text">  
                        <div class="row">
                        <div class="col-sm-10">  <h4 class="card-title">List</h4>
                            </div> 
                            <div class="col-sm-2">
                            <button type="button" class="btn btn-primary btn-sm" >
                            <a href="" onclick="return confirm('Are you sure you want to download the seller selling report?')" style="color: #ffff;" class="tx-white tx-12 d-block mg-t-10">
                            <i class="bx bx-import" aria-hidden="true"></i></a></button>
                            <div class="clearfix"></div>
                        </div>
                        </div></p>   
                </div><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table width="100%" class="table nowrap scroll-horizontal-vertical">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>S.No</th>
                                        <th>Customer name</th>
                                        <th>No of product</th>
                                        <th>Total qty</th>
                                        <th>Date/Time</th>
                                        <th>Commands</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
