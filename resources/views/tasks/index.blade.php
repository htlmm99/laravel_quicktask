@extends('layouts.app')

@section('content')

      <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('message.add_task') }}
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                <!-- New Task Form -->
                <form action="{{ route('tasks.store') }}" method="POST" class="form-horizontal">
                    @csrf
                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">{{ trans('message.task') }}</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i>{{ trans('message.add') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Current Tasks -->
        @isset($tasks)
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('message.current_tasks') }}
                    </div>
                    <div class="panel-body">
                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif
                        <table class="table table-striped task-table">
                            <thead>
                                <th>{{ trans('message.task') }}</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td>
                                            <form action="{{ route('tasks.edit', $task->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>{{ trans('message.edit') }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>{{ trans('message.delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endisset
    </div>
</div>
@endsection
