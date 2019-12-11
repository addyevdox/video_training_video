@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('blog/title.bloglist')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}" />
    <link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>@lang('blog/title.bloglist')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li><a href="#">@lang('blog/title.blog')</a></li>
        <li class="active">@lang('blog/title.bloglist')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content pr-3 pl-3">
    <div class="row">
        <div class="col-12">
        <div class="card ">
            <div class="card-header bg-primary text-white clearfix">
                <h4 class="card-title float-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    @lang('blog/title.bloglist')
                </h4>
                <div class="float-right">
                    <a href="{{ URL::to('admin/video/create') }}" class="btn btn-sm btn-light"><span class="fa fa-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="card-body">
                <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                    <div class="tab-pane fade show active p-3">
                        <div class="row">
                        @forelse($videos as $video)

                            <div class="bg-info col-lg-3 col-md-3 col-6 col-sm-3 p-2 mr-2 mb-2">
                                <div>
                                    <h4 class="card-title float-left">{{$video->title}}</h4>
                                    <a href="{{ route('admin.survey.question', $video->id) }}"  data-id="{{$video->id }}" class="btn btn-add btn-success float-right">Answers</a>
                                    <a href="{{ route('survey.export', $video->id) }}"  data-id="{{$video->id }}" class="btn btn-add btn-success float-right mr-1">Export</a>
                                </div>

                                <video class="img-fluid gallery-style" controls>
                                        <source src="{{ asset('consultant/public/uploads/videos/'.$video->video) }}" >
                                </video>

                                <div class="">
                                    <div class="float-left">
                                        {{html_entity_decode($video->description, ENT_HTML5)}}
                                    </div>
                                    <div class="float-right">
                                            <a href="{{ URL::to('admin/video/' . $video->id . '/edit')}}" class="btn btn-add btn-default">Edit</a>
                                            <a href="{{ route('admin.video.confirm-delete', $video->id) }}" data-toggle="modal" data-id="{{$video->id }}"
                                               data-target="#delete_confirm" class="btn btn-add btn-danger">Delete</a>

                                    </div>

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
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete Video</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this video? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <a  type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
var $url_path = '{!! url('/') !!}';
$('#delete_confirm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var $recipient = button.data('id');
    var modal = $(this)
    modal.find('.modal-footer a').prop("href",$url_path+"/admin/video/"+$recipient+"/delete");
})
</script>
@stop
