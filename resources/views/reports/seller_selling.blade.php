@extends('layouts')

@section('content')
<!-- Scroll - horizontal and vertical table -->
<h5><b>Seller selling report</b></h5> <br />
<section id="horizontal-vertical">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <br />
                <form class="form">
              <div class="form-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="date" id="first-name-floating" class="form-control" placeholder="First Name"
                        name="fname-floating">
                      <label for="first-name-floating">From date</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-label-group">
                      <input type="date" id="email-id-floating" class="form-control" name="email-id-floating"
                        placeholder="Email">
                      <label for="email-id-floating">To date</label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Filter</button>
                    <button type="submit" class="btn btn-primary mr-1 mb-1"><i class="bx bx-import" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </form><hr>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        
                        <div class="table-responsive">
                            <table width="100%" class="table nowrap scroll-horizontal-vertical">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="master"></th>
                                        <th>S.No</th>
                                        <th>Seller name</th>
                                        <th>Product name</th>
                                        <th>Unit</th>
                                        <th>Qty(sell)</th>
                                        <th>Amount</th>
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
