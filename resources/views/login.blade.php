<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Login Page</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ url('css/components-all.css') }}" />

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ url('css/ace-fonts.min.css') }}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ url('css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ url('css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="{{ url('css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ url('css/ace-rtl.min.css') }}" />

        <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ url('css/ace-ie.min.css') }}" />
        <![endif]-->

        <link rel="stylesheet" href="{{ url(elixir('css/app.css')) }}" />
    </head>

    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                @yield('content')
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="{{ url('js/components-all.js') }}"></script>
        <!-- <![endif]-->
        <!--[if IE]>
        <script src="{{ url('js/ie-all.js') }}"></script>
        <![endif]-->
        <script src="{{ url('js/it-all.js') }}"></script>
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='../../components/_mod/jquery.mobile.custom/jquery.mobile.custom.js'>"+"<"+"/script>");
        </script>

        <!-- ace scripts -->
        <script src="{{ url('js/ace.min.js') }}"></script>
        <script src="{{ url('js/ace-elements.min.js') }}"></script>

        <?php if (app('env') == 'local'): ?>
            <script src="{{ url('js/custom-all.js') }}"></script>
        <?php else: ?>
            <script src="{{ url(elixir('js/custom-all.js')) }}"></script>
        <?php endif; ?>
        <script>
            $(function() {
                app.baseUrl = "{{ url('/') }}";
                app.init();
            });
        </script>


        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                $(document).on('click', '.toolbar a[data-target]', function(e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible');//hide others
                    $(target).addClass('visible');//show target
                });
            });



            //you don't need this, just used for changing background
            jQuery(function($) {
                $('#btn-login-dark').on('click', function(e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function(e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function(e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');

                    e.preventDefault();
                });

            });
        </script>
        @yield('script')
    </body>
</html>