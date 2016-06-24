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

                <div class="space-6"></div>
                <?php if(old('message')) : ?>
                    <div class="alert alert-<?php echo old('status') ? old('status') : 'danger'; ?> text-center">
                        <?php echo old('message'); ?>
                    </div>
                    <div class="space-6"></div>
                <?php endif; ?>
                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header blue lighter bigger">
                                    Please enter your credentials
                                </h4>

                                <div class="space-6"></div>

                                <form id="login" method="POST" action="{{ url('/login') }}">
                                    {!! csrf_field() !!}
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                 <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">

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
                                                <input type="password" class="form-control" name="password">

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">
                                            <label class="inline">
                                                <input type="checkbox" class="ace" name="remember" />
                                                <span class="lbl"> Remember me</span>
                                            </label>

                                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                <i class="ace-icon fa fa-sign-in"></i>
                                                <span class="bigger-110">Login</span>
                                            </button>
                                        </div>

                                        <div class="space-4"></div>
                                    </fieldset>
                                </form>
                                <div id="footer" class="text-center"><br><hr>
                                    App - VAT
                                </div>
                            </div>
                            <div class="toolbar clearfix">
                                <div>
                                    <a class="forgot-password-link" href="{{ url('/password/reset') }}">
                                        Reset password
                                    </a>
                                </div>

                                <div>
                                    <a class="user-signup-link" href="{{ url('/register') }}">
                                        Sign-up
                                    </a>
                                </div>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.login-box -->
                </div><!-- /.position-relative -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('script')
    <script>
        $(function() {

        });
    </script>
@endsection