@extends('login')

<!-- Main Content -->
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
                    <div id="forgot-box" class="forgot-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header red lighter bigger">
                                    Reset Password
                                </h4>

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                    <div class="space-6"></div>
                                @endif

                                <p>
                                    Enter the email used during registration process:
                                </p>

                                <form role="form" action="{{ url('/password/email') }}" method="post">
                                    {!! csrf_field() !!}
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" name="email" class="form-control" placeholder="Email" />
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <small>An e-mail containing a 'reset password' link will be forwarder to you.</small>
                                        <br>
                                        <br>
                                        <div class="clearfix">
                                            <button type="submit" class="width-100 pull-right btn btn-sm btn-danger">
                                                <i class="ace-icon fa fa-lightbulb-o"></i>
                                                <span class="bigger-110">Submit</span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!-- /.widget-main -->

                            <div class="toolbar center">
                                <a href="{{ url('/login') }}" class="back-to-login-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Back to login
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.forgot-box -->
                </div><!-- /.position-relative -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
