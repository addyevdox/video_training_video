@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Questions
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}" />
    <style>
        table#table.dataTable tbody tr:hover {
            background-color: #b5d0ff;
        }
    </style>
    <link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>QuestionsList</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li><a href="#">Question</a></li>
            <li class="active">Questions list</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white clearfix">
                        <h4 class="card-title float-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Question list
                        </h4>
                        <div class="float-right">
                          <a  href="#add" data-toggle="modal"  data-target="#add" class="btn btn-sm btn-light"><span class="fa fa-plus"></span> Add New Question</a>
                        </div>
                    </div>
                    <br />
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr class="filters">
                                    <th>Id</th>
                                    <th>Questions</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($questions))
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>{{ $question->id }}</td>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $question->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="#edit_confirm" data-toggle="modal" data-id="{{$question->id}}" data-target="#edit_confirm"> <i class="livicon"
                                                                           data-name="edit"
                                                                           data-size="18"
                                                                           data-loop="true"
                                                                           data-c="#428BCA"
                                                                           data-hc="#428BCA"
                                                                           title="@lang('blog/table.update-blog')"></i></a>
                                                <a href="#delete_confirm" data-toggle="modal" data-id="{{$question->id }}"
                                                   data-target="#delete_confirm"><i class="livicon" data-name="remove-alt"
                                                                                    data-size="18" data-loop="true" data-c="#f56954"
                                                                                    data-hc="#f56954"
                                                                                    title="@lang('blog/table.delete-blog')"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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
            $data_table =$('#table').DataTable();

            var $url_path = '{!! url('/') !!}';

            $data_table.on('click','tr',function() {

                var data = $data_table.row( this ).data();
                window.location.href = $url_path + "/admin/answer/" + data[0];
            });
        });

    </script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Delete Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this question? This operation is irreversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <a  href="" type="button" class="btn btn-danger Remove_square">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade" id="add" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Add Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url' => URL::to('admin/question/store'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
                        <input type="hidden" name="video_id" value="{{$id}}">
                        <div class="form-group {{ $errors->first('question', 'has-error') }}">
                            {!! Form::text('question', null, array('class' => 'form-control input-lg','placeholder'=> 'Please enter Question')) !!}
                            <span class="help-block">{{ $errors->first('question', ':message') }}</span>
                        </div>

                      <button type="submit" class="btn btn-secondary float-right" >Add</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade" id="edit_confirm" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel">Update Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url' => URL::to('admin/question/update'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
                    <input type="hidden" name="video_id" value="{{$id}}">
                    <input type="hidden" id="id" name="id" >
                    <div class="form-group {{ $errors->first('question', 'has-error') }}">
                        {!! Form::text('question', null, array('class' => 'form-control input-lg', 'id' => 'question', 'placeholder'=> 'Please enter Question')) !!}
                        <span class="help-block">{{ $errors->first('question', ':message') }}</span>
                    </div>

                    <button type="submit" class="btn btn-secondary float-right" >Update</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <script>
        var $url_path = '{!! url('/') !!}';
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var $recipient = button.data('id');
            var modal = $(this);
            modal.find('.modal-footer a').prop("href",$url_path+"/admin/question/delete/"+$recipient);
        })

        $('#edit_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var $recipient = button.data('id');

            $.ajax({
                url: $url_path + "/admin/question/edit/" + $recipient,
                method: 'GET',
                dataType: 'JSON',
                success: function ($data){
                    console.log($data);
                    $('#edit_confirm').find('#question').val($data[0].question);
                    $('#edit_confirm').find('#id').val($recipient);
                }
            });
        })



    </script>
@stop
