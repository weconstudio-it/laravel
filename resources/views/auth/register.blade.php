@extends('login')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
                <div class="center">
                    <h1>
                        <span class="_red">Registration</span>
                    </h1>
                </div>

                <div class="position-relative">
                    <div id="signup-box" class="signup-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header green lighter bigger">
                                    Registration form
                                </h4>

                                <div class="space-6"></div>
                                <p> Enter your details to begin: </p>

                                <form role="form" action="{{ url('/register') }}" method="post">
                                    {!! csrf_field() !!}
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}"/>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}"/>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}"/>
                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password" class="form-control" placeholder="Password"/>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-key"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password"/>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-key"></i>
                                            </span>
                                        </label>

                                        <label class="block">
                                            <input type="checkbox" name="agree" class="ace"/>
                                            <span class="lbl">
                                                I accept the
                                                <a href="#">User Agreement</a>
                                                @if ($errors->has('agree'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('agree') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>

                                        <div class="space-24"></div>

                                        <div class="clearfix">
                                            <button type="submit" class="width-100 pull-right btn btn-sm btn-success">
                                                <span class="bigger-110">Register</span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="toolbar center">
                                <a href="{{ url('/login') }}" class="back-to-login-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Back to login
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.signup-box -->
                </div>
            </div>
        </div>
    </div>
@endsection
