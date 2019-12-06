@extends('layouts/default')

{{-- Page title --}}
@section('title')
    consultation
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/features.css') }}">
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                            </a>
                        </li>
                        <li class="d-none d-sm-block ">
                            <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                            <a href="#">Video List</a>
                        </li>
                    </ol>
                    <div class="float-right mt-1">
                        <i class="livicon icon3" data-name="pen" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Video
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


{{-- Page content --}}
@section('content')
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white clearfix">
                        <h4 class="card-title float-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            @lang('blog/title.bloglist')
                        </h4>
                    </div>
                    <br />
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                            <div class="tab-pane fade show active p-3">
                                <div class="row">

                                    @forelse( $videos as $video)
                                    <div class="col-4 row">

                                            <div class="col-6">
                                                <a class="fancybox-effects-a"
                                                   href="{{ asset('uploads/videos/'.$video->video) }}"
                                                   title="Click aside to exit popup">
                                                    <video class="img-fluid gallery-style" controls>
                                                        <source src="{{ asset('uploads/videos/'.$video->video) }}" >
                                                    </video>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <h4>{{$video->title}}</h4>
                                                <p>
                                                    {{$video->description}}
                                                </p>
                                                <a href="{{URL::to('survey/' . $video->id)}}" class="btn btn-success">Finish</a>
                                            </div>

                                    </div>
                                    @empty
                                        <h3>No Posts Exists!</h3>
                                    @endforelse

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
