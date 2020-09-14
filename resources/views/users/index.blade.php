@extends('layouts.app')

@section('content')

      <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('message.add_user') }}
                </div>

                <div class="panel-body">
                    @include('common.errors')
                <form action="{{ route('users.store') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">{{ trans('message.username') }}</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="user-name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">{{ trans('message.useremail') }}</label>
                        <div class="col-sm-6">
                            <input type="text" name="email" id="user-email" class="form-control" placeholder="Email">
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
        <!-- Current Tasks -->
        @isset($users)
            @if (count($users) > 0)
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-text"><div>{{ $user->name }}</div></td>
                                        <td class="table-text"><div>{{ $user->email }}</div></td>
                                        <td>
                                            <form action="{{ route('users.edit', $user->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>{{ trans('message.edit') }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
