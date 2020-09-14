@extends('layouts.app')

@section('content')
      <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('message.edit_user') }}
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- Edit Task Form -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="user" class="col-sm-3 control-label">{{ trans('message.username') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="user-name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user" class="col-sm-3 control-label">{{ trans('message.useremail') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" id="user-name" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> {{ trans('message.edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
