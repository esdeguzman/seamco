@extends('admin.layout.main')

@section('page-title') | Profile @stop

@section('my-profile') class="active" @stop

@section('page-content')
    <div class="right_col" role="main">
        <div class="">

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Administrator Profile</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs"><!-- 
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"></a>
                                        </li>
                                    </ul> -->
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <div class="panel-body">
                                                <form action="{{ route('admin.update', $admin->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('put') }}
                                                    <h3 class="green">
                                                        {{ $admin->first_name }} {{ $admin->middle_name }} {{ $admin->last_name }}
                                                    </h3>

                                                    <br />

                                                    <div class="project_detail">

                                                        <p class="title">Code</p>
                                                        <p>{{ $admin->code }}</p>
                                                        <p class="title">Username</p>
                                                        <p>{{ $admin->username }}</p>
                                                        <p class="title">Position</p>
                                                        <p>
                                                            <input style="width: 300px" class="text-center" type="text" name="position" value="{{ $admin->position }}">
                                                            @if($errors->has('position')) <label class="text-danger">{{ $errors->first('position') }}</label> @endif
                                                        </p>
                                                        <p class="title">Email</p>
                                                        <p>
                                                            <input style="width: 300px" class="text-center" type="text" name="email" value="{{ $admin->email }}">
                                                            @if($errors->has('email')) <label class="text-danger">{{ $errors->first('email') }}</label> @endif
                                                        </p>
                                                        <p class="title">Mobile Number</p>
                                                        <p>
                                                            <input style="width: 300px" class="text-center" type="text" name="contact_number" value="{{ $admin->contact_number }}">
                                                            @if($errors->has('contact_number')) <label class="text-danger">{{ $errors->first('contact_number') }}</label> @endif
                                                        </p>
                                                        <p class="title">Address</p>
                                                        <p>
                                                            <textarea class="form-control" rows="4" name="address">{{ $admin->address }}</textarea>@if($errors->has('address')) <label class="text-danger">{{ $errors->first('address') }}</label> @endif
                                                        </p>

                                                    </div>
                                                    <button class="btn btn-primary">Update Profile Information</button>
                                                </form>

                                                <br />
                                                <h5>Upload/Change Photo</h5>
                                                <form class="form" action="{{ route('admin.update', $admin->id) }}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }} {{ method_field('put') }}
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="photo"/>
                                                        <span class="input-group-btn">
                                                              <button type="submit" class="btn btn-primary">Submit</button>
                                                        </span>
                                                    </div>
                                                </form>

                                                <br />
                                                <h5>Change Password</h5>
                                                <form class="form" action="{{ route('admin.change-password', $admin->id) }}" method="post">
                                                    {{ csrf_field() }} {{ method_field('put') }}
                                                    <input class="form-control" type="password" placeholder="Old password" name="old_password"><br/>
                                                    <input class="form-control" type="password" placeholder="New password" name="password"><br/>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation"/>
                                                        <span class="input-group-btn">
                                                              <button type="submit" class="btn btn-primary">Submit</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop