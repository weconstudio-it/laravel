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
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header green lighter bigger text-center">
                                    Congratulations
                                </h4>

                                <div class="space-6"></div>
                                <p>
                                    You receive an email to confirm your account.
                                </p>
                                <div class="clearfix">
                                    <a href="{{ url('/login') }}" class="width-100 pull-right btn btn-sm btn-success">
                                        <span class="bigger-110">
                                            <i class="fa fa-arrow-left"></i>
                                            Back to login
                                        </span>
                                    </a>
                                </div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.forgot-box -->
                </div>
            </div>
        </div>
    </div>
@endsection