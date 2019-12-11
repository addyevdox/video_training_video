<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
        @section('title')
        | Welcome to Josh Frontend
        @show
    </title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <style>
      .dropdown-item:active{
            background-color: transparent !important;
        }
      .indexpage.navbar-nav >.nav-item .nav-link:hover {
          color: #01bc8c;
      }
    </style>
    <!--end of global css-
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body>
<!-- Header Start -->
<header>
    <!--Icon Section Start-->
    <div class="container indexpage">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/consultant_logo.png') }}"
                                                                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto  margin_right">
                    <li class=" nav-item dropdown  {!! (Request::is('/')? 'active' : '') !!}">
                        <a href="{{ URL::to('/') }}" aria-expanded="false" class="nav-link"> Video</a>
                    </li>

                    {{--based on anyone login or not display menu items--}}
                    @if(Sentinel::guest())
                    <li class="nav-item"><a href="{{ URL::to('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item"><a href="{{ URL::to('register') }}" class="nav-link">Register</a>
                    </li>
                    @else
                    <li class="nav-item {{ (Request::is('my-account') ? 'active' : '') }}"><a href="{{ URL::to('my-account') }}" class="nav-link">My
                        Account</a>
                    </li>
                    <li class="nav-item"><a href="{{ URL::to('logout') }}" class="nav-link">Logout</a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Nav bar End -->
    </div>
</header>

<!-- //Header End -->

<!-- slider / breadcrumbs section -->
@yield('top')
<div id="notific">
    @include('notifications')
</div>
<!-- Content -->
@yield('content')

<!-- Footer Section Start -->
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-original-title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>



<!--global js starts-->
<script type="text/javascript" src="{{ asset('js/frontend/lib.js') }}"></script>
<!--global js end-->
<!-- begin page level js -->
@yield('footer_scripts')
<!-- end page level js -->
<script>
    $(".navbar-toggler-icon").click(function () {
        $(this).closest('.navbar').find('.collapse').toggleClass('collapse1')
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip().css('font-size', '14px');
    })
</script>
</body>

</html>
