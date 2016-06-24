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
                <div class="alert alert-danger text-center">
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
                                    <a class="forgot-password-link" data-target="#forgot-box" href="#">
                                        Reset password
                                    </a>
                                </div>

                                <div>
                                    <a class="user-signup-link" data-target="#signup-box" href="#">
                                        Sign-up
                                    </a>
                                </div>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.login-box -->

                    <div id="forgot-box" class="forgot-box widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header red lighter bigger">
                                    Reset Password
                                </h4>

                                <div class="space-6"></div>
                                <p>
                                    Enter the email used during registration process:
                                </p>

                                <form>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" class="form-control" placeholder="Email" />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <small>An e-mail containing a 'reset password' link will be forwarder to you.</small>
                                        <div class="clearfix">
                                            <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                <i class="ace-icon fa fa-lightbulb-o"></i>
                                                <span class="bigger-110">Submit</span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!-- /.widget-main -->

                            <div class="toolbar center">
                                <a href="#" data-target="#login-box" class="back-to-login-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Back to login
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.forgot-box -->

                    <div id="signup-box" class="signup-box widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header green lighter bigger">
                                    Registration form
                                </h4>

                                <div class="space-6"></div>
                                <p> Enter your details to begin: </p>

                                <form>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="name" class="form-control" placeholder="Name" />
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" name="email" class="form-control" placeholder="E-mail" />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="username" class="form-control" placeholder="Username" />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password" class="form-control" placeholder="Password" />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="password_confirmation" class="form-control" placeholder="Repeat password" />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>

                                        <label class="block">
                                            <input type="checkbox" class="ace" />
                                                <span class="lbl">
                                                    I accept the
                                                    <a href="#">User Agreement</a>
                                                </span>
                                        </label>

                                        <div class="space-24"></div>

                                        <div class="clearfix">
                                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                                <i class="ace-icon fa fa-refresh"></i>
                                                <span class="bigger-110">Reset</span>
                                            </button>

                                            <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                                <span class="bigger-110">Register</span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="toolbar center">
                                <a href="#" data-target="#login-box" class="back-to-login-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Back to login
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.signup-box -->
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