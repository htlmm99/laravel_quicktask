<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ trans('message.title') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/lato-font/index') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/Font-Awesome/css/all.min.css') }}">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="panel-heading">
                    <a class="btn btn-success active" href="{{ route('tasks.index') }}">{{ trans('message.task_list') }}</a>
                    <a class="btn btn-danger active" href="{{ route('users.index') }}">{{ trans('message.user_list') }}</a>
                </div>
                <div class="nav navbar-right" id="lang">
                    <a class="btn btn-success active" href="{{ route('lang', 'vi') }}">{{ trans('message.vietnamese') }}</a>
                    <a class="btn btn-danger active" href="{{ route('lang', 'en') }}">{{ trans('message.english') }}</a>
                </div>
            </nav>
        </div>

        @yield('content')
    </body>
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/jquery/dist/jquery.min.js') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}">
</html>
