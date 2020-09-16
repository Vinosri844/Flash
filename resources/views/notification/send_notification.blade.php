@extends('layouts')

@section('content')
    <!-- Scroll - horizontal and vertical table -->
    <h5><b>Send Notification</b></h5> <br />

    <!-- // Basic Floating Label Form section start -->
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Notification Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" name="products_form" id="products_form" action="{{ route('send_notification_submit') }}" enctype= multipart/form-data>
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <label class="form-label">users</label>
                                                <select name="user_id" id="user_id" class="form-control select2_picker" >
                                                    <option value="">Select Users</option>
                                                    <option value="All">All</option>
                                                    @if(isset($users) && !empty($users))
                                                        @foreach($users as $k => $user)
                                                            <option value="{{$user->customer_id}}">{{ ucfirst($user->customer_name) }}{{$user->notification_user_id}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="title" class="form-control" placeholder="Title"
                                                       name="title" >
                                                <label for="first-name-floating">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-label-group">
                                                <input type="text" id="message" class="form-control" placeholder="Description"
                                                       name="message" >
                                                <label for="first-name-floating">Description</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-50">
                                                <label class="text-bold-600" for="exampleInputEmail1">Image</label>
                                                <input type="file" id="image" class="form-control" name="image"
                                                       placeholder="Password">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Send</button>
                                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                        </div>
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
