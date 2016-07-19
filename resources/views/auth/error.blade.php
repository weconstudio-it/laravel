@extends('login')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
                <div class="center">
                    <h1>
                        <span class="_red">Error</span>
                    </h1>
                </div>
                <div class="position-relative">
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="alert alert-danger text-center">
                                Something was wrong!<br>
                                <?php if(old('message')) : ?>
                                    <?php echo old('message'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="clearfix">
                                <a href="{{ url('/login') }}" class="width-100 pull-right btn btn-sm btn-primary">
                            <span class="bigger-110">
                                <i class="fa fa-arrow-left"></i>
                                Back to login
                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection