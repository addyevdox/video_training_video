@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Training
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
                        <li class="d-none d-sm-block ">
                            <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            <a href="#">Training</a>
                        </li>
                    </ol>
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
                            Training
                        </h4>
                    </div>
                    <br />
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                            <div class="tab-pane fade show active p-3">
                                <div class="row">
                                    <div class="col-6">

                                        <video class="img-fluid gallery-style" id="video" controls>
                                                        <source src="{{ asset('consultant/public/uploads/videos/'.$video->video) }}" >
                                        </video>

                                    </div>
                                    <div class="col-6">
                                        <h4>{{$video->title}}</h4>
                                        <p>
                                            {{$video->description}}
                                        </p>
                                    </div>


                                </div>


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


    <script>

        $("#video").bind('ended', function () {
            window.location.href = "{{URL::to('survey/' . $video->id)}}";
        });


    </script>

@stop
