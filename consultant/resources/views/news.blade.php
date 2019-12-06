@extends('layouts/default')

{{-- Page title --}}
@section('title')
    News
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/news.css') }}">
    <link href="{{ asset('vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />

    <link href="{{ asset('vendors/owl_carousel/css/owl.carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendors/owl_carousel/css/owl.theme.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendors/owl_carousel/css/owl.transitions.css') }}" rel="stylesheet" type="text/css">


    <style>
        .news-body .media {
            padding-bottom: 10px;
            border-bottom: 1px solid #ececec;
        }

        .news-body .media-object {
            height: 95px;
            width: 95px;
        }

        .lifestyle img {
            max-height: 100%;
            max-width: 100%;
        }



        .newsticker {
            height: 350px !important;
        }

        #carousel img {
            height: 150px;
            width: 100%;
        }

        .owl-pagination {
            display: none;
        }

        .slider-content {
            height: 65px;
            overflow: hidden;
        }

        .height_180 {
            height: 180px;
            width: 100%;
        }

        .sports-content {
            height: 120px;
            overflow: hidden;
        }

        .sports-height {
            height: 200px;
            overflow: hidden;
        }

        .mt-20 {
            margin-top: 20px;
        }

        p a {
            color: #418bca !important;
        }

        .tabbable-line > .nav-tabs > li{
            background-color: transparent !important;
        }

       .news .tabbable-line > .nav-tabs .nav-link.active {
            border-bottom: 4px solid #f3565d !important;
        }

    </style>
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <div class="row">
                <div class="col-12">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="d-none d-lg-block d-sm-block d-md-block">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">News</a>
                </li>
            </ol>
            <div class="float-right">
                <i class="livicon icon3" data-name="responsive-menu" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> News
            </div>
        </div>
    </div>
        </div>
    </div>
@stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="container news mt-4">
        <div class="row news">
            <div class="col-md-12">
                <div class="row">
                    @if( $popular->count() != 0)
                    <div class="col-sm-6 news-body">
                        <div class="text-left">
                            <div>
                                <h4><span class="heading_border bg-warning">Popular News</span>
                                </h4>
                            </div>
                        </div>
                        @foreach($popular as $item)
                            <div class="media my-2">
                                <div class="media-left">
                                    <a href="{{ route('news.show',$item->id) }}">
                                        <img class="media-object mr-3" src="{{ URL::to('/uploads/news/'.$item->image)  }}"
                                             alt="image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                    <a href="{{ route('news.show',$item->id) }}">
                                        <h5 class="media-heading ">{{ $item->title }}</h5>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    @endif
                    @if( $hotnews->count() != 0)
                    <div class="col-sm-6 news-body">
                        <div class="text-left">
                            <div>
                                <h4><span class="heading_border bg-success">Hot News</span></h4>
                            </div>
                        </div>
                        @foreach($hotnews as $item)
                            <div class="media my-2">
                                <div class="media-left">
                                    <a href="{{ route('news.show',$item->id) }}">
                                        <img class="media-object mr-3" src="{{ URL::to('/uploads/news/'.$item->image)  }}"
                                             alt="image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                    <a href="{{ route('news.show',$item->id) }}">
                                        <h5 class="media-heading ">{{ $item->title }}</h5>
                                    </a>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    @endif
                        @if($lifestyle->count() !=0 )


                    <div class="col-sm-12  mt-20">
                        <div class="text-left">
                            <div>
                                <h4><span class="heading_border bg-danger">Life Style</span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 lifestyle">
                            <img class="img-fluid mr-3"
                                 src="{{ URL::to('/uploads/news/'.$lifestyle->first()['image']) }}" alt="image">
                            <div class="sports-height">
                                <a href="{{ route('news.show',$lifestyle->first()['id']) }}">
                                    <h4>{{ $lifestyle->first()['title'] }}</h4>
                                </a>
                                <span class="text-danger">{!! date('d-m-Y', strtotime($lifestyle->first()['created_at'])) !!}</span>
                                <p>{!!  $lifestyle->first()['content']  !!}</p>

                            </div>
                    </div>
                    <div class="col-sm-6 news-body">
                        <ul class="newsticker">
                            @foreach( $lifestyle as $item)
                                <li>
                                    <div class="media my-2">
                                        <div class="media-left">
                                            <a href="{{ route('news.show',$item->id) }}">
                                                <img class="media-object mr-3"
                                                     src="{{ URL::to('/uploads/news/'.$item->image)  }}" alt="image">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                            <a href="{{ route('news.show', $item->id) }}">
                                                <h5 class="media-heading ">{{ $item->title }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                        @endif

                        @if($world_news->count() !=0)
                            <div class="col-sm-12 mt-20">
                            <div class="text-left">
                                <div>
                                    <h4 class="border-primary"><span class="heading_border bg-primary">World News</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                            <div class="col-sm-12 worlnews">
                            <div class="owl-carousel owl-theme" id="carousel">
                                @foreach($world_carousel as $item)
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="{{ URL::to('/uploads/news/'.$item->image)  }}" alt="image">
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                                <a href="{{ route('news.show', $item->id) }}">
                                                    <h5 class="media-heading ">{{ $item->title }}</h5>
                                                </a>
                                                <div class="slider-content">
                                                    <p>{!! $item->content  !!} </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                @foreach($world_news as $item)
                                    <div class="col-sm-6 news-body">
                                        <div class="media my-2">
                                            <div class="media-left">
                                                <a href="{{ route('news.show',$item->id) }}">
                                                    <img class="media-object mr-3"
                                                         src="{{ URL::to('/uploads/news/'.$item->image)  }}"
                                                         alt="image">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                                <a href="{{ route('news.show', $item->id) }}">
                                                    <h5 class="media-heading ">{{ $item->title }}</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        @endif

                    @if($business->count() !=0)
                        <div class="col-sm-6 news-body mt-20">
                            <h4><span class="heading_border bg-danger">Business News</span></h4>
                            <a href="{{route('news.show', $business->first()['id'])  }}">
                                <img class="img-fluid height_180"
                                     src="{{ URL::to('/uploads/news/'.$business->first()['image'])  }}" alt="image"/>
                            </a>
                            <div class="sports-height">
                                <a href="{{ route('news.show', $business->first()['id']) }}">
                                    <h4>{{ $business->first()['title'] }}</h4>
                                </a>

                                <span class="text-danger">{!! date('d-m-Y', strtotime($business->first()['created_at'])) !!}</span>
                                <div class="sports-content">
                                    <p> {!! $business->first()['content'] !!}</p>
                                </div>
                            </div>
                            @foreach( $business as $item)
                                <div class="media my-2">
                                    <div class="media-left">
                                        <a href="{{ route('news.show',$item->id) }}">
                                            <img class="media-object mr-3"
                                                 src="{{ URL::to('/uploads/news/'.$item->image)  }}"
                                                 alt="image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                        <a href="{{ route('news.show',$item->id) }}">
                                            <h5 class="media-heading">{{ $item->title }}</h5>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                    @if($sports->count() !=0)
                        <div class="col-sm-6 news-body  mt-20">

                        <div class="text-left">
                            <div>
                                <h4><span class="heading_border bg-success">Sports NEWS</span>
                                </h4>
                            </div>
                        </div>
                        <a href="{{ route('news.show',$sports->first()['id']) }}">
                            <img class="img-fluid height_180"
                                 src="{{ URL::to('/uploads/news/'.$sports->first()['image'])  }}" alt="image">

                        </a>
                        <div class="sports-height">
                            <a href="{{ route('news.show',$item->id) }}">
                                <h4>{{ $sports->first()['title'] }}</h4>
                            </a>
                            <span class="text-danger">{!! date('d-m-Y', strtotime($sports->first()['created_at'])) !!}</span>
                            <div class="sports-content">
                                <p> {!! $sports->first()['content'] !!}</p>
                            </div>
                        </div>
                        @foreach( $sports as $item)
                            <div class="media my-2">
                                <div class="media-left">
                                    <a href="{{ route('news.show',$item->id) }}">
                                        <img class="media-object mr-3" src="{{ URL::to('/uploads/news/'.$item->image)  }}"
                                             alt="image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <span class="text-danger">{!! date('d-m-Y', strtotime($item->created_at)) !!}</span>
                                    <a href="{{ route('news.show',$item->id) }}">
                                        <h5 class="media-heading">{{ $item->title }}</h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @endif
                </div>

            </div>
            {{--<div class="col-md-4 ">--}}
                {{--<!-- Tabbable-Panel Start -->--}}
                {{--<div class="tabbable-panel">--}}
                    {{--<!-- Tabbablw-line Start -->--}}
                    {{--<div class="tabbable-line">--}}
                        {{--<!-- Nav Nav-tabs Start -->--}}
                        {{--<ul class="nav nav-tabs ">--}}
                            {{--<li class=" nav-item ">--}}
                                {{--<a href="#tab_default_1" data-toggle="tab" class="nav-link active">--}}
                                    {{--Popular </a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a href="#tab_default_2" data-toggle="tab" class="nav-link">--}}
                                    {{--Recent </a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<hr class="horizontalline">--}}
                        {{--<!-- //Nav Nav-tabs End -->--}}
                        {{--<!-- Tab-content Start -->--}}
                        {{--<div class="tab-content">--}}
                            {{--<div class="tab-pane active" id="tab_default_1">--}}
                                {{--<div class="media">--}}
                                    {{--<div class="media-left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="media-object mr-3" src="{{ asset('images/image_13.jpg') }}" alt="image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--<h5 class="media-heading ">Efficiently unleash cross-media information--}}
                                                {{--without cross-media value.</h5></a><span class="text-danger">May 10, 2015</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="media">--}}
                                    {{--<div class="media-left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="media-object mr-3" src="{{ asset('images/image_14.jpg') }}" alt="image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--<h5 class="media-heading ">Efficiently unleash cross-media information--}}
                                                {{--without cross-media value.</h5></a><span--}}
                                                {{--class="text-danger">May 8, 2015</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="media">--}}
                                    {{--<div class="media-left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="media-object mr-3" src="{{ asset('images/image_15.jpg') }}" alt="image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--<h5 class="media-heading ">Efficiently unleash cross-media information--}}
                                                {{--without cross-media value.</h5></a><span--}}
                                                {{--class="text-danger">May5, 2015</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="tab-pane" id="tab_default_2">--}}
                                {{--<div class="media">--}}
                                    {{--<div class="media-left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="media-object mr-3" src="{{ asset('images/image_15.jpg') }}" alt="image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--<h5 class="media-heading ">Efficiently unleash cross-media information--}}
                                                {{--without cross-media value.</h5></a><span class="text-danger">May 13, 2015</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="media">--}}
                                    {{--<div class="media-left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="media-object mr-3" src="{{ asset('images/image_13.jpg') }}" alt="image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--<h5 class="media-heading ">Efficiently unleash cross-media information--}}
                                                {{--without cross-media value.</h5></a><span class="text-danger">May 12, 2015</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="media">--}}
                                    {{--<div class="media-left">--}}
                                        {{--<a href="#">--}}
                                            {{--<img class="media-object mr-3" src="{{ asset('images/image_14.jpg') }}" alt="image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--<h5 class="media-heading ">Efficiently unleash cross-media information--}}
                                                {{--without cross-media value.</h5></a>--}}
                                        {{--<span class="text-danger">Feb 28, 2015</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="comments">--}}
                    {{--<h3>Comments</h3>--}}
                    {{--<div class="media">--}}
                        {{--<div class="media-left">--}}
                            {{--<a href="#">--}}
                                {{--<img class="media-object mr-3" src="{{ asset('images/image_13.jpg') }}" alt="image">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="media-body">--}}
                            {{--<a href="#">--}}
                                {{--<h5 class="media-heading ">Efficiently unleash cross-media information without--}}
                                    {{--cross-media value.</h5></a>--}}
                            {{--<span class="text-danger">Feb 28, 2015</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="media">--}}
                        {{--<div class="media-left">--}}
                            {{--<a href="#">--}}
                                {{--<img class="media-object mr-3" src="{{ asset('images/image_14.jpg') }}" alt="image">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="media-body">--}}
                            {{--<a href="#">--}}
                                {{--<h5 class="media-heading ">Efficiently unleash cross-media information without--}}
                                    {{--cross-media value.</h5></a><span class="text-danger">May 11, 2015</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="media">--}}
                        {{--<div class="media-left">--}}
                            {{--<a href="#">--}}
                                {{--<img class="media-object mr-3" src="{{ asset('images/image_15.jpg') }}" alt="image">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="media-body">--}}
                            {{--<a href="#">--}}
                                {{--<h5 class="media-heading ">Efficiently unleash cross-media information without--}}
                                    {{--cross-media value.</h5></a><span class="text-danger">Feb 28, 2015</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- Tab-content End -->
        </div>
        <!-- //Tabbablw-line End -->
    </div>
    <!-- Tabbable_panel End -->

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- begining of page level js -->
    <!--tags-->
    <script src="{{ asset('vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('vendors/jquery_newsTicker/js/jquery.newsTicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/owl_carousel/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script>

        $('.newsticker').newsTicker({
            direction: 'down',
            row_height: 85,
            max_rows: 3,
            duration: 2000
        });
        var owl = $('#carousel');
        owl.owlCarousel({
            autoPlay: 2000, //Set AutoPlay to 3 seconds
            items: 1,
            loop: true,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],

        });


    </script>
    <!-- end of page level js -->

@stop
