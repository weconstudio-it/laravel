<?php
use \Weconstudio\Misc\U;
?>
@extends('login')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
                <div class="center">
                    <h1>
                        <span class="_red">App Platform</span>
                    </h1>
                </div>

                <div class="position-relative">
                    <div id="login-box" class="signup-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header blue lighter bigger">
                                    Reset password
                                </h4>

                                <div class="space-6"></div>

                                <form id="login" method="POST" action="{{ url('/password/reset') }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                 <input type="text" class="form-control" name="email" id="email" value="{{ $email or old('email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>

                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="form-control" name="password">

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                        </label>

                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="form-control" name="password_confirmation">

                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">
                                            <button type="submit" class="width-100 pull-right btn btn-sm btn-primary">
                                                <i class="ace-icon fa fa-refresh"></i>
                                                <span class="bigger-110">Submit</span>
                                            </button>
                                        </div>

                                        <div class="space-4"></div>
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
                    </div><!-- /.login-box -->
                </div><!-- /.position-relative -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
