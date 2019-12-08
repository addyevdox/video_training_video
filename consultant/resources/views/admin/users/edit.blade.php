@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit User
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/pages/wizard.css') }}" rel="stylesheet">
@stop
<!--end of page level css-->


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Edit user</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> Users</a></li>
            <li class="active">Edit User</li>
        </ol>
    </section>
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 my-3">
                <div class="card ">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff"
                               data-loop="true"></i>
                            Editing user : <p class="user_name_max">{!! $user->first_name!!} {!! $user->last_name!!}</p>
                        </h3>
                        <span class="float-right clickable">
                                    <i class="fa fa-chevron-up"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <!--main content-->
                    {!! Form::model($user, ['url' => URL::to('admin/users/'. $user->id.''), 'method' => 'put', 'class' => 'form-horizontal','id'=>'commentForm', 'enctype'=>'multipart/form-data','files'=> true]) !!}
                    {{ csrf_field() }}
                    <!-- CSRF Token -->

                        <input type="hidden" name="activate" value="1">
                        <div id="rootwizard">
                            <ul>
                                <li class="nav-item"><a href="#tab1" data-toggle="tab" class="nav-link">User Profile</a>
                                </li>
                                <li class="nav-item"><a href="#tab2" data-toggle="tab" class="nav-link ml-2">Address and
                                        User Group</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane " id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                        <div class="row">
                                            <label for="first_name" class="col-sm-2 control-label">First Name *</label>
                                            <div class="col-sm-10">
                                                <input id="first_name" name="first_name" type="text"
                                                       placeholder="First Name" class="form-control required"
                                                       value="{!! old('first_name', $user->first_name) !!}"/>

                                                {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                        <div class="row"><label for="last_name" class="col-sm-2 control-label">Last Name
                                                *</label>
                                            <div class="col-sm-10">
                                                <input id="last_name" name="last_name" type="text"
                                                       placeholder="Last Name"
                                                       class="form-control required"
                                                       value="{!! old('last_name', $user->last_name) !!}"/>

                                                {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                        <div class="row">
                                            <label for="email" class="col-sm-2 control-label">User ID *</label>
                                            <div class="col-sm-10">
                                                <input id="email" name="email" placeholder="User ID" type="text"
                                                       class="form-control required email"
                                                       value="{!! old('email', $user->email) !!}"/>
                                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                        <div class="row">
                                            <label for="userid" class="col-sm-2 control-label">Email </label>
                                            <div class="col-sm-10">
                                                <input id="email" name="userid" placeholder="E-mail" type="text"
                                                       class="form-control required email"
                                                       value="{!! old('email', $user->userid) !!}"/>
                                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('password', 'has-error') }}">

                                        <p class="text-warning">If you don't want to change password... please leave
                                            them empty</p>
                                        <div class="row">
                                            <label for="password" class="col-sm-2 control-label">Password *</label>
                                            <div class="col-sm-10">
                                                <input id="password" name="password" type="password"
                                                       placeholder="Password"
                                                       class="form-control required" value="{!! old('password') !!}"/>
                                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                                        <div class="row">
                                            <label for="password_confirm" class="col-sm-2 control-label">Confirm
                                                Password *</label>
                                            <div class="col-sm-10">
                                                <input id="password_confirm" name="password_confirm" type="password"
                                                       placeholder="Confirm Password " class="form-control required"/>
                                                {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" disabled="disabled">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group  {{ $errors->first('dob', 'has-error') }}">
                                        <div class="row">
                                            <label for="address" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-10">
                                                <input id="address" name="address" type="text" class="form-control"
                                                       value="{!! old('dob', $user->address) !!}"
                                                       placeholder="Address"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                                        </div>
                                    </div>


                                    <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                        <div class="row">

                                            <label class="col-sm-2 control-label">Profile picture</label>
                                            <div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                         style="width: 200px; height: 200px;">
                                                        @if($user->pic)
                                                            <img src="{{ $user->pic }}" alt="img"
                                                                 class="img-responsive"/>
                                                        @elseif($user->gender === "male")
                                                            <img src="{{ asset('images/authors/avatar3.png') }}"
                                                                 alt="..."
                                                                 class="img-responsive"/>
                                                        @elseif($user->gender === "female")
                                                            <img src="{{ asset('images/authors/avatar5.png') }}"
                                                                 alt="..."
                                                                 class="img-responsive"/>
                                                        @else
                                                            <img src="{{ asset('images/authors/no_avatar.jpg') }}"
                                                                 alt="..."
                                                                 class="img-responsive"/>
                                                        @endif
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                         style="max-width: 200px; max-height: 200px;"></div>
                                                    <div>
                                                    <span class="btn btn-primary btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                        <input id="pic" name="pic_file" type="file"
                                                               class="form-control"/>
                                                    </span>
                                                        <a href="#" class="btn btn-primary fileinput-exists"
                                                           data-dismiss="fileinput" style="color: black !important;">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('pic_file', ':message') }}</span>
                                        </div>
                                    </div>

                                    <p class="text-danger"><strong>Be careful with group selection, if you give admin
                                            access.. they can access admin section</strong></p>

                                    <div class="form-group required">
                                        <div class="row">
                                            <label for="group" class="col-sm-2 control-label">Group *</label>
                                            <div class="col-sm-10">
                                                <select class="form-control required" title="Select group..."
                                                        name="groups[]"
                                                        id="groups">
                                                    <option value="">Select</option>
                                                    @foreach($roles as $role)
                                                        <option value="{!! $role->id !!}"
                                                                {{ (array_key_exists($role->id, $userRoles) ? ' selected="selected"' : '') }} @if($user->id==1&&$role->id>=2) disabled
                                                                @endif @if($user->id==2 && $role->id!=2) disabled @endif>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <span class="help-block">{{ $errors->first('group', ':message') }}</span>
                                    </div>

                                </div>
                                <ul class="pager wizard">
                                    <li class="previous"><a href="#">Previous</a></li>
                                    <li class="next"><a href="#">Next</a></li>
                                    <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                </ul>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('vendors/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/pages/edituser.js') }}"></script>
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span><img src="{{asset('img/countries_flags')}}/' + state.element.value.toLowerCase() + '.png" class="img-flag" width="20px" height="20px" /> ' + state.text + '</span>'
            );
            return $state;

        }

        $(".country_field").select2({
            templateResult: formatState,
            templateSelection: formatState,
            placeholder: "select a country",
            theme: "bootstrap"
        });

    </script>
@stop
