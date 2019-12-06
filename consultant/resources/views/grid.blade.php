@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Grid
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/features.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/panel.css') }}">
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
                            <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home"
                                                              data-size="18" data-loop="true" data-c="#3d3d3d"
                                                              data-hc="#3d3d3d"></i>Dashboard
                            </a>
                        </li>
                        <li class="d-none d-sm-block">
                            <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                               data-c="#01bc8c" data-hc="#01bc8c"></i>
                            <a href="#">Grid</a>
                        </li>
                    </ol>
                    <div class="float-right mt-1">
                        <i class="livicon icon3" data-name="responsive-menu" data-size="20" data-loop="true"
                           data-c="#3d3d3d" data-hc="#3d3d3d"></i> Grid System
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="container my-3">
        <!-- Grid Section Start -->
        <h2 class="ml-4">Grid System</h2>
        <div class="row">
            <div class="col-12">
                <form class="grid">
                    <div class="form-group row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1 form_padding">
                            <input class="form-control" placeholder=".col-lg-1" type="text">
                        </div>
                        <!-- /.col-lg-1 -->
                        <div class="col-lg-11 col-md-11 col-sm-11 col-11">
                            <input class="form-control" placeholder=".col-lg-11" type="text">
                        </div>
                        <!-- /.col-lg-11 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                            <input class="form-control" placeholder=".col-lg-2" type="text">
                        </div>
                        <!-- /.col-lg-2 -->
                        <div class="col-lg-10 col-md-10 col-sm-10 col-10">
                            <input class="form-control" placeholder=".col-lg-10" type="text">
                        </div>
                        <!-- /.col-lg-10 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <input class="form-control" placeholder=".col-lg-3" type="text">
                        </div>
                        <!-- /.col-lg-3 -->
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                            <input class="form-control" placeholder=".col-lg-9" type="text">
                        </div>
                        <!-- /.col-lg-9 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <input class="form-control" placeholder=".col-lg-4" type="text">
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                            <input class="form-control" placeholder=".col-lg-8" type="text">
                        </div>
                        <!-- /.col-lg-8 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                            <input class="form-control" placeholder=".col-lg-5" type="text">
                        </div>
                        <!-- /.col-lg-5 -->
                        <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                            <input class="form-control" placeholder=".col-lg-7" type="text">
                        </div>
                        <!-- /.col-lg-7 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <input class="form-control" placeholder=".col-lg-6" type="text">
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <input class="form-control" placeholder=".col-lg-6" type="text">
                        </div>

                        <!-- /.col-lg-6 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <input class="form-control" placeholder=".col-lg-4" type="text">
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <input class="form-control" placeholder=".col-lg-4" type="text">
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <input class="form-control" placeholder=".col-lg-4" type="text">
                        </div>
                        <!-- /.col-lg-4 -->
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <input class="form-control" placeholder=".col-lg-3" type="text">
                        </div>
                        <!-- /.col-lg-3 -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <input class="form-control" placeholder=".col-lg-4" type="text">
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                            <input class="form-control" placeholder=".col-lg-5" type="text">
                        </div>
                        <!-- /.col-lg-5 -->
                    </div>
                </form>
            </div>
        </div>
        <!-- //Grid Section End -->
        <!-- Bootstrap Grid Section Start -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 col-sm-12 my-3 ">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title ">
                            <i class="livicon" data-name="star-half" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Bootstrap grid Examples
                        </h3>
                    </div>
                    <div class="card-body" id="slim1">
                        <p>
                            we created some grid samples now you can examine in your browser. This first grid is using
                            all 4 grid sizes combined in a single row. second grid indicates Grid,Third grid indicates
                            sm Grid,fourth grid indicates md,fifth grid indicates lg.
                        </p>
                        <div class="card-header">
                            <p class="d-none d-lg-inline-block">
                                lg indicates that the large grid displaying. The grid stacks horizontally &lt; 1200px.
                            </p>
                            <p class="d-none d-md-inline-block d-lg-inline-block">
                                md indicates that the medium grid displaying. The grid stacks horizontally &lt; 992px.
                            </p>
                            <p class="d-none d-sm-inline-block d-md-none d-lg-none">
                                sm indicates that the small grid displaying. The grid stacks horizontally &lt; 768px.
                            </p>
                            <!--<p class="visible-xs">-->
                            <!--xs indicates that the extra small grid displaying. This grid is always horizontal.-->
                            <!--</p>-->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-1 col-sm-2 col-5 text-center bar-primary lg-grid">
                                <span class="d-none d-sm-none d-md-none  d-lg-block">.col-lg-4</span>
                                <span class="d-none d-sm-none d-lg-none d-md-block">.col-md-1</span>
                                <span class="d-none d-lg-none d-md-none d-sm-block">.col-sm-2</span>
                                <span class="d-lg-none d-sm-none d-block d-md-none">.col-5</span>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-4 col-4 text-center bar-success lg-grid">
                                <span class="d-none d-sm-none d-md-none  d-lg-block">.col-lg-4</span>
                                <span class="d-none d-sm-none d-lg-none d-md-block">.col-md-5</span>
                                <span class="d-none d-lg-none d-md-none d-sm-block">.col-sm-4</span>
                                <span class="d-lg-none d-sm-none d-block d-md-none">.col-4</span>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-3 text-center bar-danger lg-grid">
                                <span class="d-none d-sm-none d-md-none  d-lg-block">.col-lg-4</span>
                                <span class="d-none d-sm-none d-lg-none d-md-block">.col-md-6</span>
                                <span class="d-none d-lg-none d-md-none d-sm-block">.col-sm-6</span>
                                <span class="d-lg-none d-sm-none d-block d-md-none">.col-6</span>
                            </div>
                        </div>
                        <h3> Grid</h3>
                        <div class="row">
                            <div class="col-5  bar-primary text-center">
                                <span>.col-5</span>
                            </div>
                            <div class="col-4  bar-success text-center">
                                <span>.col-4</span>
                            </div>
                            <div class="col-3  bar-danger text-center">
                                <span>.col-3</span>
                            </div>
                        </div>
                        <!-- end row -->
                        <h3>sm Grid</h3>
                        <div class="row">

                            <div class="col-sm-2  bar-primary text-center">
                                <span>.col-sm-2</span>
                            </div>
                            <div class="col-sm-4  bar-success text-center">
                                <span>.col-sm-4</span>
                            </div>
                            <div class="col-sm-6 text-center  bar-danger">
                                <span>.col-sm-6</span>
                            </div>
                        </div>
                        <!-- end row -->
                        <h3 class="sub">md Grid</h3>
                        <div class="row">
                            <div class="col-md-1  bar-primary text-center">
                                <span>.col-md-1</span>
                            </div>
                            <div class="col-md-5  bar-success text-center">
                                <span>.col-md-5</span>
                            </div>
                            <div class="col-md-6  bar-danger text-center">
                                <span>.col-md-6</span>
                            </div>
                        </div>
                        <!-- end row -->
                        <h3>lg Grid</h3>
                        <div class="row">
                            <div class="col-lg-4 bar-primary text-center">
                                <span>.col-lg-4</span>
                            </div>
                            <div class="col-lg-4  bar-success  text-center">
                                <span>.col-lg-4</span>
                            </div>
                            <div class="col-lg-4  bar-danger text-center">
                                <span>.col-lg-4</span>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- //Bootstrap Grid Section End -->
    </div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
