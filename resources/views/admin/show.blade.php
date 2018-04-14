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
                            <h2>New Partner Contracts Consultancy</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Under construction</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Under construction</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Under construction</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <p>Under construction</p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                            <p>Under construction</p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                            <p>Under construction</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- start project-detail sidebar -->
                            <div class="col-md-3 col-sm-3 col-xs-12">

                                <section class="panel">

                                    <div class="x_title">
                                        <h2>User Information</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class="green">
                                            {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->first_name }} {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->middle_name }} {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->last_name }}
                                        </h3>

                                        {{--<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>--}}
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Code</p>
                                            <p>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->code }}</p>
                                            <p class="title">Username</p>
                                            <p>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->username }}</p>
                                            <p class="title">Position</p>
                                            <p>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->position }}</p>
                                            <p class="title">Email</p>
                                            <p>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->email }}</p>
                                            <p class="title">Contact Number</p>
                                            <p>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->contact_number }}</p>
                                            <p class="title">Address</p>
                                            <p>{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->address }}</p>
                                        </div>

                                        <br />
                                        <h5>Upload/Change Photo</h5>
                                        <form class="form" action="{{ route('admin.update', \Illuminate\Support\Facades\Auth::guard('admin')->user()->id) }}" method="post" enctype="multipart/form-data">
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
                                        <form class="form" action="{{ route('admin.change-password', \Illuminate\Support\Facades\Auth::guard('admin')->user()->id) }}" method="post">
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

                                </section>

                            </div>
                            <!-- end project-detail sidebar -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop