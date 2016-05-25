@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>
                    <div class="panel-body">

                        <div class="col-md-12 col-lg-8">
                            @if($tasks->count())
                            <ul class="list-group">
                                @foreach($tasks as $task)
                                <li class="list-group-item @if($task->is_completed) task-completed @endif">
                                    {{ $task->task }}

                                    <input type="checkbox" class="complete-task pull-right @if($task->is_completed) hidden @endif" data-csrf-token="{{ csrf_token() }}" data-complete-url="{{ route('tasks.complete', [$task->id]) }}" data-incomplete-url="{{ route('tasks.incomplete', [$task->id]) }}">
                                    <input type="checkbox" class="incomplete-task pull-right @if(!$task->is_completed) hidden @endif" checked="checked" data-csrf-token="{{ csrf_token() }}" data-complete-url="{{ route('tasks.complete', [$task->id]) }}" data-incomplete-url="{{ route('tasks.incomplete', [$task->id]) }}">
                                </li>
                                @endforeach
                            </ul>
                            @else
                                <div class="alert alert-info">No tasks found.</div>
                            @endif
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <form class="form-vertical" role="form" method="post" action="{{ route('tasks.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                                    <label class="control-label" for="task">Task:</label>

                                    <textarea type="email" class="form-control" id="task" name="task" value="{{ old('task') }}"></textarea>

                                    @if ($errors->has('task'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('task') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
           $('.complete-task').on('click', function(){
               var _this = $(this);
               $.post(_this.data('completeUrl'), { _token: _this.data('csrfToken') }, function(){
                   _this.addClass('hidden');
                   _this.parent().find('.incomplete-task').removeClass('hidden');
                   _this.closest('li').addClass('task-completed');
               });
           });
            $('.incomplete-task').on('click', function() {
                var _this = $(this);
                $.post(_this.data('incompleteUrl'), {_token: _this.data('csrfToken')}, function () {
                    _this.addClass('hidden');
                    _this.parent().find('.complete-task').removeClass('hidden');
                    _this.closest('li').removeClass('task-completed');
                });
            });
        });
    </script>
@endsection