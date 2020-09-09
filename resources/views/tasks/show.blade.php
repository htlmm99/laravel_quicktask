@extends('layouts.app')

@section('content')

      <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('message.current_tasks') }} : {{ $task->name }}
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                <form action="{{ route('task-add-user', $task->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">{{ trans('message.useremail') }}</label>
                        <div class="col-sm-6">
                            <input type="text" name="email" id="user_id" class="form-control">
                        </div>
                    </div>
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
        @isset($taskUsers)
            @if (count($taskUsers) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('message.current_users') }}
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
                                <th>{{ trans('message.username') }}</th>
                                <th>{{ trans('message.useremail') }}</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($taskUsers as $user)
                                    <tr>
                                        <td class="table-text"><div>{{ $user->name }}</div></td>
                                        <td class="table-text"><div>{{ $user->email }}</div></td>
                                        <td>
                                            <form action="{{ route('task-delete-user', [$task->id, $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
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
