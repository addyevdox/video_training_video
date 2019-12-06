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
                            <a href="#">Survey</a>
                        </li>
                    </ol>
                    <div class="float-right mt-1">
                        <i class="livicon icon3" data-name="pen" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Survey
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
            <div class="col-3"></div>
            <div class="col-6 mb-3">
                <div class="card ">
                    <div class="card-header bg-primary text-white clearfix">
                        <h4 class="card-title float-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                           Survey list
                        </h4>
                    </div>
                    <br />
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                            <div class="tab-pane fade show active p-3">
                                {!! Form::open(array('url' => URL::to('survey/reply'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}

                                    @forelse( $questions as $question)
                                        <h3>{{$question->question}}</h3>
                                        @forelse($question->answer as $answer)
                                            <div class="row ml-3">
                                                <label class="block">
                                                    <input type="radio" name="{{$answer->question_id}}" value="{{$answer->answer}}">
                                                    {{$answer->answer}}
                                                </label>

                                            </div>

                                        @empty
                                            <p>No Answers</p>
                                        @endforelse

                                    @empty
                                        <p>No Questions</p>
                                    @endforelse

                                {!! Form::textarea('comment', null, array('class' => 'form-control input-lg no-resize', 'style'=>'height: 200px', 'placeholder'=>'Your comment')) !!}

                                <br>
                                <input type="submit" class="btn btn-success float-right">
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div><!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
